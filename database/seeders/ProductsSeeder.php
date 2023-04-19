<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::create([
            'id' => 1,
            'nombre' => 'tenis',
            'cantidad' => 1,
            'precio' => 300,
            'calzado' => 'mediano',
            'marca' => 'nike',
            'status' => true,
        ]);

        Products::create();
    }
}
