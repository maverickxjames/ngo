@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-orange-500 p-6 rounded-xl shadow-lg text-white">
        <h1 class="text-3xl font-bold">Privacy Policy</h1>
        <p class="mt-2 text-sm">अक्षरदान सोशल सेवा फाउंडेशन (Akshardan Social Seva Foundation)</p>
    </div>

    <!-- Intro -->
    <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
        <p class="text-gray-700 leading-relaxed">
            We at <span class="font-semibold text-green-700">अक्षरदान सोशल सेवा फाउंडेशन</span> are committed to protecting 
            your privacy. This Privacy Policy explains how we collect, use, and safeguard your personal information 
            when you interact with our website, services, and programs.
        </p>
    </div>

    <!-- Sections -->
    <div class="bg-white p-6 rounded-xl shadow-md space-y-6">
        
        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">1. Information We Collect</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Personal details such as name, email, phone number, and address when you register or donate.</li>
                <li>Bank or payment details when making contributions.</li>
                <li>Technical data like IP address, browser, and device type for security and analytics.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">2. How We Use Your Information</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>To process donations and provide receipts.</li>
                <li>To communicate updates about our NGO programs and activities.</li>
                <li>To comply with legal and financial obligations.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">3. Data Security</h2>
            <p class="text-gray-700">
                We use appropriate security measures to protect your personal data against unauthorized access, 
                alteration, disclosure, or destruction. However, no online transmission is completely secure.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">4. Sharing of Information</h2>
            <p class="text-gray-700">
                We do not sell, trade, or rent your personal data. Information may be shared with trusted partners 
                (such as payment gateways) only to the extent necessary to process your contributions.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">5. Your Rights</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Access and update your personal information.</li>
                <li>Request deletion of your personal data (as per legal limits).</li>
                <li>Opt-out of promotional communications at any time.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">6. Cookies</h2>
            <p class="text-gray-700">
                Our website may use cookies to improve user experience. You can control cookies through your 
                browser settings.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">7. Changes to this Policy</h2>
            <p class="text-gray-700">
                We may update this Privacy Policy from time to time. Changes will be posted on this page with 
                a revised date.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">8. Contact Us</h2>
            <p class="text-gray-700">
                If you have any questions about this Privacy Policy, please contact us:
            </p>
            <ul class="list-none text-gray-700 mt-2">
                <li><span class="font-semibold">Phone:</span> +91 98936 50250</li>
                <li><span class="font-semibold">Email:</span> support@akshardan.org</li>
                <li><span class="font-semibold">Address:</span> Ujjain, Madhya Pradesh, India</li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-sm text-gray-500 text-center">
        Last updated: {{ now()->format('d M, Y') }}
    </div>
</div>
@endsection
