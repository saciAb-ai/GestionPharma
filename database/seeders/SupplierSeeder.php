<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            [
                'name' => 'Saidal Group',
                'email' => 'contact@saidal.dz',
                'phone' => '021234567',
                'company' => 'Saidal',
                'address' => 'Alger, Algérie',
                'product' => 'General',
                'comment' => 'Fournisseur national'
            ],
            [
                'name' => 'Biopharm Distribution',
                'email' => 'info@biopharm.dz',
                'phone' => '023556677',
                'company' => 'Biopharm',
                'address' => 'Oued Smar, Alger',
                'product' => 'Pharmaceuticals',
                'comment' => 'Grossiste répartiteur'
            ],
            [
                'name' => 'Merinal Laboratoire',
                'email' => 'sales@merinal.com',
                'phone' => '021998877',
                'company' => 'Merinal',
                'address' => 'Zone Industrielle, Alger',
                'product' => 'Génériques',
                'comment' => 'Laboratoire local'
            ],
            [
                'name' => 'Sanofi Algérie',
                'email' => 'contact-algerie@sanofi.com',
                'phone' => '021112233',
                'company' => 'Sanofi',
                'address' => 'Sidi Abdellah, Alger',
                'product' => 'Insulines, Cardiologie',
                'comment' => 'Multinationale'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::firstOrCreate(['email' => $supplier['email']], $supplier);
        }
    }
}
