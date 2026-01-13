<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'sales';
        if($request->ajax()){
            $sales = Sale::latest();
            return DataTables::of($sales)
                    ->addIndexColumn()
                    ->addColumn('product',function($sale){
                        $image = '';
                        if(!empty($sale->product)){
                            $image = null;
                            if(!empty($sale->product->purchase->image)){
                                $image = '<span class="avatar avatar-sm mr-2">
                                <img class="avatar-img" src="'.asset("storage/purchases/".$sale->product->purchase->image).'" alt="image">
                                </span>';
                            }
                            return $sale->product->purchase->product. ' ' . $image;
                        }                 
                    })
                    ->addColumn('total_price',function($sale){                   
                        return $sale->total_price . ' DA';
                    })
                    ->addColumn('date',function($row){
                        return date_format(date_create($row->created_at),'d M, Y');
                    })
                    ->addColumn('action', function ($row) {
                        $editbtn = '<a href="'.route("sales.edit", $row->id).'" class="editbtn"><button class="btn btn-info"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('sales.destroy', $row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        if (!auth()->user()->hasPermissionTo('edit-sale')) {
                            $editbtn = '';
                        }
                        if (!auth()->user()->hasPermissionTo('destroy-sale')) {
                            $deletebtn = '';
                        }
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['product','action'])
                    ->make(true);

        }
        $products = Product::get();
        return view('admin.sales.index',compact(
            'title','products',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'create sales';
        $products = Product::get();
        return view('admin.sales.create',compact(
            'title','products'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required|integer|min:1'
        ]);
        
        $sold_product = Product::find($request->product);
        $purchased_item = Purchase::find($sold_product->purchase->id);

        if ($request->quantity > $purchased_item->quantity) {
            return back()->with(notify("Quantité insuffisante en stock! (Disponible: ".$purchased_item->quantity.")", "danger"));
        }
        
        if (Carbon::now()->gt(Carbon::parse($purchased_item->expiry_date))) {
            return back()->with(notify("This product is expired and cannot be sold!!", "danger"));
        }

        $new_quantity = ($purchased_item->quantity) - ($request->quantity);

        $purchased_item->update([
                'quantity'=>$new_quantity,
        ]);

        $total_price = ($request->quantity) * ($sold_product->price);
        Sale::create([
            'product_id'=>$request->product,
            'quantity'=>$request->quantity,
            'total_price'=>$total_price,
        ]);

        $notification = notify("Product has been sold");

        return redirect()->route('sales.index')->with($notification);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $title = 'edit sale';
        $products = Product::get();
        return view('admin.sales.edit',compact(
            'title','sale','products'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required|integer|min:1'
        ]);

        $sold_product = Product::find($request->product);
        $purchased_item = Purchase::find($sold_product->purchase->id);

        // Calculate available stock including what was already sold in this record
        $available_stock = $purchased_item->quantity + $sale->quantity;

        if ($request->quantity > $available_stock) {
            return back()->with(notify("Quantité insuffisante en stock! (Disponible: ".$available_stock.")", "danger"));
        }

        if (Carbon::now()->gt(Carbon::parse($purchased_item->expiry_date))) {
            return back()->with(notify("Ce produit est expiré et ne peut pas être vendu!", "danger"));
        }

        $new_stock_quantity = $available_stock - $request->quantity;

        $purchased_item->update([
                'quantity'=>$new_stock_quantity,
        ]);

        $total_price = ($request->quantity) * ($sold_product->price);
        $sale->update([
            'product_id'=>$request->product,
            'quantity'=>$request->quantity,
            'total_price'=>$total_price,
        ]);

        $notification = notify("Product has been updated");

        return redirect()->route('sales.index')->with($notification);
    }

    /**
     * Generate sales reports index
     *
     * @return \Illuminate\Http\Response
     */
    public function reports(Request $request){
        $title = 'sales reports';
        return view('admin.sales.reports',compact(
            'title'
        ));
    }

    /**
     * Generate sales report form post
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function generateReport(Request $request){
        $this->validate($request,[
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $title = 'sales reports';
        $sales = Sale::whereBetween(DB::raw('DATE(created_at)'), array($request->from_date, $request->to_date))->get();
        return view('admin.sales.reports',compact(
            'sales','title'
        ));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sale = Sale::findOrFail($request->id);
        
        // Restore stock quantity
        if($sale->product && $sale->product->purchase){
             $sale->product->purchase->increment('quantity', $sale->quantity);
        }

        return $sale->delete();
    }
}
