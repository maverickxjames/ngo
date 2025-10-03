@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-orange-500 p-6 rounded-xl shadow-lg text-white">
        <h1 class="text-3xl font-bold">Terms & Conditions</h1>
        <p class="mt-2 text-sm">अक्षरदान सोशल सेवा फाउंडेशन (Akshardan Social Seva Foundation)</p>
    </div>

    <!-- Content -->
    <div class="bg-white p-6 rounded-xl shadow-md space-y-6">

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">1. Introduction</h2>
            <p class="text-gray-700">
                These Terms & Conditions govern your use of the website and services of 
                <span class="font-semibold text-green-700">अक्षरदान सोशल सेवा फाउंडेशन</span>. 
                By accessing or using our platform, you agree to be bound by these terms.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">2. Eligibility</h2>
            <p class="text-gray-700">
                Our services are available to individuals who are at least 18 years old. 
                By using our platform, you confirm that you meet this requirement.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">3. User Responsibilities</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>Provide accurate information during registration and donations.</li>
                <li>Do not misuse the website for illegal or unauthorized activities.</li>
                <li>Maintain confidentiality of your login credentials.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">4. Donations & Payments</h2>
            <p class="text-gray-700">
                All donations made to our NGO are voluntary and non-refundable, 
                unless otherwise required by law. We use trusted payment gateways 
                to process contributions securely.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">5. Intellectual Property</h2>
            <p class="text-gray-700">
                All content on this website, including text, graphics, logos, and images, 
                is the property of Akshardan Social Seva Foundation and is protected by 
                copyright laws. You may not reproduce or distribute it without permission.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">6. Limitation of Liability</h2>
            <p class="text-gray-700">
                We strive to provide accurate and reliable information. However, 
                we are not responsible for any direct, indirect, or incidental damages 
                that may result from the use of our services or website.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">7. Termination</h2>
            <p class="text-gray-700">
                We reserve the right to suspend or terminate user accounts if these 
                Terms & Conditions are violated or in case of misuse of our platform.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">8. Amendments</h2>
            <p class="text-gray-700">
                We may update these Terms & Conditions at any time. Changes will be posted 
                on this page with a revised date. Continued use of our platform implies 
                acceptance of updated terms.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-green-700 mb-2">9. Contact Us</h2>
            <p class="text-gray-700">
                If you have any questions about these Terms & Conditions, please contact us:
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
