<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}