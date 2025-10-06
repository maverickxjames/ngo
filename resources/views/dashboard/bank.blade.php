@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 space-y-6" x-data="{ showModal: false, loading: false }">

    <!-- ✅ Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    @if(!empty($user->bank_details) && isset($user->bank_details['account_number']))
        <!-- ✅ Existing Bank Details -->
        <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-green-600">
            <h2 class="text-xl font-bold text-green-700 mb-4">Your Bank Details</h2>

            <div class="space-y-2 text-gray-700">
                <p><span class="font-semibold">Account Number:</span> ****{{ substr($user->bank_details['account_number'], -4) }}</p>
                <p><span class="font-semibold">IFSC:</span> {{ strtoupper($user->bank_details['ifsc']) }}</p>
                <p><span class="font-semibold">Bank:</span> {{ $user->bank_details['bank_name'] ?? 'N/A' }}</p>
                <p><span class="font-semibold">Branch:</span> {{ $user->bank_details['branch'] ?? 'N/A' }}</p>
                <p><span class="font-semibold">Address:</span> {{ $user->bank_details['branch_address'] ?? 'N/A' }}</p>
                <p><span class="font-semibold">Account Holder:</span> {{ $user->bank_details['account_holder'] }}</p>
                <p><span class="font-semibold">PAN:</span> {{ strtoupper($user->bank_details['pan_number'] ?? 'N/A') }}</p>
            </div>

            <div class="mt-6">
                <button @click="showModal = true"
                        class="px-6 py-2 bg-orange-500 text-white rounded-lg shadow hover:bg-orange-600 font-semibold">
                    ✏️ Edit Bank Details
                </button>
            </div>
        </div>
    @else
        <!-- ✅ Add Bank Button -->
        <div class="bg-white shadow-lg rounded-xl p-8 text-center border-l-4 border-green-600">
            <h2 class="text-2xl font-bold text-green-700 mb-6">Add Bank Details</h2>
            <button @click="showModal = true"
                    class="px-6 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 font-semibold">
                ➕ Add Bank Details
            </button>
        </div>
    @endif

    <!-- ✅ Modal -->
    <div x-show="showModal"
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
         x-transition>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 relative overflow-y-auto max-h-[90vh]">

            <!-- Close Button -->
            <button @click="showModal = false"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">✕</button>

            <h2 class="text-xl font-bold text-green-700 mb-4">Update Bank Details</h2>

            <form method="POST" action="{{ route('bank.update') }}" class="space-y-5">
                @csrf

                <!-- IFSC -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">IFSC Code</label>
                    <div class="relative">
                        <input type="text" name="ifsc" id="ifsc"
                               value="{{ $user->bank_details['ifsc'] ?? '' }}"
                               onblur="fetchBankDetails()"
                               placeholder="Enter 11-digit IFSC"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm uppercase pr-10">
                        <div id="ifscLoader" class="hidden absolute inset-y-0 right-3 flex items-center">
                            <svg class="animate-spin h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('ifsc')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bank Info (Auto-Filled) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Bank Name</label>
                    <input type="text" name="bank_name" id="bank_name" readonly
                           class="mt-1 block w-full rounded-lg border-gray-200 bg-gray-50 shadow-sm sm:text-sm text-gray-600">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Branch</label>
                    <input type="text" name="branch" id="branch" readonly
                           class="mt-1 block w-full rounded-lg border-gray-200 bg-gray-50 shadow-sm sm:text-sm text-gray-600">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Branch Address</label>
                    <textarea name="branch_address" id="branch_address" readonly rows="2"
                              class="mt-1 p-4 block w-full rounded-lg border-gray-200 bg-gray-50 shadow-sm sm:text-sm text-gray-600"></textarea>
                </div>

                <!-- Account Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Account Number</label>
                    <input type="text" name="account_number" id="account_number"
                           value="{{ $user->bank_details['account_number'] ?? '' }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @error('account_number')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Account Holder -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Account Holder Name</label>
                    <input type="text" name="account_holder" id="account_holder"
                           value="{{ $user->bank_details['account_holder'] ?? '' }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @error('account_holder')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PAN Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">PAN Number</label>
                    <input type="text" name="pan_number" id="pan_number"
                           value="{{ $user->bank_details['pan_number'] ?? '' }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm uppercase">
                    @error('pan_number')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Save -->
                <div class="pt-4">
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 font-semibold">
                        💾 Save Bank Details
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ✅ JS Script -->
<script>
function fetchBankDetails() {
    const ifsc = document.getElementById('ifsc').value.trim().toUpperCase();
    if (!ifsc || ifsc.length !== 11) return;

    const loader = document.getElementById('ifscLoader');
    loader.classList.remove('hidden');

    fetch(`https://ifsc.razorpay.com/${ifsc}`)
        .then(res => {
            if (!res.ok) throw new Error('Invalid IFSC');
            return res.json();
        })
        .then(data => {
            document.getElementById('bank_name').value = data.BANK || '';
            document.getElementById('branch').value = data.BRANCH || '';
            document.getElementById('branch_address').value = data.ADDRESS ? `${data.BRANCH}, ${data.ADDRESS}` : '';
        })
        .catch(() => {
            alert('⚠️ Invalid IFSC code. Please check and try again.');
            document.getElementById('bank_name').value = '';
            document.getElementById('branch').value = '';
            document.getElementById('branch_address').value = '';
        })
        .finally(() => {
            loader.classList.add('hidden');
        });
}
</script>
@endsection
