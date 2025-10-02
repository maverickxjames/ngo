<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Payment;
use App\Models\Earning;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        $admin = User::create([
            'form_number' => '1',
            'username'    => 'admin',
            'password'    => Hash::make('password'),
            'mpin'        => Hash::make('1234'),
            'referral_code' => 'ADMIN1234',
            'referred_by'  => null,
            'status'       => 'active',
            'joined_at'    => now(),
            'bank_details' => [
                'account_number' => '0000000000',
                'ifsc'           => 'IFSC0000',
                'account_holder' => 'Admin',
            ],
        ]);

        // Create sample users referred by admin
        for ($i = 2; $i <= 4; $i++) {
            $user = User::create([
                'form_number' => (string)$i,
                'username'    => 'user'.$i,
                'password'    => Hash::make('password'),
                'mpin'        => Hash::make('1234'),
                'referral_code' => strtoupper(Str::random(8)),
                'referred_by'  => $admin->id,
                'status'       => 'active',
                'joined_at'    => now(),
            ]);

            // Create activation payment
            $payment = Payment::create([
                'user_id' => $user->id,
                'gateway' => 'razorpay',
                'order_id' => 'PAYID'.$user->id,
                'amount' => 600.00,
                'status' => 'success',
            ]);

            $user->activation_payment_id = $payment->id;
            $user->save();

            // Create direct earning for admin
            Earning::create([
                'user_id' => $admin->id,
                'source_user_id' => $user->id,
                'type' => 'direct',
                'slab' => 1,
                'amount' => 3500.00,
                'credited_at' => now(),
                'is_paid' => false,
            ]);
        }
    }
}
