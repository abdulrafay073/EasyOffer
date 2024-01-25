<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FinanceExpense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'expense_type',
        'amount',
        'datetime',
        'person',
        'created_by',
        'updated_by',
    ];
}
