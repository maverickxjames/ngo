@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
    <div class="flex min-h-screen bg-gray-900 text-gray-100">
        <!-- ✅ Sidebar -->
        @include('admin.sidebar')

        <!-- ✅ Main Content -->
        <div class="flex-1 mt-14 p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 border-b border-gray-700 pb-3">
                <h1 class="text-2xl font-bold mb-3 sm:mb-0">Manage Users</h1>

                <!-- ✅ Export Buttons -->
                <div class="flex space-x-2">
                    <button onclick="exportTable('csv')"
                        class="bg-green-600 hover:bg-green-700 px-3 py-1.5 text-xs rounded-lg shadow text-white font-semibold">
                        <i class="ri-file-text-line mr-1"></i> CSV
                    </button>
                    <button onclick="exportTable('xlsx')"
                        class="bg-blue-600 hover:bg-blue-700 px-3 py-1.5 text-xs rounded-lg shadow text-white font-semibold">
                        <i class="ri-file-excel-2-line mr-1"></i> Excel
                    </button>
                    <button onclick="exportTable('pdf')"
                        class="bg-red-600 hover:bg-red-700 px-3 py-1.5 text-xs rounded-lg shadow text-white font-semibold">
                        <i class="ri-file-pdf-line mr-1"></i> PDF
                    </button>
                </div>
            </div>

            <!-- ✅ Responsive Table -->
            <div class="bg-gray-800 shadow-lg rounded-xl overflow-hidden">
                <div class="overflow-x-auto w-full">
                    <div x-data="{ showModal: false, user: {} }" class="relative">

                        <table id="usersTable" class="min-w-full text-sm text-gray-300">
                            <thead class="bg-gray-700 text-gray-100 uppercase text-xs font-semibold">
                                <tr>
                                    <th class="px-6 py-3 text-left whitespace-nowrap">ID</th>
                                    <th class="px-6 py-3 text-left whitespace-nowrap">Username</th>
                                    <th class="px-6 py-3 text-left whitespace-nowrap">Form No.</th>
                                    <th class="px-6 py-3 text-left whitespace-nowrap">Name</th>
                                    <th class="px-6 py-3 text-left whitespace-nowrap">Phone</th>
                                    <th class="px-6 py-3 text-left whitespace-nowrap">Aadhar</th>
                                    <th class="px-6 py-3 text-left whitespace-nowrap">Status</th>
                                    <th class="px-6 py-3 text-left whitespace-nowrap">Joined</th>
                                    <th class="px-6 py-3 text-center whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse($users as $user)
                                    <tr class="hover:bg-gray-700 transition">
                                        <td class="px-6 py-3">{{ $user->id }}</td>
                                        <td class="px-6 py-3 font-medium text-white">{{ $user->username }}</td>
                                        <td class="px-6 py-3 font-medium text-white">{{ $user->form_number }}</td>
                                        <td class="px-6 py-3">{{ $user->name }}</td>
                                        <td class="px-6 py-3 text-gray-400">{{ $user->phone }}</td>
                                        <td class="px-6 py-3 text-gray-400">{{ $user->education }}</td>
                                        <td class="px-6 py-3">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold 
                        {{ $user->status == 'active'
                            ? 'bg-green-600 text-white'
                            : ($user->status == 'pending'
                                ? 'bg-yellow-500 text-black'
                                : 'bg-red-600 text-white') }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3 text-gray-400">
                                            {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : '-' }}
                                        </td>

                                        <td class="px-6 py-3 text-center space-x-2 flex justify-center items-center">
                                            <!-- 🟢 View Button -->
                                            <button
                                                @click="
                            user = {
                                id: '{{ $user->id }}',
                                form_number: '{{ $user->form_number ?? 'N/A' }}',
                                username: '{{ $user->username }}',
                                name: '{{ $user->name ?? 'N/A' }}',
                                guardian_name: '{{ $user->guardian_name ?? 'N/A' }}',
                                dob: '{{ $user->dob ?? 'N/A' }}',
                                gender: '{{ $user->gender ?? 'N/A' }}',
                                education: '{{ $user->education ?? 'N/A' }}',
                                address: '{{ $user->address ?? 'N/A' }}',
                                tehsil: '{{ $user->tehsil ?? 'N/A' }}',
                                district: '{{ $user->district ?? 'N/A' }}',
                                state: '{{ $user->state ?? 'N/A' }}',
                                phone: '{{ $user->phone ?? 'N/A' }}',
                                email: '{{ $user->email ?? 'N/A' }}',
                                referral_code: '{{ $user->referral_code ?? 'N/A' }}',
                                referred_by: '{{ $user->referrer->name ?? 'N/A' }}',
                                profile_photo: '{{ $user->profile_photo ? asset("storage/".$user->profile_photo) : "https://img.freepik.com/premium-vector/vector-flat-illustration-grayscale-avatar-user-profile-person-icon-gender-neutral-silhouette-profile-picture-suitable-social-media-profiles-icons-screensavers-as-templatex9xa_719432-2190.jpg" }}',
                                status: '{{ ucfirst($user->status) }}',
                                created_at: '{{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : 'N/A' }}',
                            };
                            showModal = true;
                        "
                                                class="bg-blue-600 hover:bg-blue-700 px-3 py-1 text-xs text-white font-semibold rounded shadow">
                                                View
                                            </button>

                                            <!-- Update Form -->
                                            <form method="POST" action="{{ route('admin.users.updateStatus', $user) }}"
                                                class="flex space-x-2">
                                                @csrf
                                                <select name="status"
                                                    class="rounded-lg bg-gray-800 border border-gray-600 text-sm px-2 py-1 focus:ring-green-500 focus:outline-none">
                                                    <option value="pending"
                                                        {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="active"
                                                        {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="rejected"
                                                        {{ $user->status == 'rejected' ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                                <button type="submit"
                                                    class="bg-green-600 hover:bg-green-700 px-3 py-1 text-xs text-white font-semibold rounded shadow">
                                                    Update
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-400">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- 🟢 User Detail Modal -->
                        <div x-show="showModal" x-transition
                            class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
                            <div
                                class="bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl p-6 relative text-gray-200 overflow-y-auto max-h-[90vh]">

                                <!-- Close -->
                                <button @click="showModal = false"
                                    class="absolute top-3 right-3 text-gray-400 hover:text-white text-xl">✕</button>

                                <h2 class="text-2xl font-bold text-white mb-4 border-b border-gray-700 pb-2">User
                                    Information</h2>

                                <!-- Profile Header -->
                                <div class="flex items-center space-x-4 mb-6">
                                    <img :src="user.profile_photo"
                                        class="h-20 w-20 rounded-full border-2 border-green-600 object-cover">
                                    <div>
                                        <h3 class="text-lg font-semibold text-white" x-text="user.name"></h3>
                                        <p class="text-gray-400 text-sm" x-text="'@' + user.username"></p>
                                        <p class="text-sm mt-1">Joined: <span class="text-gray-300"
                                                x-text="user.created_at"></span></p>
                                    </div>
                                </div>

                                <!-- Details -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                    <div><span class="font-semibold text-gray-400">Form Number:</span> <span
                                            x-text="user.form_number"></span></div>
                                    <div><span class="font-semibold text-gray-400">Guardian Name:</span> <span
                                            x-text="user.guardian_name"></span></div>
                                    <div><span class="font-semibold text-gray-400">DOB:</span> <span
                                            x-text="user.dob"></span></div>
                                    <div><span class="font-semibold text-gray-400">Gender:</span> <span
                                            x-text="user.gender"></span></div>
                                    <div><span class="font-semibold text-gray-400">Education:</span> <span
                                            x-text="user.education"></span></div>
                                    <div><span class="font-semibold text-gray-400">Phone:</span> <span
                                            x-text="user.phone"></span></div>
                                    <div><span class="font-semibold text-gray-400">Email:</span> <span
                                            x-text="user.email"></span></div>
                                    <div><span class="font-semibold text-gray-400">Referral Code:</span> <span
                                            x-text="user.referral_code"></span></div>
                                    <div><span class="font-semibold text-gray-400">Referred By:</span> <span
                                            x-text="user.referred_by"></span></div>
                                    <div><span class="font-semibold text-gray-400">Address:</span> <span
                                            x-text="user.address"></span></div>
                                    <div><span class="font-semibold text-gray-400">Tehsil:</span> <span
                                            x-text="user.tehsil"></span></div>
                                    <div><span class="font-semibold text-gray-400">District:</span> <span
                                            x-text="user.district"></span></div>
                                    <div><span class="font-semibold text-gray-400">State:</span> <span
                                            x-text="user.state"></span></div>
                                    <div><span class="font-semibold text-gray-400">Status:</span>
                                        <span class="px-2 py-1 rounded text-xs font-semibold"
                                            :class="{
                                                'bg-green-600 text-white': user.status === 'Active',
                                                'bg-yellow-500 text-black': user.status === 'Pending',
                                                'bg-red-600 text-white': user.status === 'Rejected'
                                            }"
                                            x-text="user.status"></span>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="mt-6 flex justify-end space-x-3">
                                    <a :href="'/admin/users/' + user.id"
                                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold text-white transition">
                                        View Full Detail
                                    </a>
                                    <button @click="showModal = false"
                                        class="px-5 py-2 bg-green-600 hover:bg-green-700 rounded-lg font-semibold text-white transition">
                                        Close
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ✅ Pagination -->
            <div class="mt-6">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    <!-- ✅ Export Script -->
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>



        <script>
            function exportTable(type) {
                const table = document.getElementById("usersTable");
                const wb = XLSX.utils.table_to_book(table, {
                    sheet: "Users"
                });

                if (type === 'csv') {
                    XLSX.writeFile(wb, 'users.csv');
                } else if (type === 'xlsx') {
                    XLSX.writeFile(wb, 'users.xlsx');
                } else if (type === 'pdf') {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF({
                        orientation: 'landscape'
                    });
                    doc.text("Users List", 14, 12);
                    doc.autoTable({
                        html: '#usersTable',
                        startY: 20
                    });
                    doc.save("users.pdf");
                }
            }
        </script>
    @endpush
@endsection
