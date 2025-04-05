<?php

namespace App\Modules\Products\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'room', 'details' => 'hello world', 'type_id' => 2, 'color' => 'blue', 'cost' => 100],
            ['name' => 'room', 'details' => 'hello world', 'type_id' => 2, 'color' => 'blue', 'cost' => 100],
            ['name' => 'room', 'details' => 'hello world', 'type_id' => 2, 'color' => 'blue', 'cost' => 100],
            ['name' => 'room', 'details' => 'hello world', 'type_id' => 2, 'color' => 'blue', 'cost' => 100],
            ['name' => 'room', 'details' => 'hello world', 'type_id' => 2, 'color' => 'blue', 'cost' => 100],
        ];

        Product::insert($data);
    }
}
