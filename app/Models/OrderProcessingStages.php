<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderProcessingStages extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'logisticorder_id',
        'is_purchase_confirm',
        'is_purchase_cancel',
        'is_sale_confirm',
        'is_sale_cancel',
        'created_by',
        'updated_by',
    ];
}
