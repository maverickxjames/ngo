@extends('layouts.admin')

@section('title', 'User Detail')

@section('content')
    <div class="flex" x-data="{ showMpinModal: false, showPersonalModal: false, showContactModal: false, showBankModal: false }">

        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <div class="flex-1 bg-gray-900 text-gray-100 min-h-screen p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">User Detail</h1>
                <a href="{{ route('admin.users') }}"
                    class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                    ← Back to Users
                </a>
            </div>

            <!-- Profile Card -->
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8 flex flex-col sm:flex-row sm:items-center gap-6">
                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('assets/img/photo.jpg') }}"
                    class="h-28 w-28 rounded-full border-2 border-green-600 object-cover">
                <div>
                    <h2 class="text-xl font-bold text-white">{{ $user->name }}</h2>
                    <p class="text-gray-400">Username : {{ $user->username }}</p>
                    <p class="text-sm text-gray-500 mt-1">Joined on
                        {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : 'N/A' }}</p>
                    <span
                        class="mt-2 inline-block px-3 py-1 rounded-full text-xs font-semibold 
                    {{ $user->status == 'active'
                        ? 'bg-green-600 text-white'
                        : ($user->status == 'pending'
                            ? 'bg-yellow-500 text-black'
                            : 'bg-red-600 text-white') }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </div>
            </div>

            <!-- User Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-800 rounded-xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-100">Personal Information</h3>
                        <button @click="showPersonalModal = true"
                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm font-medium transition">
                            <i class="ri-edit-2-line mr-1"></i> Edit
                        </button>
                    </div>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-semibold text-gray-400">Form Number:</span> {{ $user->form_number ?? 'N/A' }}
                        </p>
                        <p><span class="font-semibold text-gray-400">Guardian Name:</span>
                            {{ $user->guardian_name ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">DOB:</span> {{ $user->dob ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">Gender:</span> {{ ucfirst($user->gender ?? 'N/A') }}
                        </p>
                        <p><span class="font-semibold text-gray-400">Education:</span> {{ $user->education ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-100">Contact Information</h3>
                        <button @click="showContactModal  = true"
                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm font-medium transition">
                            <i class="ri-edit-2-line mr-1"></i> Edit
                        </button>
                    </div>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-semibold text-gray-400">Phone:</span> {{ $user->phone ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">Email:</span> {{ $user->email ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">Address:</span> {{ $user->address ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">Tehsil:</span> {{ $user->tehsil ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">District:</span> {{ $user->district ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">State:</span> {{ $user->state ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Referral Section -->
            {{-- <div class="bg-gray-800 rounded-xl p-6 shadow-lg mb-8"> --}}

            <!-- 🌐 Referral & MPIN Info -->
            <div class="bg-gray-800 rounded-xl p-6 mt-6 shadow-lg">
                <h3 class="text-lg font-semibold text-gray-100 border-b border-gray-700 pb-2 mb-4">Referral Information
                </h3>

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <!-- 🧾 Left Section: Referral Info -->
                    <div class="flex flex-wrap items-center gap-3 text-sm">
                        <div>
                            <span class="font-semibold text-gray-400">Referred By:</span>
                            @if ($user->referrer)
                                <a href="{{ route('admin.users.show', $user->referrer->id) }}"
                                    class="inline-flex items-center px-3 py-1 ml-2 bg-green-700 text-green-100 text-xs font-semibold rounded-full hover:bg-green-600 transition">
                                    <i class="ri-user-line mr-1 text-sm"></i>
                                    {{ ucfirst($user->referrer->name ?? $user->referrer->username) }}
                                </a>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 ml-2 bg-gray-700 text-gray-300 text-xs font-semibold rounded-full">
                                    N/A
                                </span>
                            @endif
                        </div>

                        <div>
                            <span class="font-semibold text-gray-400">Referral Code:</span>
                            <span onclick="navigator.clipboard.writeText('{{ $user->referral_code }}')"
                                class="inline-flex items-center px-3 py-1 ml-2 bg-blue-700 text-blue-100 text-xs font-semibold rounded-full hover:bg-blue-600 cursor-pointer transition">
                                <i class="ri-file-copy-line mr-1 text-sm"></i> {{ $user->referral_code ?? 'N/A' }}
                            </span>
                        </div>
                    </div>

                    <!-- 🔐 Right Section: MPIN -->
                    <div
                        class="bg-gray-900 p-4 rounded-xl shadow-inner flex flex-col sm:flex-row sm:items-center sm:gap-4 text-sm min-w-[260px]">
                        <div class="flex items-center">
                            <i class="ri-lock-password-line text-green-500 mr-2 text-lg"></i>
                            <span class="font-semibold text-gray-100">MPIN</span>
                        </div>
                        <div class="mt-2 sm:mt-0 flex items-center gap-2">
                            <span class="text-gray-400">Current:</span>
                            @if ($user->mpin)
                                <span class="bg-green-700 text-white text-xs px-3 py-1 rounded-full">Set</span>
                            @else
                                <span class="bg-red-700 text-white text-xs px-3 py-1 rounded-full">Not Set</span>
                            @endif

                            <button @click="showMpinModal = true"
                                class="bg-green-600 hover:bg-green-700 text-white text-xs font-semibold px-3 py-1 rounded transition">
                                {{ $user->mpin ? 'Update MPIN' : 'Set MPIN' }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div x-show="showMpinModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50"
                x-transition>
                <div class="bg-gray-800 rounded-xl shadow-2xl w-full max-w-sm p-6 relative">
                    <button @click="showMpinModal = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-200">
                        <i class="ri-close-line text-xl"></i>
                    </button>

                    <h2 class="text-lg font-bold text-white mb-4 flex items-center">
                        <i class="ri-key-2-line mr-2 text-green-500"></i>
                        {{ $user->mpin ? 'Update MPIN' : 'Set MPIN' }}
                    </h2>

                    <form method="POST" action="{{ route('admin.users.updateMpin', $user->id) }}">
                        @csrf
                        <label class="block text-sm text-gray-300 mb-2">Enter 4-digit MPIN</label>
                        <input type="password" name="mpin" maxlength="4" minlength="4" required
                            class="w-full border border-gray-600 bg-gray-900 rounded-lg px-4 py-2 text-center text-lg tracking-widest text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none">

                        <div class="mt-5 flex justify-end space-x-2">
                            <button type="button" @click="showMpinModal = false"
                                class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                Save MPIN
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- </div> --}}
            <br>

            <!-- Bank Details -->
            @if (!empty($user->bank_details))
                <div class="bg-gray-800 rounded-xl p-6 shadow-lg mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-100">Bank Detail</h3>
                        <button @click="showBankModal = true"
                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm font-medium transition">
                            <i class="ri-edit-2-line mr-1"></i> Edit
                        </button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <p><span class="font-semibold text-gray-400">Account Holder:</span>
                            {{ $user->bank_details['account_holder'] ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">Account Number:</span>
                            {{ $user->bank_details['account_number'] ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">IFSC:</span>
                            {{ $user->bank_details['ifsc'] ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">Bank Name:</span>
                            {{ $user->bank_details['bank_name'] ?? 'N/A' }}</p>
                        <p><span class="font-semibold text-gray-400">Branch:</span>
                            {{ $user->bank_details['branch_address'] ?? 'N/A' }}</p>
                    </div>
                </div>
            @endif

            <!-- Admin Actions -->
            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('admin.users') }}"
                    class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Back</a>

                <form method="POST" action="{{ route('admin.users.updateStatus', $user) }}">
                    @csrf
                    <select name="status"
                        class="rounded-lg bg-gray-800 border border-gray-600 text-sm px-2 py-1 focus:ring-green-500 focus:outline-none">
                        <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="rejected" {{ $user->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit"
                        class="ml-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
        <!-- ✏️ Personal Info Modal -->
        <div x-show="showPersonalModal" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50" x-transition>
            <div class="bg-gray-900 rounded-xl shadow-lg w-full max-w-lg p-6 relative text-gray-100">
                <button @click="showPersonalModal = false"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-200">
                    <i class="ri-close-line text-xl"></i>
                </button>

                <h3 class="text-lg font-bold mb-4 text-green-400 flex items-center">
                    <i class="ri-user-3-line mr-2 text-green-500"></i> Edit Personal Information
                </h3>

                <form method="POST" action="{{ route('admin.users.updatePersonal', $user->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm text-gray-400">Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-400">Guardian Name</label>
                        <input type="text" name="guardian_name" value="{{ $user->guardian_name }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-400">Date of Birth</label>
                            <input type="date" name="dob" value="{{ $user->dob }}"
                                class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400">Gender</label>
                            <select name="gender"
                                class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-400">Education</label>
                        <input type="text" name="education" value="{{ $user->education }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" @click="showPersonalModal = false"
                            class="px-4 py-2 bg-gray-700 text-gray-300 rounded hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- 🏠 Contact Info Modal -->
        <div x-show="showContactModal" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50" x-transition>
            <div class="bg-gray-900 rounded-xl shadow-lg w-full max-w-lg p-6 relative text-gray-100">
                <button @click="showContactModal = false"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-200">
                    <i class="ri-close-line text-xl"></i>
                </button>

                <h3 class="text-lg font-bold mb-4 text-green-400 flex items-center">
                    <i class="ri-phone-line mr-2 text-green-500"></i> Edit Contact Information
                </h3>

                <form method="POST" action="{{ route('admin.users.updateContact', $user->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm text-gray-400">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-400">Phone</label>
                        <input type="text" name="phone" value="{{ $user->phone }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-400">Address</label>
                        <textarea name="address" rows="2"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">{{ $user->address }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-400">Tehsil</label>
                            <input type="text" name="tehsil" value="{{ $user->tehsil }}"
                                class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400">District</label>
                            <input type="text" name="district" value="{{ $user->district }}"
                                class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-400">State</label>
                        <input type="text" name="state" value="{{ $user->state }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" @click="showContactModal = false"
                            class="px-4 py-2 bg-gray-700 text-gray-300 rounded hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- 🏦 Bank Info Modal -->
        <!-- 🏦 Bank Info Modal -->
        <div x-show="showBankModal" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50" x-transition>
            <div class="bg-gray-900 rounded-xl shadow-lg w-full max-w-lg p-6 relative text-gray-100">
                <button @click="showBankModal = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-200">
                    <i class="ri-close-line text-xl"></i>
                </button>

                <h3 class="text-lg font-bold mb-4 text-green-400 flex items-center">
                    <i class="ri-bank-line mr-2 text-green-500"></i> Edit Bank Details
                </h3>

                <form method="POST" action="{{ route('admin.users.updateBank', $user->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Account Holder -->
                    <div>
                        <label class="block text-sm text-gray-400">Account Holder Name</label>
                        <input type="text" name="account_holder"
                            value="{{ old('account_holder', $user->bank_details['account_holder'] ?? '') }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border @error('account_holder') border-red-500 @else border-gray-700 @enderror focus:ring-green-500 focus:border-green-500">
                        @error('account_holder')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Account Number + IFSC -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-400">Account Number</label>
                            <input type="text" name="account_number"
                                value="{{ old('account_number', $user->bank_details['account_number'] ?? '') }}"
                                class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border @error('account_number') border-red-500 @else border-gray-700 @enderror focus:ring-green-500 focus:border-green-500">
                            @error('account_number')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400">IFSC Code</label>
                            <input type="text" name="ifsc" onblur="fetchBankDetails()"
                                value="{{ old('ifsc', $user->bank_details['ifsc'] ?? '') }}"
                                class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border @error('ifsc') border-red-500 @else border-gray-700 @enderror focus:ring-green-500 focus:border-green-500">
                            @error('ifsc')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bank Name + Branch -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-400">Bank Name</label>
                            <input type="text" name="bank_name"
                                value="{{ old('bank_name', $user->bank_details['bank_name'] ?? '') }}"
                                class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border @error('bank_name') border-red-500 @else border-gray-700 @enderror focus:ring-green-500 focus:border-green-500">
                            @error('bank_name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400">Branch</label>
                            <input type="text" name="branch"
                                value="{{ old('branch', $user->bank_details['branch'] ?? '') }}"
                                class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border @error('branch') border-red-500 @else border-gray-700 @enderror focus:ring-green-500 focus:border-green-500">
                            @error('branch')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Branch Address -->
                    <div>
                        <label class="block text-sm text-gray-400">Branch Address</label>
                        <input type="text" name="branch_address"
                            value="{{ old('branch_address', $user->bank_details['branch_address'] ?? '') }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border @error('branch_address') border-red-500 @else border-gray-700 @enderror focus:ring-green-500 focus:border-green-500">
                        @error('branch_address')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PAN Number -->
                    <div>
                        <label class="block text-sm text-gray-400">PAN Number</label>
                        <input type="text" name="pan_number"
                            value="{{ old('pan_number', $user->bank_details['pan_number'] ?? '') }}"
                            class="w-full mt-1 px-3 py-2 rounded-lg bg-gray-800 border @error('pan_number') border-red-500 @else border-gray-700 @enderror focus:ring-green-500 focus:border-green-500 uppercase">
                        @error('pan_number')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" @click="showBankModal = false"
                            class="px-4 py-2 bg-gray-700 text-gray-300 rounded hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- ✅ Toast Notification -->
        <div x-data="{ show: false, message: '', type: 'success' }" x-show="show" x-transition x-init="@if (session('status')) message = '{{ session('status') }}';
            type = '{{ session('status_type', 'success') }}';
            show = true;
            setTimeout(() => show = false, 4000); @endif"
            class="fixed top-5 right-5 z-50" style="display: none;">
            <div x-bind:class="type === 'success'
                ?
                'bg-green-600 border-l-4 border-green-400 text-white' :
                'bg-red-600 border-l-4 border-red-400 text-white'"
                class="rounded-lg shadow-lg px-5 py-3 flex items-center space-x-3 min-w-[260px]">
                <i x-bind:class="type === 'success' ? 'ri-checkbox-circle-line' : 'ri-error-warning-line'"
                    class="text-xl"></i>
                <span x-text="message" class="text-sm font-medium"></span>
            </div>
        </div>

        @if ($errors->any())
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed top-5 right-5 bg-red-700 text-white border-l-4 border-red-400 rounded-lg shadow-lg px-5 py-3 z-50">
                <div class="flex items-center space-x-3">
                    <i class="ri-error-warning-line text-xl"></i>
                    <div>
                        <span class="font-semibold">Validation Error</span>
                        <ul class="list-disc list-inside text-sm text-red-100 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif



    </div>
    <script>
function fetchBankDetails() {
    const ifsc = document.querySelector('input[name="ifsc"]').value.trim();
    if (!ifsc) return;
    fetch(`https://ifsc.razorpay.com/${ifsc}`)
        .then(res => res.json())
        .then(data => {
            document.querySelector('input[name="bank_name"]').value = data.BANK || '';
            document.querySelector('input[name="branch"]').value = data.BRANCH || '';
            document.querySelector('input[name="branch_address"]').value = data.ADDRESS || '';
        })
        .catch(() => alert('Invalid IFSC code.'));
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection
