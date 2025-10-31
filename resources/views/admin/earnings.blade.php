@extends('layouts.admin')

@section('title', 'Earnings')

@section('content')
<div class="flex">
    <!-- ✅ Sidebar -->
    @include('admin.sidebar')

    <!-- ✅ Main Content -->
    <div class="flex-1 mt-10 p-8 bg-gray-900 text-gray-100 min-h-screen">
        <h1 class="text-2xl font-bold mb-6 border-b border-gray-700 pb-2">Earnings</h1>

        <!-- ✅ Earnings Table -->
        <div class="bg-gray-800 shadow-lg rounded-xl overflow-hidden">
            <table class="min-w-full text-sm text-gray-300">
                <thead class="bg-gray-700 text-gray-100 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">#ID</th>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Source</th>
                        <th class="px-6 py-3 text-left">Type</th>
                        <th class="px-6 py-3 text-left">Slab</th>
                        <th class="px-6 py-3 text-right">Amount</th>
                        <th class="px-6 py-3 text-left">Credited At</th>
                        <th class="px-6 py-3 text-center">Paid</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($earnings as $earning)
                    <tr class="hover:bg-gray-700 transition">
                        <td class="px-6 py-3">{{ $earning->id }}</td>
                        <td class="px-6 py-3 font-medium text-white">{{ $earning->user->username ?? '—' }}</td>
                        <td class="px-6 py-3 text-gray-400">{{ $earning->sourceUser?->username ?? '—' }}</td>
                        <td class="px-6 py-3">{{ ucfirst($earning->type) }}</td>
                        <td class="px-6 py-3 text-gray-400">{{ $earning->slab ?? '-' }}</td>
                        <td class="px-6 py-3 text-right text-green-400 font-semibold">₹{{ number_format($earning->amount, 2) }}</td>
                        <td class="px-6 py-3 text-gray-400">
                            {{ \Carbon\Carbon::parse($earning->credited_at)->format('d M Y, h:i A') }}
                        </td>
                        <td class="px-6 py-3 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                {{ $earning->is_paid ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                {{ $earning->is_paid ? 'Paid' : 'Unpaid' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-400">No earnings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ✅ Pagination -->
        <div class="mt-6">
            {{ $earnings->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
