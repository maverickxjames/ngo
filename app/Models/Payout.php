<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'bank_details_snapshot',
        'processed_by',
        'processed_at',
        'status',
    ];

    protected $casts = [
        'bank_details_snapshot' => 'array',
        'processed_at'          => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
