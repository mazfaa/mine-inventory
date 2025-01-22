<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Supplier::insert([
      [
        'name' => 'PT. Elektronik Maju',
        'phone' => '+6281234567890',
        'address' => 'Jl. Raya Elektronik 12',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'name' => 'CV. Furnitura',
        'phone' => '+6289876543210',
        'address' => 'Jl. Kayu Jati 34',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'name' => 'Distribusi Serba Ada',
        'phone' => '+6281122334455',
        'address' => 'Jl. Merdeka 78',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
