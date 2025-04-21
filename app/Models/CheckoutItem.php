<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckoutItem extends Model
{
    protected $fillable = [
        'checkout_id', 
        'product_id', 
        'quantity', 
        'price'];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
