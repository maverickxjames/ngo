@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-orange-500 p-6 rounded-xl shadow-lg text-white mb-6">
        <h1 class="text-2xl font-bold">Support</h1>
        <p class="text-sm mt-1">We’re here to help you! Reach out through any of the channels below.</p>
    </div>

    <!-- Support Options -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <!-- Phone Support -->
        <div class="bg-white rounded-xl shadow-md border-l-4 border-green-600 p-6 flex flex-col items-center text-center hover:shadow-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-2.1a1.125 1.125 0 00-.852-1.091l-4.5-1.125a1.125 1.125 0 00-1.29.54l-.9 1.8a11.25 11.25 0 01-6.6-6.6l1.8-.9a1.125 1.125 0 00.54-1.29L6.69 3.852A1.125 1.125 0 005.6 3H3.75A1.5 1.5 0 002.25 4.5v2.25z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-800">Phone Support</h3>
            <p class="text-gray-600 mt-2">Call us for direct assistance.</p>
            <a href="tel:+919893650250" class="mt-3 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                +91 98936 50250
            </a>
        </div>

        <!-- Email Support -->
        <div class="bg-white rounded-xl shadow-md border-l-4 border-orange-500 p-6 flex flex-col items-center text-center hover:shadow-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5H4.5a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.82 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-800">Email Support</h3>
            <p class="text-gray-600 mt-2">Send us your queries anytime.</p>
            <a href="mailto:support@ngo.org" class="mt-3 px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                support@ngo.org
            </a>
        </div>

        <!-- WhatsApp Support -->
        <div class="bg-white rounded-xl shadow-md border-l-4 border-green-500 p-6 flex flex-col items-center text-center hover:shadow-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 .5a11.5 11.5 0 0 0-9.897 17.327L1 23l5.37-1.416A11.5 11.5 0 1 0 12 .5Zm0 2a9.5 9.5 0 0 1 7.892 14.828l-.243.357a9.5 9.5 0 0 1-12.91 2.59l-.35-.233-3.073.811.822-3.003-.23-.353A9.5 9.5 0 0 1 12 2.5Zm4.502 12.718c-.246-.123-1.453-.717-1.678-.798-.225-.082-.389-.123-.553.123-.163.245-.635.797-.779.96-.143.163-.286.184-.532.061-.245-.123-1.036-.381-1.974-1.21a7.41 7.41 0 0 1-1.371-1.707c-.143-.245-.015-.377.108-.5.111-.111.245-.286.368-.429.123-.143.163-.245.245-.409.082-.163.041-.307-.02-.429-.062-.123-.553-1.333-.757-1.828-.199-.478-.402-.414-.553-.422l-.47-.008c-.163 0-.429.061-.653.306-.225.245-.857.838-.857 2.041s.877 2.371 1 2.534c.123.163 1.725 2.63 4.183 3.688.585.253 1.04.404 1.395.516.585.186 1.117.16 1.538.097.468-.07 1.453-.594 1.657-1.168.204-.574.204-1.065.143-1.168-.061-.102-.225-.163-.47-.286Z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-800">WhatsApp Support</h3>
            <p class="text-gray-600 mt-2">Chat with us instantly on WhatsApp.</p>
            <a href="https://wa.me/+919893650250" target="_blank" class="mt-3 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                Chat Now
            </a>
        </div>
    </div>
</div>
@endsection
