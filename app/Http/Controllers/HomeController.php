<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Item;
use App\Models\Patient;
use App\Models\Registration;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function welcome()
    {
        return view('auth.login');
    }

    public function index()
    {
        $totalPatients = Patient::count();
        $totalBillings = Billing::sum('total_price');
        $totalRegistrations = Registration::count();
        $totalItems = Item::count();

        return view('home', compact('totalPatients', 'totalBillings', 'totalRegistrations', 'totalItems'));
    }
}
