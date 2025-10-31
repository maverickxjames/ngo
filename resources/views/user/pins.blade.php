@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-orange-500 p-6 rounded-xl shadow-lg text-white mb-6">
        <h1 class="text-2xl font-bold">My Activation Pins</h1>
        <p class="text-sm mt-1">Authorize new user registration using admin-approved pins</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow p-4 text-center">
            <h4 class="text-gray-600 text-sm">Total Pins</h4>
            <p class="text-2xl font-bold text-green-700">{{ $pins->count() }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-4 text-center">
            <h4 class="text-gray-600 text-sm">Used Pins</h4>
            <p class="text-2xl font-bold text-red-600">{{ $used }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-4 text-center">
            <h4 class="text-gray-600 text-sm">Available Pins</h4>
            <p class="text-2xl font-bold text-green-600">{{ $available }}</p>
        </div>
    </div>

    <!-- Pins Table -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold text-green-700 mb-4 flex items-center">
            <span class="w-2 h-6 bg-green-600 rounded mr-2"></span> Pins List
        </h2>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-800 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3">Pin</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Used By</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                @forelse($pins as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $p->pin }}</td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                        {{ $p->status === 'unused' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        @if($p->used_by)
                            <span class="text-green-600 font-medium">
                                @php 
                                    $user = \App\Models\User::find($p->used_by); 
                                    echo $user ? '<i class="ri-user-line mr-3 text-lg text-green-600"></i>'.$user->form_number : '---';
                                @endphp
                            </span>
                        @else 
                            ---
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        @if($p->status === 'unused')
                            <a href="{{ route('user.usePin', $p->pin) }}"
                               class="bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-semibold hover:bg-green-700 shadow">
                                Use Pin
                            </a>
                        @else
                            <span class="text-gray-500 text-xs">Used</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No pins assigned yet.</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
