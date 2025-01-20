<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $guarded = [];

  public function detail_transactions()
  {
    return $this->hasMany(DetailTransaction::class);
  }
}
