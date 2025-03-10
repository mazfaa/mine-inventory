<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
  use SoftDeletes;

  protected $guarded = [];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function item_images()
  {
    return $this->hasMany(ItemImage::class);
  }
}
