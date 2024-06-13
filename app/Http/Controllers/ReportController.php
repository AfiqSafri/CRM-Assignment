<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve query parameters
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $status = $request->input('status');
        $search = $request->input('search');

        // Initialize query builder
        $query = Customer::query();

        // Apply date range filter
        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }

        // Apply status filter
        if ($status) {
            $query->where('status', $status);
        }

        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone_number', 'like', '%' . $search . '%');
            });
        }

        // Retrieve filtered customers
        $customers = $query->get();

        return view('reports.index', compact('customers', 'fromDate', 'toDate', 'status', 'search'));
    }

    public function exportPDF(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $status = $request->input('status');

        $query = Customer::query();

        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $customers = $query->get();

        $pdf = PDF::loadView('reports.pdf', compact('customers'));
        return $pdf->download('customer_report.pdf');
    }

    public function exportExcel(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $status = $request->input('status');

        return Excel::download(new CustomersExport($fromDate, $toDate, $status), 'customer_report.xlsx');
    }
}
