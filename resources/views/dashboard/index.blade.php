@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-10">

        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-green-600 to-orange-500 text-white p-8 rounded-2xl shadow-lg">
            <h1 class="text-3xl font-bold">Welcome, {{ $user->username }}</h1>
            <p class="mt-2 text-lg">
                Status:
                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-white text-green-700">
                    {{ ucfirst($user->status) }}
                </span>
            </p>
        </div>



<!-- Show Activation if Pending -->
@if($user->status === 'pending')
    <div class="bg-white rounded-2xl shadow-lg p-8 mt-6 border-l-8 border-orange-500">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-orange-600">Account Activation Required</h2>
                <p class="mt-2 text-gray-600">To activate your account, please contribute a one-time fee.</p>
                <p class="mt-3 text-3xl font-extrabold text-green-700">₹600</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <form method="POST" action="">
                    @csrf
                    <button type="submit" 
                        class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition font-semibold">
                        Activate Account
                    </button>
                </form>
            </div>
        </div>
    </div>

<!-- Show Rejected Message -->
@elseif($user->status === 'rejected')
    <div class="bg-white rounded-2xl shadow-lg p-8 mt-6 border-l-8 border-red-600">
        <div class="flex items-center space-x-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
            </svg>
            <div>
                <h2 class="text-xl font-bold text-red-600">Account Rejected</h2>
                <p class="mt-2 text-gray-600">Your activation request has been rejected. Please contact support for more details.</p>
            </div>
        </div>
    </div>

<!-- Show Donations if Active -->
@elseif($user->status === 'active')
    <div class="bg-white rounded-2xl shadow-lg p-8 flex items-center justify-between border-l-8 border-green-600">
        <div>
            <h2 class="text-xl font-bold text-gray-600">Total Donations Collected</h2>
            <p class="mt-3 text-4xl font-extrabold text-green-700">₹{{ number_format($totalDonation, 2) }}</p>
            <p class="text-sm text-gray-500 mt-1">Your NGO’s impact through all contributors ❤️</p>
        </div>
        <div class="hidden sm:block">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-600 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 1.343-3 3v1.25H8.5A2.5 2.5 0 006 14.75v0A2.5 2.5 0 008.5 17.25H9v.75a3 3 0 003 3h0a3 3 0 003-3v-.75h.5a2.5 2.5 0 002.5-2.5v0a2.5 2.5 0 00-2.5-2.5H15V11c0-1.657-1.343-3-3-3z" />
            </svg>
        </div>
    </div>
@endif



        <!-- Earnings Cards -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white rounded-xl shadow p-6 border-t-4 border-green-600 hover:shadow-lg transition">
                <h3 class="text-sm font-semibold text-gray-500">Direct Income</h3>
                <p class="mt-2 text-3xl font-bold text-green-600">₹{{ number_format($directIncome, 2) }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 border-t-4 border-orange-500 hover:shadow-lg transition">
                <h3 class="text-sm font-semibold text-gray-500">Team Income</h3>
                <p class="mt-2 text-3xl font-bold text-orange-600">₹{{ number_format($teamIncome, 2) }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 border-t-4 border-green-800 hover:shadow-lg transition">
                <h3 class="text-sm font-semibold text-gray-500">Total Income</h3>
                <p class="mt-2 text-3xl font-bold text-green-800">₹{{ number_format($directIncome + $teamIncome, 2) }}</p>
            </div>
        </div>

        <!-- Payments Table -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-4 flex items-center">
                <span class="w-2 h-6 bg-green-600 rounded mr-2"></span> Payments
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead class="bg-green-50 text-green-700 uppercase text-xs font-bold">
                        <tr>
                            <th class="px-4 py-3 text-left">Gateway</th>
                            <th class="px-4 py-3">Order ID</th>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($payments as $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $payment->gateway }}</td>
                            <td class="px-4 py-3">{{ $payment->order_id }}</td>
                            <td class="px-4 py-3 font-semibold">₹{{ $payment->amount }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ strtolower($payment->status) === 'success'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-orange-100 text-orange-700' }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $payment->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">No payments found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payouts Table -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-semibold text-orange-600 mb-4 flex items-center">
                <span class="w-2 h-6 bg-orange-500 rounded mr-2"></span> Payouts
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead class="bg-orange-50 text-orange-700 uppercase text-xs font-bold">
                        <tr>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($payouts as $payout)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold">₹{{ $payout->amount }}</td>
                            <td class="px-4 py-3">{{ $payout->processed_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $payout->status === 'completed'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($payout->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-center text-gray-500">No payouts yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Direct Members Table -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-semibold text-green-700 mb-4 flex items-center">
                <span class="w-2 h-6 bg-green-600 rounded mr-2"></span> Direct Members
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-bold">
                        <tr>
                            <th class="px-4 py-3 text-left">Username</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($directMembers as $member)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $member->username }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $member->status === 'active'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($member->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $member->joined_at }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-center text-gray-500">No members yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
