<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matter extends Model
{
    use HasFactory, SoftDeletes;

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'customer_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'assign_to', 'id');
    }

    protected $fillable = [
        'customer_id',
        'assign_to',
        'product_name',
        'problem',
        'problem_rated',
        'status',
        'solution',
        'boss_feedback',
        'manager_approval',
        'resolve_time',
        'issue_related',
    ];
}
