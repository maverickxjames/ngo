@extends('layouts.app')

@section('content')
<h1>Admin Dashboard</h1>
<ul>
    <li>Total Users: {{ $userCount }}</li>
    <li>Active Users: {{ $activeUsers }}</li>
    <li>Pending Users: {{ $pendingUsers }}</li>
    <li>Total Donations: ₹{{ number_format($totalDonations, 2) }}</li>
</ul>
@endsection
