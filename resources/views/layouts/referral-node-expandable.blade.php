@php
use Illuminate\Support\Str;
use Carbon\Carbon;

$phone = $node['phone'] ?? $node['mobile'] ?? ($node['user']['phone'] ?? null);
@endphp

<li x-data="{ open: true }" x-show="
    query === '' ||
    '{{ strtolower($node['name'] ?? '') }}'.includes(query.toLowerCase()) ||
    '{{ strtolower($node['username'] ?? '') }}'.includes(query.toLowerCase()) ||
    '{{ strtolower($node['form_number'] ?? '') }}'.includes(query.toLowerCase())
" class="mb-2">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 hover:bg-green-50 cursor-pointer transition"
         @click="open = !open">

        <!-- Left -->
        <div class="flex items-center space-x-2 flex-wrap gap-y-1">
            @if(!empty($node['children']))
                <svg class="w-4 h-4 text-gray-500 transform transition-transform duration-200"
                     :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7"/>
                </svg>
            @endif

            <span class="font-semibold text-gray-800">
                NGO/{{ $node['form_number'] ?? '—' }}
            </span>

            <span class="text-sm text-gray-600">
                ({{ $node['username'] ?? 'N/A' }})
            </span>

            <span class="px-2 py-0.5 text-xs rounded-full 
                {{ $node['status'] === 'active' ? 'bg-green-100 text-green-700' :
                   ($node['status'] === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                {{ ucfirst($node['status']) }}
            </span>
        </div>

        <!-- Right -->
        <div class="flex flex-wrap items-center gap-2 mt-2 sm:mt-0 text-xs text-gray-600">
            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full font-medium">
                {{ $node['name'] ?? 'N/A' }}
            </span>

            @if($phone)
                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                    📞 {{ Str::mask($phone, '*', 3, 5) }}
                </span>
            @endif

            @if(!empty($node['referral_code']))
                <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded-full font-semibold">
                    🔗 {{ $node['referral_code'] }}
                </span>
            @endif

            <span class="text-gray-500">
                📅 {{ isset($node['created_at']) ? Carbon::parse($node['created_at'])->format('d M Y') : 'N/A' }}
            </span>
        </div>
    </div>

    @if(!empty($node['children']))
        <ul x-show="open" x-transition class="ml-6 border-l border-gray-300 pl-4 mt-2">
            @foreach($node['children'] as $child)
                @include('layouts.referral-node-expandable', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
