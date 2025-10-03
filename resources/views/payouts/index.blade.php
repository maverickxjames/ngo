@extends('layouts.app')

@section('content')
@php
use App\Models\Setting;
$nextSettlementJson = Setting::get('next_settlement_date');
// Decode JSON to array
$nextSettlement = json_decode($nextSettlementJson, true);

// Extract the date
$nextSettlementDate = $nextSettlement[0]['next_settlement_date'] ?? null;

@endphp
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-orange-500 p-6 rounded-xl shadow-lg text-white mb-6">
        <h1 class="text-2xl font-bold">Payouts</h1>
        <p class="text-sm mt-1">Manage your earnings and track settlements</p>
    </div>

    <!-- Balance / Wallet Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-600">
            <h3 class="text-sm font-semibold text-gray-600">Available Balance</h3>
            <p class="mt-2 text-2xl font-bold text-green-700">₹{{ number_format(auth()->user()->wallet_balance, 2) }}
            </p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-orange-500">
            <h3 class="text-sm font-semibold text-gray-600">Total Income</h3>
            <p class="mt-2 text-2xl font-bold text-orange-600">₹{{ number_format(auth()->user()->total_income, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
            <h3 class="text-sm font-semibold text-gray-600">Earning Wallet</h3>
            <p class="mt-2 text-2xl font-bold text-blue-600">₹{{ number_format((auth()->user()->wallet_balance +
                auth()->user()->total_income), 2) }}</p>
        </div>
    </div>

    <!-- Next Settlement Info -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-lg shadow mb-8">
        <h2 class="text-lg font-semibold text-yellow-700">Next Settlement</h2>
        <p class="mt-2 text-gray-700">
            Your next payout settlement will be processed on
            @if($nextSettlementDate)
            <span class="font-bold">
                {{ \Carbon\Carbon::parse($nextSettlementDate)->format('d M, Y') }}
            </span>
            @else
            <span class="text-red-500">Not set</span>
            @endif
        </p>
        <p class="text-sm text-gray-500 mt-1">
            Minimum payout threshold: ₹500 • Settlement frequency: Weekly (Every Monday)
        </p>
    </div>

    <!-- Payout History -->
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-100">
        <h2 class="text-lg font-bold text-gray-700">Payout History</h2>
    </div>

    <!-- Responsive Wrapper -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 border-collapse">
            <thead class="bg-gray-50 text-gray-800 uppercase text-xs font-semibold border-b">
                <tr>
                    <th class="px-6 py-3 border-r">SR NO</th>
                    
                    <th class="px-6 py-3 border-r">Transaction ID</th>
                    <th class="px-6 py-3 border-r">Amount</th>
                    <th class="px-6 py-3 border-r">Date</th>
                    <th class="px-6 py-3 border-r">Status</th>
                    <th class="px-6 py-3">Bank Reference ID</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($payouts as $index => $payout)
                <tr class="hover:bg-gray-50 transition">
                    <!-- Serial Number -->
                    <td class="px-6 py-4 font-medium text-gray-900 border-r">
                        {{ $index + 1 }}
                    </td>

                                        <!-- Transaction ID -->
                    <td class="px-6 py-4 text-gray-600 border-r">
                        {{ $payout->txnid ?? 'N/A' }}
                    </td>

                    <!-- Amount -->
                    <td class="px-6 py-4 font-semibold text-green-700 border-r">
                        ₹{{ number_format($payout->amount, 2) }}
                    </td>

                    <!-- Date -->
                    <td class="px-6 py-4 text-gray-600 border-r">
                        {{ $payout->processed_at ? $payout->processed_at : 'N/A' }}
                    </td>

                    <!-- Status -->
                    <td class="px-6 py-4 border-r">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            {{ $payout->status === 'paid' ? 'bg-green-100 text-green-700' :
                               ($payout->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($payout->status) }}
                        </span>
                    </td>



                    <!-- Bank Reference ID -->
                    <td class="px-6 py-4 text-gray-600">
                        {{ $payout->reference ?? 'N/A' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                        No payout history available.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>
@endsection