<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class MiguInitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori
        $kaos = Category::firstOrCreate(
            ['slug' => 'kaos'],
            ['name' => 'Kaos']
        );

        $celana = Category::firstOrCreate(
            ['slug' => 'celana'],
            ['name' => 'Celana']
        );

        $hoodie = Category::firstOrCreate(
            ['slug' => 'hoodie'],
            ['name' => 'Hoodie']
        );

        // Produk
        Product::firstOrCreate([
            'sku' => 'KPH-001'
        ], [
            'category_id' => $kaos->id,
            'name' => 'Kaos Polos Hitam',
            'price' => 85000,
            'stock' => 50
        ]);

        Product::firstOrCreate([
            'sku' => 'KGP-002'
        ], [
            'category_id' => $kaos->id,
            'name' => 'Kaos Grafis Putih',
            'price' => 95000,
            'stock' => 40
        ]);

        Product::firstOrCreate([
            'sku' => 'HOA-001'
        ], [
            'category_id' => $hoodie->id,
            'name' => 'Hoodie Oversize Abu',
            'price' => 175000,
            'stock' => 30
        ]);

        Product::firstOrCreate([
            'sku' => 'CCC-001'
        ], [
            'category_id' => $celana->id,
            'name' => 'Celana Chino Cream',
            'price' => 145000,
            'stock' => 25
        ]);

        // User
        User::updateOrCreate(
            ['email' => 'admin@migu.com'],
            ['name' => 'Admin Migu', 'password' => bcrypt('password123'), 'role' => 'admin']
        );
    }
}