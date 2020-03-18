<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class transactionController extends Controller
{
    public function index() 
    {
        return view('products/transaction');
    }
}
