<?php

namespace Database\Seeders;
use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'name' => 'Laptop Dell Inspiron 14',
        'image' => 'img/items/default.png',
        'category_id' => 1, // Electronics
        'sku' => 'DL-LPT-INS14',
        'quantity' => 25,
        'initial_stock' => 25,
        'barcode' => '9781234567897', // ISBN example
        'barcode_type' => 'ISBN',
        'description' => '14-inch laptop with an Intel Core i5 processor and 8GB RAM.',
        'min_stock' => 10,
        'unit_price' => 7500000,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Office Desk - Walnut Finish',
        'image' => 'img/items/default.png',
        'category_id' => 2, // Furniture
        'sku' => 'FR-DSK-WLTN',
        'quantity' => 10,
        'initial_stock' => 10,
        'barcode' => '123456789012', // UPC example
        'barcode_type' => 'UPC',
        'description' => 'Sturdy wooden desk with a walnut finish, ideal for home and office use.',
        'min_stock' => 5,
        'unit_price' => 2000000,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Ballpoint Pen - Pack of 10',
        'image' => 'img/items/default.png',
        'category_id' => 3, // Office Supplies
        'sku' => 'OS-PEN-10PK',
        'quantity' => 100,
        'initial_stock' => 100,
        'barcode' => '00012345600012', // GTIN example
        'barcode_type' => 'GTIN',
        'description' => 'Smooth-writing ballpoint pens in a convenient pack of 10.',
        'min_stock' => 15,
        'unit_price' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Smartphone Samsung Galaxy A54',
        'image' => 'img/items/default.png',
        'category_id' => 1, // Electronics
        'sku' => 'SM-GA-A54',
        'quantity' => 50,
        'initial_stock' => 50,
        'barcode' => '9784561237897', // ISBN example
        'barcode_type' => 'ISBN',
        'description' => 'Samsung Galaxy A54 with 128GB storage and 5G capability.',
        'min_stock' => 25,
        'unit_price' => 5000000,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Ergonomic Office Chair',
        'image' => 'img/items/default.png',
        'category_id' => 2, // Furniture
        'sku' => 'FR-CHR-ERG',
        'quantity' => 15,
        'initial_stock' => 15,
        'barcode' => '456789123456', // UPC example
        'barcode_type' => 'UPC',
        'description' => 'Comfortable ergonomic office chair with adjustable height and lumbar support.',
        'min_stock' => 5,
        'unit_price' => 1250000,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'A4 Printer Paper - 500 Sheets',
        'image' => 'img/items/default.png',
        'category_id' => 3, // Office Supplies
        'sku' => 'OS-PPR-A4',
        'quantity' => 200,
        'initial_stock' => 200,
        'barcode' => '00876543210009', // GTIN example
        'barcode_type' => 'GTIN',
        'description' => 'High-quality A4 printer paper for professional printing needs.',
        'min_stock' => 20,
        'unit_price' => 75000,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    foreach ($items as $itemData) {
      $item = Item::create($itemData);

      // Seed images for each item
      // ItemImage::insert([
      //   [
      //     'item_id' => $item->id,
      //     'image_path' => 'img/items/' . $item->sku . '-1.jpg',
      //     'is_primary' => true,
      //     'created_at' => now(),
      //     'updated_at' => now(),
      //   ],
      //   [
      //     'item_id' => $item->id,
      //     'image_path' => 'img/items/' . $item->sku . '-2.jpg',
      //     'is_primary' => false,
      //     'created_at' => now(),
      //     'updated_at' => now(),
      //   ],
      // ]);
    }
  }
}
