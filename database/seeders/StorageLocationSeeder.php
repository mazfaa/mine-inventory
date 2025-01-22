<?php

namespace Database\Seeders;

use App\Models\StorageLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorageLocationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    StorageLocation::insert([
      [
        'name' => 'Main Storage',
        'description' => 'The main warehouse storage location.',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'name' => 'Temporary Storage',
        'description' => 'Temporary storage for items that need to be moved.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
