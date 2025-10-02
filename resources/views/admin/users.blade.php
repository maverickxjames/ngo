@extends('layouts.app')

@section('content')
<h1>Users</h1>
<table class="table">
    <thead>
        <tr><th>ID</th><th>Username</th><th>Status</th><th>Action</th></tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->status }}</td>
            <td>
                <form method="POST" action="{{ route('admin.users.updateStatus', $user) }}">
                    @csrf
                    <select name="status">
                        <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="rejected" {{ $user->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection
