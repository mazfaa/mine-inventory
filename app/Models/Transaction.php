<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
  use SoftDeletes;

  protected $guarded = [];

  public function detail_transactions()
  {
    return $this->hasMany(DetailTransaction::class);
  }

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($transaction) {
      // Format tanggal
      $date = now()->format('Ymd');

      // Jenis transaksi
      $type = strtoupper($transaction->type); // 'IN' atau 'OUT'

      // Hitung increment berdasarkan transaksi pada hari itu, jenis transaksi, dan lokasi
      $increment = self::whereDate('created_at', now())
        ->where('type', $transaction->type)
        ->count() + 1;

      // Pad increment to 3 digits
      $increment = str_pad($increment, 3, '0', STR_PAD_LEFT);

      // Gabungkan kode transaksi
      $transaction->transaction_code = "{$type}-{$date}-{$increment}";
    });
  }
}
