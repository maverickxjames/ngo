<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    /**
     * List direct referrals.
     */
    public function index()
    {
        $user = Auth::user();
        $directMembers = $user->children()->with('children')->get();
        return view('referrals.index', compact('directMembers'));
    }

    /**
     * Return tree view of all downline members.
     */
    public function tree()
    {
        $user = Auth::user();
        $tree = $this->buildTree($user);
        return view('referrals.tree', compact('tree'));
    }

    private function buildTree($user)
    {
        $children = $user->children;
        return $children->map(function ($child) {
            return [
                'username' => $child->username,
                'status'   => $child->status,
                'joined_at'=> $child->joined_at,
                'children' => $this->buildTree($child),
            ];
        });
    }
}
