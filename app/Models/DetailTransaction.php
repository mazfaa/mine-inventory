<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
  protected $guarded = [];

  public function transaction()
  {
    return $this->belongsTo(Transaction::class);
  }

  public function item()
  {
    return $this->belongsTo(Item::class);
  }

  public function supplier()
  {
    return $this->belongsTo(Supplier::class);
  }

  public function storage_location()
  {
    return $this->belongsTo(StorageLocation::class);
  }
}
