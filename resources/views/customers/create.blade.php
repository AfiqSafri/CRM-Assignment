{{-- @extends('layouts.app')

@section('content')
<h1>Add New Customer</h1>

<form action="{{ route('customers.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control">
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" class="form-control">
    </div>
    <div class="form-group">
        <label for="id_number">ID Number:</label>
        <input type="text" name="id_number" id="id_number" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Add Customer</button>
</form>
@endsection --}}

{{-- @extends('layouts.app')

@section('content')
<h1>Add New Customer</h1>

<form action="{{ route('customers.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Add Customer</button>
</form>
@endsection --}}

@extends('layouts.app')

@section('content')
<h1>Add New Customer</h1>

<form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar" id="avatar" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Add Customer</button>
</form>
@endsection

