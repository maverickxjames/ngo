<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-100 via-white to-green-50 flex items-center justify-center">

    <div class="w-full max-w-lg bg-white shadow-xl rounded-2xl p-8">
        <!-- Logo + Heading -->
        <div class="text-center mb-6">
                      <img src="{{ asset('assets/img/logo-main.jpg') }}" alt="NGO Logo" class="h-20 mx-auto">

            <h1 class="mt-4 text-2xl font-bold text-green-800">Join Our NGO</h1>
            <p class="text-sm text-gray-600">Register to become part of our community</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="block w-full rounded-lg border-2 border-gray-300 px-4 py-3 text-base font-medium shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="block w-full rounded-lg border-2 border-gray-300 px-4 py-3 text-base font-medium shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
<!-- Profile Picture -->
<div class="mb-5">
    <label for="profile_picture" class="block text-sm font-semibold text-gray-700 mb-2">Profile Picture</label>
    
    <!-- Upload Button -->
    <label for="profile_picture"
           class="cursor-pointer inline-block px-5 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1">
        Upload Photo
    </label>
    <input id="profile_picture" type="file" name="profile_picture" accept="image/*" 
           class="hidden" onchange="previewImage(event)">

    <!-- Preview -->
    <div id="previewWrapper" class="mt-4 hidden flex items-center space-x-4">
        <div class="relative">
            <img id="preview" src="" alt="Preview" class="w-24 h-24 object-cover border-2 border-gray-300 shadow rounded-lg">
            <!-- Delete Button -->
            <button type="button" onclick="removeImage()" 
                    class="absolute top-0 right-0 bg-red-600 text-white rounded-full p-1 text-xs shadow hover:bg-red-700">
                ✕
            </button>
        </div>
    </div>

    <!-- Warning Message -->
    <p id="imageWarning" class="mt-2 text-sm text-red-600 hidden">File must be less than 2 MB.</p>

    @error('profile_picture') 
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
    @enderror
</div>


            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                       class="block w-full rounded-lg border-2 border-gray-300 px-4 py-3 text-base font-medium shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-5">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="block w-full rounded-lg border-2 border-gray-300 px-4 py-3 text-base font-medium shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm text-green-700 hover:text-green-900">Already registered?</a>
                <button type="submit"
                        class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Register
                </button>
            </div>
        </form>

        <!-- Footer -->
        <p class="mt-6 text-center text-xs text-gray-500">© {{ date('Y') }} Our NGO. All rights reserved.</p>
    </div>
<!-- JS -->
<script>
function previewImage(event) {
    const file = event.target.files[0];
    const warning = document.getElementById('imageWarning');
    const previewWrapper = document.getElementById('previewWrapper');
    const preview = document.getElementById('preview');

    if (!file) return;

    // Check file size (2 MB = 2 * 1024 * 1024)
    if (file.size > 2 * 1024 * 1024) {
        warning.classList.remove('hidden');
        event.target.value = ""; // clear input
        previewWrapper.classList.add('hidden');
        preview.src = "";
        return;
    } else {
        warning.classList.add('hidden');
    }

    // Preview image
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
    const warning = document.getElementById('imageWarning');
    const preview = document.getElementById('preview');

    input.value = "";
    preview.src = "";
    previewWrapper.classList.add('hidden');
    warning.classList.add('hidden');
}
</script>
</body>
</html>
