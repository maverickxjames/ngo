<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Referral Code - अक्षरदान सेवा सोशल फाउंडेशन</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 via-white to-green-50">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border-t-8 border-green-600 text-center">
        <img src="{{ asset('assets/img/logo-main.png') }}" class="h-20 mx-auto mb-4">
        <h1 class="text-2xl font-bold text-green-800 mb-2">अक्षरदान सेवा सोशल फाउंडेशन</h1>
        <p class="text-sm text-gray-600 mb-6">अपना कार्यकर्ता क्रमांक (Referral Code) दर्ज करें</p>

        <form method="POST" action="{{ url('/register') }}" class="space-y-4">
            @csrf
            <input type="text" name="referral_code" placeholder="कार्यकर्ता क्रमांक"
                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 text-center text-lg font-medium uppercase tracking-wide" required>

            @error('referral_code')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror

            <button type="submit" class="w-full bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 transition">
                आगे बढ़ें (Continue)
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-600">आपके पास कार्यकर्ता क्रमांक नहीं है? <br>
            कृपया अपने निकटतम NGO सदस्य से संपर्क करें।</p>
    </div>
</body>
</html>
