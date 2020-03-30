<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products as products;
use App\Models\Transactions as transaction;
use App\Models\DetailTransaction as detail;
use Auth;

class transactionController extends Controller
{
    public function index() {

        return view('transactions/mytransaction');
    }

    public function show($transaction_id) {

        return view('transactions/viewtransaction');
    }

    public function make(Request $request) {
        if ($request->isMethod('get')) {
            $products = New Products();
            $productName = $products->getProductNameTransaction();
    
            return view('transactions/addtransaction', ['productname'=> $productName]);
        }
        
        else if($request->isMethod('post')) {
            $order["date"] = $request->date;
            $order["address"] = $request->address;
            $order["memo"] = $request->memo;
            $order["item"] = $request->item;
            $order["quantity"] = $request->quantity;


            $order["product_name"] = [];
            $order["product_image"] = [];
            //jadi array trs di push jadi bisa begini,
            foreach($order["item"] as $item) {

                $product =  Products::select("product_name", "product_image")->where('product_id', $item)->first();
                array_push($order["product_name"], $product->product_name );
                array_push($order["product_image"], $product->product_image );
            }
            //var_dump($order["product_name"]);
            return view('transactions/confirmorder', ['order'=> $order]);
        }
       
    }

    public function makesure(Request $request) {
         if ($request->isMethod('get')) {
            $product_id = $request->item;
            $productName = Products::select("product_name")->where("product_id" ,$product_id)->get()->toArray();
            return view('transactions/confirmorder', ['order'=> $order, "productName" => $productName]);
        }
        else if($request->isMethod('post')) {
    
            $transaction = new Transaction();
            $transaction->address = $request->address ;
            $transaction->memo = $request->memo;
            $transaction->status = 1;
            $transaction->transaction_date = $request->date;
            $transaction->created_by_user_id = Auth::User()->user_id;
            $transaction->created_by_user_name = Auth::user()->user_name;
            $transaction->save();

            if($transaction->save()) {
                $iddetail = $transaction->transaction_id;
                
                for ($i=0; $i < count($request->item) ; $i++) { 
                    $detail = New Detail();
                    $detail->transaction_id = $iddetail;
                    $detail->product_id = $request->item[$i];
                    $detail->quantity = $request->quantity[$i];
                    $detail->created_by_user_id = Auth::User()->user_id;
                    $detail->created_by_user_name = Auth::user()->user_name;
                    $detail->save();
                }

            }

            return redirect()->route("productlist")->with('alert-success', '注文しました！');
        
        }

    }
}
