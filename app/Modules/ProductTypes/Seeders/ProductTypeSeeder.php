<?php

namespace App\Modules\ProductTypes\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Bedrooms', 'details' => 'hello world'],
            ['name' => 'Living rooms', 'details' => 'hello world'],
            ['name' => 'Dining rooms', 'details' => 'hello world'],
            ['name' => 'Desks', 'details' => 'hello world'],
        ];

        ProductType::insert($data);
    }
}
