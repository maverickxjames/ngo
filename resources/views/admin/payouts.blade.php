@extends('layouts.app')

@section('content')
<h1>Payouts</h1>
<table class="table">
    <thead>
        <tr><th>ID</th><th>User</th><th>Amount</th><th>Processed By</th><th>Date</th><th>Status</th></tr>
    </thead>
    <tbody>
        @foreach($payouts as $payout)
        <tr>
            <td>{{ $payout->id }}</td>
            <td>{{ $payout->user->username }}</td>
            <td>{{ $payout->amount }}</td>
            <td>{{ $payout->processed_by }}</td>
            <td>{{ $payout->processed_at }}</td>
            <td>{{ $payout->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $payouts->links() }}
@endsection
