<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SellerPlacedBid extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seller_id',
        'placedbid_against_makerequest_id',
        'buyer_request_id',
        'updated_by',
        'deleted_by',
    ];
}