<section class="bg-white shadow-md rounded-xl p-6">
    <header class="mb-4 border-b pb-2">
        <h2 class="text-xl font-bold text-green-700 flex items-center space-x-2">
            <i class="ri-user-3-line text-green-600"></i>
            <span>प्रोफ़ाइल जानकारी (Profile Information)</span>
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            अपने अकाउंट की व्यक्तिगत जानकारी अपडेट करें। नीचे दी गई कुछ जानकारी केवल देखने के लिए है।
        </p>
    </header>

    <!-- Email Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- 🔹 Read-only Information -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-lg border">
            <!-- Form Number -->
            <div>
                <x-input-label for="form_number" :value="__('Form Number')" />
                <x-text-input id="form_number" type="text" name="form_number"
                    class="mt-1 block w-full bg-gray-100 border-gray-200 text-gray-600 rounded-lg cursor-not-allowed"
                    :value="old('form_number', $user->form_number)" disabled />
            </div>

            <!-- Referral Code -->
            <div>
                <x-input-label for="referral_code" :value="__('Referral Code')" />
                <x-text-input id="referral_code" type="text" name="referral_code"
                    class="mt-1 block w-full bg-gray-100 border-gray-200 text-gray-600 rounded-lg cursor-not-allowed"
                    :value="old('referral_code', $user->referral_code)" disabled />
            </div>

            <!-- Mobile -->
            <div>
                <x-input-label for="phone" :value="__('Mobile Number')" />
                <x-text-input id="phone" type="text" name="phone"
                    class="mt-1 block w-full bg-gray-100 border-gray-200 text-gray-600 rounded-lg cursor-not-allowed"
                    :value="old('phone', $user->phone)" disabled />
            </div>
        </div>

        <!-- 🔹 Editable Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
                <x-input-label for="name" :value="__('Full Name (पूरा नाम)')" />
                <x-text-input id="name" name="name" type="text"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Guardian Name -->
            <div>
                <x-input-label for="guardian_name" :value="__('Guardian Name (अभिभावक का नाम)')" />
                <x-text-input id="guardian_name" name="guardian_name" type="text"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                    :value="old('guardian_name', $user->guardian_name)" autocomplete="guardian_name" />
                <x-input-error class="mt-2" :messages="$errors->get('guardian_name')" />
            </div>

            <!-- Date of Birth -->
            <div>
                <x-input-label for="dob" :value="__('Date of Birth (जन्म तिथि)')" />
                <x-text-input id="dob" name="dob" type="date"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                    :value="old('dob', $user->dob)" />
                <x-input-error class="mt-2" :messages="$errors->get('dob')" />
            </div>

            <!-- Gender -->
            <div>
                <x-input-label for="gender" :value="__('Gender (लिंग)')" />
                <select id="gender" name="gender"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>

            <!-- Education -->
            <div class="md:col-span-2">
                <x-input-label for="education" :value="__('Education (शैक्षणिक योग्यता)')" />
                <x-text-input id="education" name="education" type="text"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                    :value="old('education', $user->education)" />
                <x-input-error class="mt-2" :messages="$errors->get('education')" />
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <x-input-label for="address" :value="__('Full Address (पूरा पता)')" />
                <textarea id="address" name="address" rows="2"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('address', $user->address) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <!-- Tehsil -->
            <div>
                <x-input-label for="tehsil" :value="__('Tehsil (तहसील)')" />
                <x-text-input id="tehsil" name="tehsil" type="text"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                    :value="old('tehsil', $user->tehsil)" />
                <x-input-error class="mt-2" :messages="$errors->get('tehsil')" />
            </div>

            <!-- District -->
            <div>
                <x-input-label for="district" :value="__('District (जिला)')" />
                <x-text-input id="district" name="district" type="text"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                    :value="old('district', $user->district)" />
                <x-input-error class="mt-2" :messages="$errors->get('district')" />
            </div>

            <!-- State -->
            <div class="md:col-span-2">
                <x-input-label for="state" :value="__('State (राज्य)')" />
                <x-text-input id="state" name="state" type="text"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                    :value="old('state', $user->state)" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4 pt-4 border-t">
            <button type="submit"
                class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-600 font-semibold">
                    {{ __('Saved!') }}
                </p>
            @endif
        </div>
    </form>
</section>
