<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BmrProceed extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'buyer_make_request_id',
        'seller_id',
        'is_reject_by_seller',
        'is_reject_by_seller_reason',
    ];

}