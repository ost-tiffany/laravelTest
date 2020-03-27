<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class transactionController extends Controller
{
    public function index() {

        return view('transactions/mytransaction');
    }

    public function show($transaction_id) {

        return view('transactions/viewtransaction');
    }

    public function make() {
        return view('transactions/addtransaction');
    }
}
