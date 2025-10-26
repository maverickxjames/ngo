@extends('layouts.app')

@section('title', 'Verify MPIN')

@section('content')
<div id="mpin-wrapper" class="min-h-[80vh] flex items-center justify-center bg-gradient-to-br from-green-100 via-white to-orange-50 px-4 transition-all duration-300">
    <div class="bg-white shadow-2xl rounded-2xl p-8 max-w-md w-full border-t-4 border-green-600 animate-fadeIn" id="mpin-box">

        <!-- Header -->
        <div class="text-center mb-6">
            <img src="{{ asset('assets/img/logo-main.png') }}" alt="NGO Logo" class="h-20 mx-auto">
            <h1 class="text-2xl font-bold text-green-800 mt-4">Enter Your MPIN</h1>
            <p class="text-gray-600 text-sm mt-1">Secure access to your account</p>
        </div>

        <!-- Form -->
        <form id="mpin-form" method="POST" action="{{ route('mpin.verify') }}">
            @csrf

            <div class="flex justify-center space-x-3 my-6">
                @for ($i = 0; $i < 4; $i++)
                    <input type="password" maxlength="1" inputmode="numeric" pattern="[0-9]*"
                        class="w-14 h-14 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg
                               focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all duration-150 ease-in-out
                               hover:border-green-400"
                        name="mpin_digits[]" required>
                @endfor
            </div>

            @error('mpin')
                <p class="text-center text-red-600 text-sm mb-3 animate-pulse">{{ $message }}</p>
            @enderror

            <button type="submit"
                class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 ease-in-out focus:ring-4 focus:ring-green-300">
                Verify MPIN
            </button>

            <div class="mt-4 text-center">
                <a href="#0" class="text-sm text-orange-600 hover:text-orange-700 font-medium transition">
                    Forgot MPIN?
                </a>
            </div>
        </form>
    </div>
</div>

<!-- 🌀 Loader (Hidden by Default) -->
<div id="redirect-loader" class="fixed inset-0 flex flex-col items-center justify-center bg-gray-900 bg-opacity-90 text-white z-50 hidden">
    <div class="loader"></div>
    <p class="mt-6 text-lg font-semibold tracking-wide animate-fadeIn">Redirecting to your dashboard...</p>
</div>

<!-- 🎯 Script -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const inputs = document.querySelectorAll('input[name="mpin_digits[]"]');
    inputs[0].focus();

    // Move between inputs
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

    // 🎬 Show loader after successful submit
    const form = document.getElementById('mpin-form');
    form.addEventListener('submit', () => {
        document.getElementById('mpin-box').classList.add('scale-95', 'opacity-50');
        setTimeout(() => {
            document.getElementById('mpin-wrapper').style.display = 'none';
            document.getElementById('redirect-loader').classList.remove('hidden');
        }, 400);
    });
});
</script>

<!-- 💫 Animations & Loader CSS -->
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.6s ease-in-out;
}

/* Loader Spinner */
.loader {
    width: 60px;
    height: 60px;
    border: 5px solid rgba(255, 255, 255, 0.2);
    border-top-color: #22c55e;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
@endsection
