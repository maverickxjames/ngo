@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-orange-500 p-6 rounded-xl shadow-lg text-white">
        <h1 class="text-3xl font-bold">हमारे बारे में</h1>
        <p class="mt-2 text-sm">अक्षरदान सोशल सेवा फाउंडेशन (भारत सरकार के नीति आयोग द्वारा मान्यता प्राप्त)</p>
    </div>

    <!-- Introduction -->
    <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
        <p class="text-gray-700 leading-relaxed">
            <span class="font-bold text-green-700">अक्षरदान सोशल सेवा फाउंडेशन</span> एक समाजसेवी संस्थान है 
            जिसका मुख्य उद्देश्य समाज के जरूरतमंद वर्ग की सहायता करना, गरीब बच्चों की पढ़ाई और विवाह में सहयोग करना है। 
            यह मॉडल एक परंपरागत प्रणाली पर कार्य करता है जिसमें सदस्य जुड़कर सामाजिक कार्यों में योगदान देते हैं, 
            देश की कई परियोजनाओं को पूरा करने में सहयोग करते हैं और स्वयं भी आर्थिक रूप से सशक्त होते हैं।
        </p>
    </div>

    <!-- Registration -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold text-green-700 mb-3">पंजीकरण और प्रमाणन</h2>
        <p class="text-gray-700">
            संस्थान भारत सरकार के <span class="font-semibold">नीति आयोग</span> द्वारा मान्यता प्राप्त है और 
            विभिन्न सामाजिक योजनाओं के संचालन हेतु प्रमाणित है।
        </p>
    </div>

    <!-- Structure -->
    <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
        <h2 class="text-xl font-bold text-green-700 mb-3">संगठनात्मक ढांचा एवं प्रगति योजना</h2>
        <p class="text-gray-700">संस्थान का ढांचा विभिन्न स्तरों के समन्वयकों पर आधारित है:</p>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li>फील्ड कोऑर्डिनेटर</li>
            <li>ब्लॉक कोऑर्डिनेटर</li>
            <li>ब्रांच कोऑर्डिनेटर</li>
            <li>डिस्ट्रिक्ट कोऑर्डिनेटर</li>
            <li>स्टेट कोऑर्डिनेटर</li>
            <li>नेशनल कोऑर्डिनेटर</li>
            <li>रिपब्लिक कोऑर्डिनेटर</li>
        </ul>
    </div>

    <!-- Projects -->
    <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
        <h2 class="text-xl font-bold text-green-700 mb-3">प्रमुख सामाजिक योजनाएँ</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-2">
            <li>गरीब बच्चों को पढ़ाई सामग्री (पेन, पेंसिल, बैग आदि) प्रदान करना</li>
            <li>बेसहारा लोगों को कंबल, कपड़े, खाना और दवाइयाँ वितरित करना</li>
            <li>विधवा और दिव्यांग सहायता योजना (सिलाई मशीन, व्हीलचेयर आदि)</li>
            <li>गौ सेवा वाहन सहयोग योजना</li>
            <li>वृद्ध तीर्थ यात्रा योजना</li>
            <li>अनाथ व गरीब बेटियों का सामूहिक विवाह सहयोग</li>
        </ul>
    </div>

    <!-- Donor Support -->
    <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
        <h2 class="text-xl font-bold text-green-700 mb-3">दानदाता सहयोग उपहार योजना</h2>
        <p class="text-gray-700">
            दानदाताओं को उनके सहयोग के आधार पर विशेष उपहार प्रदान किए जाते हैं। 
            यह योजना परिवार में विवाह या संतान जन्म जैसे अवसरों पर लागू होती है। 
            इसमें समयावधि के अनुसार पंखा, मिक्सर, सिलाई मशीन, टीवी, वॉशिंग मशीन, फर्नीचर 
            और अन्य उपयोगी वस्तुएँ प्रदान की जाती हैं।
        </p>
    </div>

    <!-- Closing -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <p class="text-gray-700">
            हमारा उद्देश्य समाज के हर वर्ग तक सहयोग पहुँचाना है और हर जरूरतमंद को सशक्त बनाना है।  
            <span class="font-semibold text-green-700">आपका सहयोग हमारे लिए अमूल्य है।</span>
        </p>
    </div>

    <!-- Footer -->
    <div class="text-sm text-gray-500 text-center">
        धन्यवाद – अक्षरदान सोशल सेवा फाउंडेशन
    </div>
</div>
@endsection
