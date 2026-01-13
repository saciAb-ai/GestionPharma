<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use Carbon\Carbon;

class PurchaseSeeder extends Seeder
{
    public function run()
    {
        // Get Suppliers and Categories (Assuming previous seeders ran)
        $suppliers = Supplier::all();
        $categories = Category::all();

        if($suppliers->count() == 0 || $categories->count() == 0) {
            $this->command->info('Please run SupplierSeeder and CategorySeeder first!');
            return;
        }

        $products_data = [
            [
                'name' => 'Doliprane 1000mg Comp',
                'category' => 'Médicaments',
                'supplier' => 'Sanofi',
                'cost_price' => 100,
                'sell_price' => 120,
                'quantity' => 500,
                'desc' => 'Paracétamol pour douleurs et fièvre.'
            ],
            [
                'name' => 'Rhinomicine',
                'category' => 'Médicaments',
                'supplier' => 'Saidal',
                'cost_price' => 150,
                'sell_price' => 190,
                'quantity' => 200,
                'desc' => 'Traitement du rhume et nez bouché.'
            ],
            [
                'name' => 'Augmentin 1g',
                'category' => 'Antibiotiques',
                'supplier' => 'Biopharm', // Assuming distribution
                'cost_price' => 800,
                'sell_price' => 950,
                'quantity' => 50,
                'desc' => 'Antibiotique à large spectre.'
            ],
            [
                'name' => 'Spasfon Lyoc',
                'category' => 'Médicaments',
                'supplier' => 'Merinal',
                'cost_price' => 250,
                'sell_price' => 310,
                'quantity' => 150,
                'desc' => 'Antispasmodique pour douleurs abdominales.'
            ],
            [
                'name' => 'Vitamine C 500mg',
                'category' => 'Compléments Alimentaires',
                'supplier' => 'Saidal',
                'cost_price' => 120,
                'sell_price' => 160,
                'quantity' => 300,
                'desc' => 'Vitamine C pour la fatigue passagère.'
            ],
             [
                'name' => 'Biafine Emulsion',
                'category' => 'Dermocosmétique',
                'supplier' => 'Biopharm',
                'cost_price' => 450,
                'sell_price' => 600,
                'quantity' => 40,
                'desc' => 'Crème pour brûlures superficielles.'
            ]
        ];

        foreach ($products_data as $item) {
            // Find supplier (loose match or random)
            $supplier = $suppliers->firstWhere('company', $item['supplier']) ?? $suppliers->random();
            // Find category
            $category = $categories->firstWhere('name', $item['category']) ?? $categories->random();

            // Create Purchase
            $purchase = Purchase::create([
                'product' => $item['name'],
                'category_id' => $category->id,
                'supplier_id' => $supplier->id,
                'cost_price' => $item['cost_price'],
                'quantity' => $item['quantity'],
                'expiry_date' => Carbon::now()->addMonths(rand(6, 36))->format('Y-m-d'),
                'image' => null // Or a placeholder if available
            ]);

            // Create Product (Pricing)
            Product::create([
                'purchase_id' => $purchase->id,
                'price' => $item['sell_price'],
                'discount' => 0,
                'description' => $item['desc']
            ]);
        }

        // Generate fake purchases and products
        /*
        Purchase::factory()->count(20)->create()->each(function ($purchase) {
            Product::factory()->create([
                'purchase_id' => $purchase->id,
                'price' => $purchase->cost_price * 1.25, // 25% margin
                'description' => $purchase->product . ' description',
            ]);
        });
        */
    }
}
