@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

<!-- Referral Link + Actions -->
<div class="bg-white shadow-md rounded-xl p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-3">Your Referral Link</h2>

    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
        <input id="referralLink" 
               type="text" 
               readonly 
               value="{{ url('/register?ref=' . Auth::user()->form_number) }}" 
               class="w-full px-4 py-2 border rounded-lg text-sm text-gray-700 focus:ring focus:ring-green-300">

        <!-- Buttons -->
        <div class="flex gap-2">
            <!-- Copy -->
            <button onclick="copyReferralLink()"
                class="px-3 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 text-xs">
                Copy
            </button>

            <!-- WhatsApp Share -->
            <a id="whatsappShare"
               href="https://wa.me/?text=Join%20me%20here:%20{{ urlencode(url('/register?ref=' . Auth::user()->form_number)) }}"
               target="_blank"
               class="flex items-center gap-1 px-3 py-2 bg-[#25D366] text-white rounded-md shadow hover:bg-green-500 text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                    <path d="M20.52 3.48A11.82 11.82 0 0012 0C5.37 0 0 5.37 0 12a11.94 11.94 0 001.7 6.1L0 24l6.15-1.68A11.92 11.92 0 0012 24c6.63 0 12-5.37 12-12 0-3.2-1.25-6.21-3.48-8.52zM12 22a9.86 9.86 0 01-5.2-1.48l-.37-.22-3.64 1L4 17.67l-.24-.38A9.9 9.9 0 012 12c0-5.52 4.48-10 10-10 2.68 0 5.19 1.05 7.07 2.93A9.91 9.91 0 0122 12c0 5.52-4.48 10-10 10zm5.21-7.79c-.29-.15-1.71-.84-1.98-.94-.27-.1-.47-.15-.67.15s-.77.94-.95 1.14c-.17.2-.35.23-.64.08-.29-.15-1.22-.45-2.32-1.45-.86-.77-1.44-1.72-1.61-2.01-.17-.29-.02-.45.13-.6.14-.14.29-.35.44-.52.15-.17.2-.29.3-.49.1-.2.05-.37-.02-.52-.07-.15-.67-1.61-.92-2.21-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37s-1.04 1.01-1.04 2.46 1.07 2.86 1.22 3.06c.15.2 2.1 3.2 5.08 4.48.71.31 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.09 1.71-.7 1.95-1.37.24-.67.24-1.24.17-1.37-.06-.12-.26-.2-.55-.35z"/>
                </svg>
                WhatsApp
            </a>

            <!-- QR Modal Trigger -->
            <button onclick="openQrModal()"
                class="px-3 py-2 bg-gray-700 text-white rounded-md shadow hover:bg-gray-800 text-xs">
                SHOW QR
            </button>
        </div>
    </div>

    <!-- Copy Success Message -->
    <p id="copyMessage" class="text-green-600 text-sm mt-2 hidden">✅ Link copied successfully!</p>
</div>

<!-- QR Modal -->
<div id="qrModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg relative max-w-xs w-full text-center">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Referral QR Code</h3>
        <img id="qrCodeImg" class="mx-auto"
             src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(url('/register?ref=' . Auth::user()->form_number)) }}"
             alt="Referral QR Code">
        <button onclick="closeQrModal()" 
                class="mt-4 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm">
            Close
        </button>
    </div>
</div>

<!-- Scripts -->
<script>
function copyReferralLink() {
    const copyText = document.getElementById("referralLink").value;

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(copyText).then(() => {
            showCopyMessage();
        }).catch(err => {
            fallbackCopy(copyText);
        });
    } else {
        fallbackCopy(copyText);
    }
}

function fallbackCopy(text) {
    const textarea = document.createElement("textarea");
    textarea.value = text;
    textarea.style.position = "fixed"; // avoid scrolling to bottom
    document.body.appendChild(textarea);
    textarea.focus();
    textarea.select();
    try {
        document.execCommand("copy");
        showCopyMessage();
    } catch (err) {
        alert("Copy failed. Please copy manually.");
    }
    document.body.removeChild(textarea);
}

function showCopyMessage() {
    let msg = document.getElementById("copyMessage");
    msg.classList.remove("hidden");
    setTimeout(() => msg.classList.add("hidden"), 2000);
}

    function openQrModal() {
        document.getElementById("qrModal").classList.remove("hidden");
    }

    function closeQrModal() {
        document.getElementById("qrModal").classList.add("hidden");
    }
</script>


    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-orange-500 p-6 rounded-xl shadow-lg text-white">
        <h1 class="text-2xl font-bold">Your Referrals</h1>
        <p class="text-sm mt-1">Track the members who joined directly under you</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-600">
            <h3 class="text-sm font-semibold text-gray-600">Total Referrals</h3>
            <p class="mt-2 text-2xl font-bold text-green-700">{{ $directMembers->count() }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-yellow-500">
            <h3 class="text-sm font-semibold text-gray-600">Pending Members</h3>
            <p class="mt-2 text-2xl font-bold text-yellow-600">
                {{ $directMembers->where('status', 'pending')->count() }}
            </p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-red-600">
            <h3 class="text-sm font-semibold text-gray-600">Rejected Members</h3>
            <p class="mt-2 text-2xl font-bold text-red-600">
                {{ $directMembers->where('status', 'rejected')->count() }}
            </p>
        </div>
    </div>

    <!-- Referral Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b bg-gray-100">
            <h2 class="text-lg font-bold text-gray-700">Direct Referrals</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-800 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3">Form No</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Joined Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($directMembers as $member)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $member->form_number }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $member->status === 'active' ? 'bg-green-100 text-green-700' : 
                                   ($member->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($member->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($member->joined_at)->format('d M, Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No referrals found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Copy Script -->
<script>
    function copyReferralLink() {
        let copyText = document.getElementById("referralLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);

        let msg = document.getElementById("copyMessage");
        msg.classList.remove("hidden");
        setTimeout(() => msg.classList.add("hidden"), 2000);
    }
</script>
@endsection
