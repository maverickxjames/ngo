@extends('layouts.app')

@section('content')
<h1>Direct Referrals</h1>
<table class="table">
    <thead>
        <tr><th>Username</th><th>Status</th><th>Joined</th></tr>
    </thead>
    <tbody>
        @foreach($directMembers as $member)
        <tr>
            <td>{{ $member->username }}</td>
            <td>{{ $member->status }}</td>
            <td>{{ $member->joined_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
