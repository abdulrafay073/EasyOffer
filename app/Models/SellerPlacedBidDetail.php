<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SellerPlacedBidDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'placedbid_id',
        'customer_name',
        'product_id',
        'qty',
        'shipping_method',
        'payment_method',
        'origin',
        'required',
        'description',
        'certification',
        'sample_or_real',
        'price',
        'timeduration',
    ];
}