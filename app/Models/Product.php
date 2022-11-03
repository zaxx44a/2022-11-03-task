<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
    * The Ingredients that belong to the Products.
    */
    public function ingredient()
    {
        return $this->belongsToMany(Ingredient::class, 'product_ingredient')->withPivot(['amount']);
    }

    /**
    * The Order that belong to the Products.
    */
    public function order()
    {
        return $this->belongsToMany(order::class)->withPivot(['quantity']);
    }
}
