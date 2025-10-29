<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'subject',
        'description',
        'status',
        'priority',
        'department',
        'user_id',
        'file',
    ];


    public function user():belongsTo{
        $this->belongsTo(User::class);
    }
}
