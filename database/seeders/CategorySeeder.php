<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Category::insert([
      [
        'name' => 'Electronics',
        'description' => 'All electronics items',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Furniture',
        'description' => 'All furniture items',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Office Supplies',
        'description' => 'All office supplies items',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

  }
}
