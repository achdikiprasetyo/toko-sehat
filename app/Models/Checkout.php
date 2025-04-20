<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model
{
    protected $fillable = ['user_id', 'payment_method', 'total', 'status'];

    public function items()
    {
        return $this->hasMany(CheckoutItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}