<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LogisticOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'commercialorder_id',
        'instruction_from_customer',
        'instruction_from_supplier',
        'remarks',
        'indent_sendto_customer',
        'indent_sendto_supplier',
        'sc_required',
        'ca_required',
        'reason',
        'customer_contactperson',
        'supplier_contactperson',
        'is_ready_for_orderprocessing',
        'created_by',
        'updated_by',
    ];
}
