@extends('layouts.app')

@section('content')
<h1>Customer Details</h1>

<div class="card">
    <div class="card-header">
        <h2>{{ $customer->name }}</h2>
    </div>
    <div class="card-body">
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Phone Number:</strong> {{ $customer->phone_number }}</p>
        <p><strong>Address:</strong> {{ $customer->address }}</p>
        <p><strong>ID Number:</strong> {{ $customer->id_number }}</p>
    </div>
</div>

<a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">Back to Customers</a>
@endsection
