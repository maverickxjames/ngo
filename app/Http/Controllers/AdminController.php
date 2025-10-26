<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Earning;
use App\Models\Payout;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $pendingUsers = User::where('status', 'pending')->count();
        $totalDonations = Payment::where('status', 'success')->sum('amount');
        $recentUsers = User::latest()->take(5)->get();
        return view('admin.dashboard', compact('userCount', 'activeUsers', 'pendingUsers', 'totalDonations', 'recentUsers'));
    }

    public function users()
    {
        
        $users = User::paginate(20);
        $users->load('referrer');
        return view('admin.users', compact('users'));
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $request->validate(['status' => 'required|in:pending,active,rejected']);
        $user->status = $request->status;
        $user->save();
        return back()->with('status', 'User status updated');
    }

    public function payments()
    {
        $payments = Payment::latest()->paginate(20);
        return view('admin.payments', compact('payments'));
    }

    public function earnings()
    {
        $earnings = Earning::latest()->paginate(20);
        return view('admin.earnings', compact('earnings'));
    }

    public function payouts()
    {
        $payouts = Payout::latest()->paginate(20);
        return view('admin.payouts', compact('payouts'));
    }

    public function payOut(Request $request, User $user)
    {
        // sum unpaid earnings
        $amount = $user->earnings()->where('is_paid', false)->sum('amount');
        if ($amount <= 0) {
            return back()->withErrors(['payout' => 'No pending earnings for this user']);
        }
        // Mark earnings as paid
        $user->earnings()->where('is_paid', false)->update(['is_paid' => true]);
        // Create payout record
        Payout::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'bank_details_snapshot' => $user->bank_details,
            'processed_by' => auth()->id(),
            'processed_at' => now(),
            'status' => 'paid',
        ]);
        return back()->with('status', 'Payout processed');
    }

    public function Usershow(User $user)
    {
        $user->load('referrer');
        $user->bank_details = is_string($user->bank_details)
            ? json_decode($user->bank_details, true)
            : $user->bank_details;

        return view('admin.user_show', compact('user'));
    }

    public function updateMpin(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'mpin' => ['required', 'digits:4'],
            ]);

            $user->mpin = bcrypt($validated['mpin']);
            $user->save();

            return back()->with('status', 'MPIN updated successfully.')->with('status_type', 'success');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->with('status', $e->validator->errors()->first())
                ->with('status_type', 'error');
        } catch (\Exception $e) {
            return back()->with('status', 'Something went wrong.')->with('status_type', 'error');
        }
    }

    public function updatePersonal(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'education' => 'nullable|string|max:255',
        ]);

        $user->update($data);

        return back()->with('status', 'Personal information updated successfully.')->with('status_type', 'success');
    }

    public function updateContact(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|numeric|min:10',
            'address' => 'nullable|string|max:500',
            'tehsil' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
        ]);

        $user->update($data);

        return back()->with('status', 'Contact information updated successfully.')->with('status_type', 'success');
    }

public function updateBank(Request $request, User $user)
{
    $data = $request->validate([
        'bank_name' => 'required|string|max:255',
        'account_number' => 'required|string|max:50',
        'ifsc' => 'required|string|max:20',
        'account_holder' => 'required|string|max:255',
        'branch' => 'nullable|string|max:255',
        'branch_address' => 'nullable|string|max:255',
        'pan_number' => 'nullable|string|max:20',
    ]);

    // Ensure consistency
    $user->bank_details = json_encode($data);
    $user->save();

    return back()
        ->with('status', 'Bank details updated successfully.')
        ->with('status_type', 'success');
}

}
