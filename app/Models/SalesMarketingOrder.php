<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SalesMarketingOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'marketingperson_name',
        'buyer_id',
        'seller_id',
        'productname',
        'price',
        'qty',
        'paymentterm',
        'mfgname',
        'shipmentmode',
        'shipmentintimation',
        'pssrequirement',
        'shipmentrequirement',
        'customershipmenttime',
        'lcdate',
        'indentcustomer',
        'tosupplier',
        'preshipmentcoa',
        'shipmentafteradc',
        'dml',
        'preshipmentdocs',
        'lables',
        'gmp',
        'certifictes',
        'imagebeforeshipment',
        'moa',
        'preinformcharges',
        'stability',
        'safta',
        'materialavailability',
        'dmf',
        'created_by',
        'updated_by',
    ];
}
