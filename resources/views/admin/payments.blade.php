@extends('layouts.admin')

@section('title', 'Payments')

@section('content')
<div class="flex">
    <!-- ✅ Sidebar -->
    @include('admin.sidebar')

    <!-- ✅ Main Content -->
    <div class="flex-1 bg-gray-900 text-gray-100 min-h-screen p-8">
        <h1 class="text-2xl font-bold mb-6 border-b border-gray-700 pb-2">Payments</h1>

        <!-- ✅ Payments Table -->
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-x-auto">
            <table class="min-w-full text-sm text-gray-300">
                <thead class="bg-gray-700 text-gray-100 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">#ID</th>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Gateway</th>
                        <th class="px-6 py-3 text-left">Order ID</th>
                        <th class="px-6 py-3 text-right">Amount</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-left">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($payments as $payment)
                    <tr class="hover:bg-gray-700 transition">
                        <td class="px-6 py-3">{{ $payment->id }}</td>
                        <td class="px-6 py-3 font-medium text-white">{{ $payment->user->username ?? '—' }}</td>
                        <td class="px-6 py-3">{{ strtoupper($payment->gateway) }}</td>
                        <td class="px-6 py-3 text-gray-400">{{ $payment->order_id ?? 'N/A' }}</td>
                        <td class="px-6 py-3 text-right text-green-400 font-semibold">₹{{ number_format($payment->amount, 2) }}</td>
                        <td class="px-6 py-3 text-center">
                            @php
                                $statusColors = [
                                    'success' => 'bg-green-600 text-white',
                                    'failed' => 'bg-red-600 text-white',
                                    'pending' => 'bg-yellow-500 text-black'
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$payment->status] ?? 'bg-gray-600 text-white' }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-gray-400">
                            {{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y, h:i A') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-400">No payment records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ✅ Pagination -->
        <div class="mt-6">
            {{ $payments->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
