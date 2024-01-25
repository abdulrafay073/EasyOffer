<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'comp_name_1',
        'comp_email_1',
        'comp_contact_1',
        'designation_1',
        'dob_1',
        'comp_name_2',
        'comp_email_2',
        'comp_contact_2',
        'designation_2',
        'dob_2',
        'comp_name_3',
        'comp_email_3',
        'comp_contact_3',
        'designation_3',
        'dob_3',
        'comp_office_address',
        'comp_factory_address',
        'comp_ownername',
        'upload_certification',
        'ntn',
        'gst',
        'comp_general_certification',
        'is_tmc',
        'updated_by',
        'deleted_by',
    ];
}