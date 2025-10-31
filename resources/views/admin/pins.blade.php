@extends('layouts.admin')

@section('title','Manage Activation Pins')

@section('content')
<div class="flex">

    {{-- ✅ Sidebar --}}
    @include('admin.sidebar')

    {{-- ✅ Main Content --}}
    <div class="flex-1 p-6 mt-12 bg-gray-900 text-white min-h-screen">

        <h2 class="text-2xl font-bold mb-6">Activation Pins Management</h2>

        <!-- Generate PIN Form -->
        <div class="bg-gray-800 p-5 rounded-lg mb-8">
            <h3 class="text-lg font-semibold mb-4">Generate Activation PINs</h3>

            <form action="{{ route('admin.pins.generate') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf

                {{-- ✅ User Search --}}
                <div x-data="userSearch()" class="relative">
                    <label class="block text-sm mb-1 text-white">Assign To User</label>

                    <!-- Input -->
                    <input type="text" x-model="query" @input="searchUsers" placeholder="Search Name / Username / Phone"
                        class="w-full px-3 py-2 rounded border border-gray-600 bg-gray-900 text-white focus:ring-green-500">

                    <!-- Results -->
                    <div class="absolute z-50 bg-gray-800 border border-gray-700 rounded mt-1 max-h-60 overflow-y-auto w-full"
                        x-show="results.length > 0">

                        <template x-for="u in results" :key="u.id">
                            <div @click="selectUser(u)"
                                class="flex items-center gap-3 px-3 py-2 hover:bg-gray-700 cursor-pointer">

                                <!-- Profile Pic -->
                                <img :src="u.profile_photo ? '/storage/'+u.profile_photo : '/assets/img/photo.jpg'"
                                    class="h-8 w-8 rounded-full border border-gray-600">

                                <div class="flex-1 text-white">
                                    <span class="font-semibold" x-text="u.name"></span>
                                    <span class="text-gray-400 text-xs"> (<span x-text="u.username"></span>)</span>
                                    <div class="text-xs text-gray-400">
                                        📞 <span x-text="u.phone"></span>
                                    </div>
                                </div>

                                <!-- PIN Stats -->
                                <div class="text-right text-xs">
                                    <span class="text-green-400 font-semibold"
                                        x-text="'Avail: '+u.pin_available"></span><br>
                                    <span class="text-orange-400 font-semibold" x-text="'Used: '+u.pin_used"></span>
                                </div>
                            </div>
                        </template>
                    </div>

                    <input type="hidden" name="assigned_to" x-model="selectedId" required>
                    <p class="text-green-400 text-sm mt-1" x-show="selectedName">✅ Selected: <span x-text="selectedName"></span></p>
                </div>

                <script>
                    function userSearch() {
                        return {
                            query: "",
                            results: [],
                            selectedId: "",
                            selectedName: "",

                            searchUsers() {
                                if (this.query.length < 2) { this.results = []; return; }

                                fetch(`/admin/search-users?query=${this.query}`)
                                    .then(res => res.json())
                                    .then(data => this.results = data);
                            },

                            selectUser(u) {
                                this.selectedId = u.id;
                                this.selectedName = `${u.name} (${u.username})`;
                                this.query = "";
                                this.results = [];
                            }
                        }
                    }
                </script>

                <div>
                    <label class="block text-sm mb-1">Number of Pins</label>
                    <input type="number" name="quantity" value="1" min="1" max="200"
                        class="w-full text-black rounded px-3 py-2" required>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded shadow">
                        Generate
                    </button>
                </div>
            </form>
        </div>

        <!-- PINs Table -->
        <div class="bg-gray-800 p-5 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">All Generated PINs</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-700 text-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left">PIN</th>
                            <th class="px-4 py-3 text-left">Assigned To</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Used By</th>
                            <th class="px-4 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($pins as $pin)
                        <tr>
                            <td class="px-4 py-2 font-bold">{{ $pin->pin }}</td>
                            <td class="px-4 py-2">{{ $pin->assignedUser->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs rounded
                                {{ $pin->status=='unused'?'bg-green-700':'bg-red-700' }}">
                                    {{ ucfirst($pin->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $pin->usedUser->name ?? '--' }}</td>
                            <td class="px-4 py-2">{{ $pin->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">{{ $pins->links() }}</div>
        </div>

    </div> {{-- End Main --}}
</div> {{-- End Flex --}}
@endsection
