@extends('layouts.app')

@section('content')
<h1>Edit Bank Details</h1>
<form method="POST" action="{{ route('bank.update') }}">
    @csrf
    <label>Account Number</label>
    <input type="text" name="account_number" value="{{ $user->bank_details['account_number'] ?? '' }}">
    @error('account_number')<span>{{ $message }}</span>@enderror
    <label>IFSC</label>
    <input type="text" name="ifsc" value="{{ $user->bank_details['ifsc'] ?? '' }}">
    @error('ifsc')<span>{{ $message }}</span>@enderror
    <label>Account Holder Name</label>
    <input type="text" name="account_holder" value="{{ $user->bank_details['account_holder'] ?? '' }}">
    @error('account_holder')<span>{{ $message }}</span>@enderror
    <button type="submit">Save</button>
</form>
@endsection
