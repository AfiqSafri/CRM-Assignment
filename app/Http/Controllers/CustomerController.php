<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
// use Barryvdh\DomPDF\Facade as PDF;
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
            'id_number' => 'required|string|max:50|unique:customers',
        ]);

        $customer = new Customer($request->all());
        
        if ($request->hasFile('avatar')) {
            $customer->avatar = $request->file('avatar')->store('avatars');
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
            'id_number' => 'required|string|max:50|unique:customers,id_number,'.$customer->id,
        ]);

        $customer->fill($request->all());
        
        if ($request->hasFile('avatar')) {
            $customer->avatar = $request->file('avatar')->store('avatars');
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
