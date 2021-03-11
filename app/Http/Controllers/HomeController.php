<?php

namespace App\Http\Controllers;

use App\Models\Billing;
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
        $totalPatient = Patient::count();
        $totalBilling = Billing::sum('total_price');
        $totalRegistration = Registration::count();

        return view('home', compact('totalPatient', 'totalBilling', 'totalRegistration'));
    }
}
