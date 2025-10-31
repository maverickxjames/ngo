<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivationPin;
use App\Models\User;

class AdminPinController extends Controller
{
    public function index()
    {
        $users = User::where('status','active')->get();
        $pins = ActivationPin::with('assignedUser')->latest()->paginate(20);

        return view('admin.pins', compact('pins','users'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1|max:200',
        ]);

        for ($i = 0; $i < $request->quantity; $i++) {
            ActivationPin::create([
                'pin' => rand(100000,999999),
                'assigned_to' => $request->assigned_to,
                'generated_by' => auth()->id(),
            ]);
        }

        return back()->with('status','Pins generated successfully!');
    }

public function searchUsers(Request $request)
{
    $search = $request->query('query');

    $users = User::where('status', 'active') // ✅ Only active users
        ->where(function($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('username', 'like', "%$search%")
              ->orWhere('phone', 'like', "%$search%");
        })
        ->limit(15)
        ->get(['id', 'name', 'username', 'phone', 'profile_photo']);

    // ✅ Fetch PIN count for each user
    $users->map(function($u) {
        $u->pin_used = ActivationPin::where('assigned_to', $u->id)->whereNotNull('used_by')->count();
        $u->pin_available = ActivationPin::where('assigned_to', $u->id)->whereNull('used_by')->count();
        return $u;
    });

    return response()->json($users);
}


}
