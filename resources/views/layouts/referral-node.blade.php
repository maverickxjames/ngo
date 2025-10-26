<li>
    <div class="flex items-center space-x-2 bg-gray-50 border rounded-lg px-4 py-2 hover:bg-green-50">
        <span class="font-semibold text-gray-800">{{ $node['username'] }}</span>
        <span class="px-2 py-0.5 text-xs rounded-full 
            {{ $node['status'] === 'active' ? 'bg-green-100 text-green-700' :
               ($node['status'] === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
            {{ ucfirst($node['status']) }}
        </span>
        <span class="text-xs text-gray-500">Joined: {{ $node['joined_at'] }}</span>
    </div>

    @if(!empty($node['children']))
        <ul>
            @foreach($node['children'] as $child)
                @include('layouts.referral-node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
