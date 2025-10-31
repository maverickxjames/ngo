@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-gradient-to-br from-green-100 via-white to-orange-50 px-4">
    <div class="bg-white shadow-2xl rounded-2xl p-8 max-w-md w-full border-t-4 border-green-600">
        
        <!-- Header -->
        <div class="text-center mb-6">
            <img src="{{ asset('assets/img/logo-main.png') }}" alt="NGO Logo" class="h-20 mx-auto">
            <h1 class="text-2xl font-bold text-green-800 mt-4">PIN Activation</h1>
            <p class="text-gray-600 text-sm mt-1">खाता सक्रिय करने के लिए PIN दर्ज करें</p>
        </div>

        <!-- Info Alert -->
        @if(session('warning'))
            <p class="mb-3 text-sm text-red-700 bg-red-100 px-3 py-2 rounded">
                {{ session('warning') }}
            </p>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('user.activate-pin.submit') }}">
            @csrf

            <div class="flex justify-center space-x-3 my-6">
                @for ($i = 1; $i <= 6; $i++)
                    <input type="password" maxlength="1" inputmode="numeric" pattern="[0-9]*"
                        class="w-14 h-14 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg
                               focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                        name="pin_digits[]" required>
                @endfor
            </div>

            @error('pin')
                <p class="text-center text-red-600 text-sm mb-3">{{ $message }}</p>
            @enderror

            <button type="submit"
                class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition">
                Activate Account
            </button>

            <div class="mt-4 text-center">
                <a href="{{ route('dashboard') }}" class="text-sm text-orange-600 hover:text-orange-700 font-medium">
                    वापस जाएँ / Go back
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Autofocus Script -->
<script>
    const inputs = document.querySelectorAll('input[name="pin_digits[]"]');

    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });
</script>
@endsection
