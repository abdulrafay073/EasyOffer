<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CommercialOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'salemarketingorder_id',
        'commercialperson_name',
        'buyer_id',
        'seller_id',
        'productname',
        'price',
        'qty',
        'shipmentmode',
        'paymentterm',
        'origin',
        'materialavailability',
        'mfgname',
        'commissiondecided',
        'supplierinstructions',
        'indentcustomer',
        'tosupplier',
        'created_by',
        'updated_by',
    ];
}
