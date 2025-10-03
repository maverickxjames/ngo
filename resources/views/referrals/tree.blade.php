@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-orange-500 p-6 rounded-xl shadow-lg text-white mb-6">
        <h1 class="text-2xl font-bold">Referral Tree</h1>
        <p class="text-sm mt-1">Explore your team hierarchy. Click nodes to expand.</p>
    </div>

    <!-- Tree -->
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        @if(!empty($tree))
            <ul class="tree text-sm">
                @foreach($tree as $node)
                    @include('layouts.referral-node-expandable', ['node' => $node])
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 text-center">No referral tree available.</p>
        @endif
    </div>
</div>

<!-- Tree Lines -->
<style>
    .tree ul {
        padding-top: 1rem;
        position: relative;
        padding-left: 1.5rem;
    }
    .tree li {
        position: relative;
        margin: 0 0 1rem 0;
        list-style-type: none;
    }
    .tree li::before {
        content: '';
        position: absolute;
        top: 0;
        left: -15px;
        border-left: 2px solid #d1d5db;
        height: 100%;
    }
    .tree li::after {
        content: '';
        position: absolute;
        top: 12px;
        left: -15px;
        border-top: 2px solid #d1d5db;
        width: 15px;
    }
    .tree li:first-child::before {
        top: 12px;
        height: calc(100% - 12px);
    }
    .tree li:last-child::before {
        height: 12px;
    }
</style>
@endsection
