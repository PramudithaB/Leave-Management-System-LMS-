<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'leave_type',
        'user_id',
        'from_date',
        'to_date',
        'reason',
        'status',
        'remarks'
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

}
