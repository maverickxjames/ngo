@extends('layouts.app')

@section('content')
<h1>Enter MPIN</h1>
<form method="POST" action="{{ route('mpin.verify') }}">
    @csrf
    <label>MPIN</label>
    <input type="password" name="mpin" autofocus>
    @error('mpin')<span>{{ $message }}</span>@enderror
    <button type="submit">Verify</button>
</form>
@endsection
