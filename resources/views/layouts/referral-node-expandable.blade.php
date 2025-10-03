<li x-data="{ open: true }">
    <!-- Node -->
    <div class="flex items-center space-x-2 bg-gray-50 border rounded-lg px-4 py-2 hover:bg-green-50 cursor-pointer"
         @click="open = !open">

        <!-- Expand/Collapse Icon -->
        @if(!empty($node['children']))
            <svg class="w-4 h-4 text-gray-500 transform transition-transform duration-200"
                 :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5l7 7-7 7"/>
            </svg>
        @endif

        <!-- User Info -->
        <span class="font-semibold text-gray-800">NGO/{{ $node['form_number'] }}</span>

        <span class="px-2 py-0.5 text-xs rounded-full 
            {{ $node['status'] === 'active' ? 'bg-green-100 text-green-700' :
               ($node['status'] === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
            {{ ucfirst($node['status']) }}
        </span>

        <span class="text-xs text-gray-500">Joined: {{ $node['joined_at'] }}</span>
    </div>

    <!-- Children -->
    @if(!empty($node['children']))
        <ul x-show="open" x-transition>
            @foreach($node['children'] as $child)
                @include('layouts.referral-node-expandable', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
