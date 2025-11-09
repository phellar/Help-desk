<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
