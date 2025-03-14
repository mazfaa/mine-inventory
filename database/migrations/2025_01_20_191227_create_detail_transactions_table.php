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
    Schema::create('detail_transactions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
      $table->foreignId('item_id')->constrained()->cascadeOnDelete();
      $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
      $table->foreignId('storage_location_id')->constrained()->cascadeOnDelete();
      $table->integer('quantity');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('detail_transactions');
  }
};
