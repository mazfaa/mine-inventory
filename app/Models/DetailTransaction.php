<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaction extends Model
{
  use SoftDeletes;

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
