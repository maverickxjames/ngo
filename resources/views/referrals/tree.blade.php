@extends('layouts.app')

@section('content')
<h1>Referral Tree</h1>
<pre>{{ json_encode($tree, JSON_PRETTY_PRINT) }}</pre>
@endsection
