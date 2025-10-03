@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-10">



        <div x-data="{ openIdCard: false }">
            <!-- Welcome Banner -->

            <div class="bg-gradient-to-r from-green-600 to-orange-500 text-white p-8 rounded-2xl shadow-lg">
                <h1 class="text-2xl font-bold">Welcome, {{ $user->name }}</h1>
                <p class="mt-2 text-sm">
                    Status:
                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-white text-green-700">
                        {{ ucfirst($user->status) }}
                    </span>
                </p>
                <p class="mt-2 text-sm">
                    Form No:
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white text-orange-700">
                        {{ $user->form_number }}
                    </span>
                </p>

                <!-- Button to open ID card -->
                <button @click="openIdCard = true"
                    class="mt-4 px-6 py-2 bg-white text-green-700 font-semibold rounded-lg shadow hover:bg-gray-100 transition">
                    View Digital Identity Card
                </button>
            </div>

            <!-- Modal -->
            <div x-show="openIdCard" x-cloak
                class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="bg-white w-[340px] h-[540px] rounded-xl shadow-xl overflow-hidden relative flex flex-col">

                    <!-- Close -->
                    <button @click="openIdCard = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-600">
                        ✕
                    </button>

                    <!-- Top Section -->
                    <div class="flex items-center bg-gradient-to-r from-green-600 to-orange-500 text-white px-4 py-6">
                        <img src="{{ asset('assets/img/logo-main.png') }}" class="h-10 w-10 rounded bg-white p-1">
                        <div class="ml-3">
                            <h2 class="font-bold text-lg leading-tight">अक्षरदान सोशल सेवा फाउंडेशन</h2>
                            <p class="text-sm font-bold">IDENTITY CARD</p>
                        </div>
                    </div>

                    {{--
                    <!-- DP -->
                    <div class="flex justify-center mt-4">
                        <div class="w-28 h-34 overflow-hidden border-4 border-orange-500 shadow-md">
                            <img src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : asset('assets/img/photo.jpg') }}"
                                alt="User Photo" class="w-full h-full object-cover">
                        </div>
                    </div> --}}

                    <!-- DP with Mohar -->
                    <div class="flex flex-col items-center mt-4 relative">
                        <!-- Profile Picture -->
                        <div class="w-28 h-34 overflow-hidden border-4 border-orange-500 shadow-md relative z-10">
                            <img src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : asset('assets/img/photo.jpg') }}"
                                alt="User Photo" class="w-full h-full object-cover">
                        </div>

                        <!-- Mohar / Seal -->
                        <img src="{{ asset('assets/img/approved.png') }}" class="absolute top-20 w-24 h-24"
                            style="left: 50%; transform: translateX(-20%) rotate(-5deg);z-index:10" alt="Seal">

                        <!-- Designation -->
                        <p class="mt-3 text-sm font-semibold text-gray-700">
                            {{ ucfirst($user->designation ?? 'DISTRICT COORDINATOR') }}
                        </p>
                    </div>



                    <!-- Info + QR -->
                    <div class="flex flex-1 px-5 mt-5">
                        <!-- Info -->
                        <div class="flex-1 text-sm space-y-2">
                            <p><span class="font-bold">Name:</span> {{ $user->name }}</p>
                            <p><span class="font-bold">Form No:</span> NGO/AKDN/{{ $user->form_number }}</p>
                            <p><span class="font-bold">Unique Code: </span> <span class="text-red-500 font-extrabold">{{
                                    $user->referral_code }}</span> </p>
                            <p><span class="font-bold">Phone:</span> {{ $user->phone ?? '9588221390' }}</p>
                            <p><span class="font-bold">Expiry:</span> {{ now()->addYear()->format('d M Y') }}</p>
                        </div>

                        <!-- QR -->
                        <div class="ml-4 mt-4 flex items-start">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data=NGO/AKDN/{{ urlencode($user->form_no ?? 'N/A') }}{{ uniqid() }}"
                                alt="QR Code" class="h-24 w-24">
                        </div>
                    </div>

                    <!-- Signature -->
                    <div class="bg-gray-100 px-5 py-3 text-center border-t">
                        <img src="{{ asset('assets/img/signature.png') }}" alt="Signature" class="h-10 mx-auto">
                        <p class="text-xs text-gray-600 mt-1 font-bold">Authorized Signatory</p>
                    </div>
                </div>
            </div>
        </div>

            <!-- Action Buttons -->
    {{-- <div class="flex justify-center gap-4 mt-4">
        <button onclick="printIdCard()"
            class="px-5 py-2 bg-orange-500 text-white rounded-md shadow hover:bg-orange-600 transition">
            🖨️ Print
        </button>
        <button onclick="downloadIdCard()"
            class="px-5 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition">
            ⬇️ Download
        </button>
    </div> --}}




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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                </svg>
                <div>
                    <h2 class="text-xl font-bold text-red-600">Account Rejected</h2>
                    <p class="mt-2 text-gray-600">Your activation request has been rejected. Please contact support for
                        more details.</p>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-600 opacity-80" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 8c-1.657 0-3 1.343-3 3v1.25H8.5A2.5 2.5 0 006 14.75v0A2.5 2.5 0 008.5 17.25H9v.75a3 3 0 003 3h0a3 3 0 003-3v-.75h.5a2.5 2.5 0 002.5-2.5v0a2.5 2.5 0 00-2.5-2.5H15V11c0-1.657-1.343-3-3-3z" />
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
                <p class="mt-2 text-3xl font-bold text-green-800">₹{{ number_format($directIncome + $teamIncome, 2) }}
                </p>
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