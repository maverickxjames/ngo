<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-100 via-white to-green-50 flex items-center justify-center">

    <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
        <!-- Logo + Heading -->
        <div class="text-center mb-6">
            <img src="{{ asset('assets/img/logo-main.jpg') }}" alt="NGO Logo" class="h-20 mx-auto">
            <h1 class="mt-4 text-2xl font-bold text-green-800">Welcome Back</h1>
            <p class="text-sm text-gray-600">Login to continue your work with us</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div class="mb-5">
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                       class="mt-1 block w-full rounded-lg border-2 border-gray-300 px-4 py-3 text-base font-medium shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('username')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                       class="mt-1 block w-full rounded-lg border-2 border-gray-300 px-4 py-3 text-base font-medium shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-6">
                <input id="remember_me" type="checkbox" name="remember"
                       class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-green-700 hover:text-green-900">Forgot password?</a>
                @endif
                <button type="submit"
                        class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Log in
                </button>
            </div>
        </form>

        <!-- Footer -->
        <p class="mt-6 text-center text-xs text-gray-500">© {{ date('Y') }} Our NGO. All rights reserved.</p>
    </div>

</body>
</html>
