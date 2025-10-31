<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivationPin extends Model
{
    protected $fillable = [
        'pin',
        'assigned_to',
        'used_by',
        'status',
        'used_at',
        'generated_by',
    ];

    public function assignedUser() {
    return $this->belongsTo(User::class, 'assigned_to');
}

public function usedUser() {
    return $this->belongsTo(User::class, 'used_by');
}


}
