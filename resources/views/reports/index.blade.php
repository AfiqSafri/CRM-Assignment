@extends('layouts.app')

@section('content')
    <h1>Customer Report</h1>

    <form action="{{ route('reports.index') }}" method="GET">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="from_date">From Date:</label>
                <input type="date" id="from_date" name="from_date" class="form-control" value="{{ $fromDate }}">
            </div>
            <div class="form-group col-md-3">
                <label for="to_date">To Date:</label>
                <input type="date" id="to_date" name="to_date" class="form-control" value="{{ $toDate }}">
            </div>
            <div class="form-group col-md-3">
                <label for="status">Status:</label>
                <select id="status" name="status" class="form-control">
                    <option value="">All</option>
                    <option value="new" {{ $status == 'new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ $status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="dropped off" {{ $status == 'dropped off' ? 'selected' : '' }}>Dropped Off</option>
                    <option value="converted" {{ $status == 'converted' ? 'selected' : '' }}>Converted</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
                <a href="{{ route('reports.export.pdf', ['from_date' => $fromDate, 'to_date' => $toDate, 'status' => $status]) }}" class="btn btn-danger mt-4 ml-2">Export to PDF</a>
                <a href="{{ route('reports.export.excel', ['from_date' => $fromDate, 'to_date' => $toDate, 'status' => $status]) }}" class="btn btn-success mt-4 ml-2">Export to Excel</a>
            </div>
        </div>
    </form>

    <form action="{{ route('reports.index') }}" method="GET" class="mt-3">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="search">Search Name, Email, or Phone:</label>
                <input type="text" id="search" name="search" class="form-control" value="{{ $search }}">
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary mt-4">Search</button>
            </div>
        </div>
    </form>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->status }}</td>
                    <td>{{ $customer->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
