@extends('layouts.admin')

@section('title', 'Payouts')

@section('content')
<div class="flex">
    <!-- ✅ Sidebar -->
    @include('admin.sidebar')

    <!-- ✅ Main Content -->
    <div class="mt-12 flex-1 bg-gray-900 text-gray-100 min-h-screen p-8">
        <h1 class="text-2xl font-bold mb-6 border-b border-gray-700 pb-2">Payouts</h1>

        <!-- ✅ Payouts Table -->
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-x-auto">
            <table class="min-w-full text-sm text-gray-300">
                <thead class="bg-gray-700 text-gray-100 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">#ID</th>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-right">Amount</th>
                        <th class="px-6 py-3 text-left">Processed By</th>
                        <th class="px-6 py-3 text-left">Processed Date</th>
                        <th class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($payouts as $payout)
                    <tr class="hover:bg-gray-700 transition">
                        <td class="px-6 py-3">{{ $payout->id }}</td>
                        <td class="px-6 py-3 font-medium text-white">{{ $payout->user->username ?? '—' }}</td>
                        <td class="px-6 py-3 text-right text-green-400 font-semibold">
                            ₹{{ number_format($payout->amount, 2) }}
                        </td>
                        <td class="px-6 py-3 text-gray-300">
                            {{ $payout->processedBy->name ?? 'Admin' }}
                        </td>
                        <td class="px-6 py-3 text-gray-400">
                            {{ $payout->processed_at ? \Carbon\Carbon::parse($payout->processed_at)->format('d M Y, h:i A') : '—' }}
                        </td>
                        <td class="px-6 py-3 text-center">
                            @php
                                $statusColors = [
                                    'paid' => 'bg-green-600 text-white',
                                    'pending' => 'bg-yellow-500 text-black',
                                    'failed' => 'bg-red-600 text-white'
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$payout->status] ?? 'bg-gray-600 text-white' }}">
                                {{ ucfirst($payout->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-400">No payout records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ✅ Pagination -->
        <div class="mt-6">
            {{ $payouts->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
