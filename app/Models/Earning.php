<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_user_id',
        'type',
        'slab',
        'amount',
        'credited_at',
        'is_paid',
    ];

    protected $casts = [
        'credited_at' => 'datetime',
        'is_paid'     => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sourceUser()
    {
        return $this->belongsTo(User::class, 'source_user_id');
    }
}
