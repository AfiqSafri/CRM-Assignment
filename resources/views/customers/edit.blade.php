{{-- @extends('layouts.app')

@section('content')
<h1>Edit Customer</h1>

<form action="{{ route('customers.update', $customer) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name }}">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}">
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $customer->phone_number }}">
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ $customer->address }}">
    </div>
    <div class="form-group">
        <label for="id_number">ID Number:</label>
        <input type="text" name="id_number" id="id_number" class="form-control" value="{{ $customer->id_number }}">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update Customer</button>
</form>
@endsection --}}

{{-- @extends('layouts.app')

@section('content')
<h1>Edit Customer</h1>

<form action="{{ route('customers.update', $customer) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}" required>
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $customer->phone_number }}" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ $customer->address }}" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update Customer</button>
</form>
@endsection --}}

@extends('layouts.app')

@section('content')
<h1>Edit Customer</h1>

<form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}" required>
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $customer->phone_number }}" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ $customer->address }}" required>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar" id="avatar" class="form-control">
        @if($customer->avatar)
            <div class="mt-2">
                <img src="{{ asset($customer->avatar) }}" alt="{{ $customer->name }}'s Avatar" style="width:150px; height:150px; object-fit:cover;">
            </div>
        @endif
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update Customer</button>
</form>
@endsection

