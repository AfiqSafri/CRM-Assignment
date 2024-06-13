<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use PDF;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone_number', 'like', "%{$search}%");
            })
            ->paginate(10);
        
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'avatar' => 'nullable|image',
            'status' => 'required|in:new,contacted,dropped off,converted',
        ]);

        $customer = new Customer($request->all());

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $filename);
            $customer->avatar = 'avatars/' . $filename;
        }

        $customer->save();

        return redirect()->route('customers.index');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,'.$customer->id,
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'avatar' => 'nullable|image',
            'status' => 'required|in:new,contacted,dropped off,converted',
        ]);

        $customer->fill($request->all());

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($customer->avatar && file_exists(public_path($customer->avatar))) {
                unlink(public_path($customer->avatar));
            }

            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $filename);
            $customer->avatar = 'avatars/' . $filename;
        }

        $customer->save();

        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }

    public function exportExcel(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        return Excel::download(new CustomersExport($fromDate, $toDate), 'customers.xlsx');
    }
    
    public function exportPDF(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = Customer::query();

        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }

        $customers = $query->get();

        $pdf = PDF::loadView('customers.pdf', compact('customers'));
        return $pdf->download('customers.pdf');
    }
}
