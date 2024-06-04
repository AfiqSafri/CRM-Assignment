@extends('layouts.app')

@section('content')
<h1>Customers</h1>
<a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a>

<form method="GET" action="{{ route('customers.index') }}" class="mt-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" placeholder="Search..." class="form-control" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary">Filter</button>
        </div>
    </div>
</form>

<div class="mt-3">
    <a href="{{ route('customers.export.excel', ['from_date' => request('from_date'), 'to_date' => request('to_date')]) }}" class="btn btn-success">Export to Excel</a>
    <a href="{{ route('customers.export.pdf', ['from_date' => request('from_date'), 'to_date' => request('to_date')]) }}" class="btn btn-danger">Export to PDF</a>
</div>

<table class="table mt-3">
    <thead>
        <tr>
            <th>ID Number</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id_number }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->address }}</td>
                <td>
                    <a href="{{ route('customers.show', $customer) }}" class="btn btn-info">View</a>
                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $customers->links() }}
@endsection
