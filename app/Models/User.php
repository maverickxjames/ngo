<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'form_number',
        'username',
        'password',
        'mpin',
        'name',
        'email',
        'profile_photo',
        'referral_code',
        'referred_by',
        'status',
        'activation_payment_id',
        'joined_at',
        'bank_details',
    ];

    /**
     * Attributes hidden from arrays.
     */
    protected $hidden = [
        'password',
        'mpin',
        'remember_token',
    ];

    /**
     * The attributes casted to native types.
     */
    protected $casts = [
        'bank_details' => 'array',
        'joined_at'    => 'datetime',
    ];

    /**
     * Get the user that referred this user.
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    /**
     * Get the users referred by this user.
     */
    public function children()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    /**
     * Payments made by the user (activation donations).
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Earnings credited to the user.
     */
    public function earnings()
    {
        return $this->hasMany(Earning::class);
    }

    /**
     * Payouts made to the user.
     */
    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }
}
