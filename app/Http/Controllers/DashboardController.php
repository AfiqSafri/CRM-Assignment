<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $statuses = ['new', 'contacted', 'dropped off', 'converted'];
        $counts = [];

        foreach ($statuses as $status) {
            $counts[$status] = Customer::where('status', $status)->count();
        }

        return view('dashboard.index', compact('counts'));
    }
}
