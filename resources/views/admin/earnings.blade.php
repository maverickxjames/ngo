@extends('layouts.app')

@section('content')
<h1>Earnings</h1>
<table class="table">
    <thead>
        <tr><th>ID</th><th>User</th><th>Source</th><th>Type</th><th>Slab</th><th>Amount</th><th>Credited At</th><th>Paid</th></tr>
    </thead>
    <tbody>
        @foreach($earnings as $earning)
        <tr>
            <td>{{ $earning->id }}</td>
            <td>{{ $earning->user->username }}</td>
            <td>{{ $earning->sourceUser?->username }}</td>
            <td>{{ $earning->type }}</td>
            <td>{{ $earning->slab }}</td>
            <td>{{ $earning->amount }}</td>
            <td>{{ $earning->credited_at }}</td>
            <td>{{ $earning->is_paid ? 'Yes' : 'No' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $earnings->links() }}
@endsection
