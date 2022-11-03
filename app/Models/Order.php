<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'user_id'
    ];

    /**
    * The Products that belong to the Order.
    */
    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity']);
    }


    public static function add($request)
    {
        $newOrder = Order::create([ 'user_id' => auth()->id() ]);
        if($newOrder){
            $newOrder->product()->attach($request);
            return $newOrder;
        } else {
            return false;
        }
    }
}
