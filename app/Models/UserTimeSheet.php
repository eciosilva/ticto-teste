<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTimeSheet extends Model
{
    protected $table = 'users_time_sheet';
    
    protected $fillable = [
        'user_id',
        'work_date',
        'start_time',
        'end_time'
    ];
}