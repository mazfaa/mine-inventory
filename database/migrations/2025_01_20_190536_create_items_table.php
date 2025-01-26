<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('category_id')->constrained()->cascadeOnDelete();
      $table->string('sku')->unique();
      $table->string('image')->nullable();
      $table->string('name');
      $table->text('description')->nullable();
      $table->string('barcode')->nullable();
      $table->enum('barcode_type', ['ISBN', 'UPC', 'GTIN'])->nullable();
      $table->integer('initial_stock');
      $table->integer('quantity');
      $table->integer('min_stock');
      $table->integer('unit_price');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('items');
  }
};
