<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'leave_type',
        'from_date',
        'to_date',
        'reason',
    ];
}
