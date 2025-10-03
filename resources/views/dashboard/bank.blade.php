@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 space-y-6" x-data="{ showModal: false }">

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    @if(!empty($user->bank_details) && isset($user->bank_details['account_number']))
        <!-- Show Bank Details Card -->
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-bold text-green-700 mb-4">Your Bank Details</h2>

            <div class="space-y-2 text-gray-700">
                <p><span class="font-semibold">Account Number:</span> 
                   ****{{ substr($user->bank_details['account_number'], -4) }}</p>
                <p><span class="font-semibold">IFSC:</span> {{ strtoupper($user->bank_details['ifsc']) }}</p>
                <p><span class="font-semibold">Account Holder:</span> {{ $user->bank_details['account_holder'] }}</p>
            </div>

            <div class="mt-6">
                <button @click="showModal = true"
                        class="px-6 py-2 bg-orange-500 text-white rounded-lg shadow hover:bg-orange-600 font-semibold">
                    Edit Bank Details
                </button>
            </div>
        </div>
    @else
        <!-- Add Bank Details Card -->
        <div class="bg-white shadow-lg rounded-xl p-8">
            <h2 class="text-2xl font-bold text-green-700 mb-6">Add Bank Details</h2>

            <button @click="showModal = true"
                    class="w-full sm:w-auto px-6 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 font-semibold">
                Add Bank Details
            </button>
        </div>
    @endif

    <!-- Modal -->
    <div x-show="showModal" 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
         x-transition>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 relative">
            
            <!-- Close Button -->
            <button @click="showModal = false" 
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                ✕
            </button>

            <h2 class="text-xl font-bold text-green-700 mb-4">Bank Details</h2>

            <form method="POST" action="{{ route('bank.update') }}" class="space-y-6">
                @csrf

                <!-- Account Number -->
                <div>
                    <label for="account_number" class="block text-sm font-medium text-gray-700">Account Number</label>
                    <input type="text" name="account_number" id="account_number"
                           value="{{ $user->bank_details['account_number'] ?? '' }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                    @error('account_number')
                        <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- IFSC -->
                <div>
                    <label for="ifsc" class="block text-sm font-medium text-gray-700">IFSC Code</label>
                    <input type="text" name="ifsc" id="ifsc"
                           value="{{ $user->bank_details['ifsc'] ?? '' }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm uppercase">
                    @error('ifsc')
                        <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Account Holder -->
                <div>
                    <label for="account_holder" class="block text-sm font-medium text-gray-700">Account Holder Name</label>
                    <input type="text" name="account_holder" id="account_holder"
                           value="{{ $user->bank_details['account_holder'] ?? '' }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                    @error('account_holder')
                        <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Save Button -->
                <div class="pt-4">
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 font-semibold">
                        Save Bank Details
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
