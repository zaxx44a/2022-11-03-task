<?php

namespace App\Models;

use App\Mail\RunOutMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'run_out_alert'
    ];
    /**
    * The Ingredients that belong to the Products.
    */
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_ingredient')->withPivot(['amount']);
    }
    public static function calculate($products)
    {
       foreach ($products as  $product) {
            foreach ($product->ingredient as $ingredient) {
                $ingredient->decrement('current', ($ingredient->pivot->amount * $product->pivot->quantity));
                $ingredient->checkStock();
            }
       }
    }

    public static function refill($data)
    {
        $ingredient = Ingredient::whereId($data['ingredient'])->first();
        $ingredient->update([ 'current' =>  $ingredient->current + $data['amount'], 'run_out_alert' =>  0 ]);
        return $ingredient;
    }
    
    public function checkStock()
    {
        $thresholdAmount = ($this->full_load * ($this->threshold/ 100));
      if( ($this->current < $thresholdAmount) && $this->run_out_alert == 0 ){
          $this->notifyOwner();
          $this->update([ 'run_out_alert' => 1 ]);

      }
    }

    public function notifyOwner()
    {
        Mail::to( new Address(config('mail.owner.address'), config('mail.owner.name')) )->send(new RunOutMail($this));
    }
}
