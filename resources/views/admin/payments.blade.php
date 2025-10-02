@extends('layouts.app')

@section('content')
<h1>Payments</h1>
<table class="table">
    <thead>
        <tr><th>ID</th><th>User</th><th>Gateway</th><th>Order ID</th><th>Amount</th><th>Status</th><th>Date</th></tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->user->username }}</td>
            <td>{{ $payment->gateway }}</td>
            <td>{{ $payment->order_id }}</td>
            <td>{{ $payment->amount }}</td>
            <td>{{ $payment->status }}</td>
            <td>{{ $payment->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $payments->links() }}
@endsection
