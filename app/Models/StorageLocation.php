<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageLocation extends Model
{
  protected $guarded = [];

  public function transaction()
  {
    return $this->hasMany(Transaction::class);
  }
}
