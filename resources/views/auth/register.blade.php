<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Registration - अक्षरदान सेवा सोशल फाउंडेशन</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-green-100 via-white to-green-50 flex items-center justify-center">
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-2xl p-8 border-t-8 border-green-600">
        <!-- Header -->
        <div class="text-center mb-6">
            <img src="{{ asset('assets/img/logo-main.png') }}" alt="NGO Logo" class="h-20 mx-auto">
            <h1 class="mt-3 text-2xl font-bold text-green-800">अक्षरदान सेवा सोशल फाउंडेशन</h1>
            <p class="text-sm text-gray-600">पंजीकरण फॉर्म (Registration Form)</p>
        </div>

        <!-- Sponsor / कार्यकर्ता Info -->
        <div
            class="flex items-center justify-between bg-gradient-to-r from-green-50 to-orange-50 border border-green-200 rounded-xl p-4 mb-6 shadow-sm">
            <div class="flex items-center space-x-3">
                <div
                    class="bg-green-600 text-white rounded-full h-10 w-10 flex items-center justify-center font-semibold uppercase">
                    {{ strtoupper(substr($referrer->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm text-gray-600">कार्यकर्ता / Sponsor</p>
                    <p class="text-base font-bold text-green-800">{{ $referrer->name }}</p>
                    <p class="text-xs text-gray-500">Referral Code: <span class="font-semibold text-orange-600">{{
                            $referrer->referral_code }}</span></p>
                </div>
            </div>
            <div class="hidden sm:block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 opacity-80" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>


        <!-- Register Form -->

        <form method="POST" action="{{ route('register.store', ['referral' => $referrer->referral_code]) }}"
            class="space-y-5" enctype="multipart/form-data">

            @csrf

            <!-- form_number -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">फॉर्म न. *</label>
                <input type="text" name="form_number" value="{{ old('form_number') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                @error('form_number')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">नाम *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">

                @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">यूजरनाम *</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">

                @error('username')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Father/Husband/Brother -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">पिता / पति / भाई का नाम *</label>
                <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                @error('guardian_name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Birth / Gender / Education -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">जन्मतिथि *</label>
                    <input type="date" name="dob"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">

                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">लिंग *</label>
                    <select name="gender"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                        <option value="">-- चुनें --</option>
                        <option value="male">पुरुष</option>
                        <option value="female">महिला</option>
                        <option value="other">अन्य</option>
                    </select>


                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">शिक्षा *</label>
                    <input type="text" name="education" value="{{ old('education') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">

                </div>
                @error('dob')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                @error('education')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                @error('gender')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">पता *</label>
                <textarea name="address" rows="2"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500"></textarea>
                @error('address')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tehsil / District / State -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">तहसील *</label>
                    <input type="text" name="tehsil"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">जिला *</label>
                    <input type="text" name="district"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">राज्य *</label>
                    <input type="text" name="state"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                </div>
                @error('tehsil')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('district')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('state')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone / PAN / Referral -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">मोबाइल नंबर *</label>
                    <input type="text" name="phone"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">

                </div>

                @error('phone')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile Photo -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">प्रोफ़ाइल फोटो अपलोड करें *</label>
                <label for="profile_picture"
                    class="cursor-pointer inline-block px-5 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700">
                    Upload Photo
                </label>
                <input id="profile_picture" type="file" name="profile_picture" accept="image/*" class="hidden"
                    onchange="previewImage(event)">
                <div id="previewWrapper" class="mt-4 hidden flex items-center space-x-4">
                    <div class="relative">
                        <img id="preview" src="" alt="Preview"
                            class="w-24 h-24 object-cover border-2 border-gray-300 shadow rounded-lg">
                        <button type="button" onclick="removeImage()"
                            class="absolute top-0 right-0 bg-red-600 text-white rounded-full p-1 text-xs shadow hover:bg-red-700">
                            ✕
                        </button>
                    </div>
                </div>
                <p id="imageWarning" class="mt-2 text-sm text-red-600 hidden">File must be less than 2 MB.</p>
                @error('profile_picture')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">पासवर्ड *</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">पासवर्ड की पुष्टि करें *</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                </div>
                @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('password_confirmation')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Register Button -->
            <div class="text-center pt-4">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-600 to-orange-500 text-white font-bold py-3 rounded-lg shadow hover:opacity-90 transition">
                    पंजीकरण करें (Register)
                </button>
            </div>

            <!-- Already Registered -->
            <p class="text-center text-sm mt-4">
                पहले से सदस्य हैं?
                <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:underline">Login करें</a>
            </p>
        </form>
    </div>

    <script>
        // same preview/remove logic
        function previewImage(event) {
            const file = event.target.files[0];
            const warning = document.getElementById('imageWarning');
            const previewWrapper = document.getElementById('previewWrapper');
            const preview = document.getElementById('preview');

            if (!file) return;
            if (file.size > 2 * 1024 * 1024) {
                warning.classList.remove('hidden');
                event.target.value = "";
                previewWrapper.classList.add('hidden');
                preview.src = "";
                return;
            } else {
                warning.classList.add('hidden');
            }
            const reader = new FileReader();
            reader.onload = function(){
                preview.src = reader.result;
                previewWrapper.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        function removeImage() {
            const input = document.getElementById('profile_picture');
            const previewWrapper = document.getElementById('previewWrapper');
            const preview = document.getElementById('preview');
            const warning = document.getElementById('imageWarning');
            input.value = "";
            preview.src = "";
            previewWrapper.classList.add('hidden');
            warning.classList.add('hidden');
        }
    </script>
</body>

</html>