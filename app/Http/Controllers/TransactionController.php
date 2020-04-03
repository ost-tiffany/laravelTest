<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products as products;
use App\Models\Transactions as transaction;
use App\Models\DetailTransaction as detail;
use Auth;

class transactionController extends Controller
{
    public function index() {
        $transaction = New Transaction();
        $transactions = $transaction->getTransactionList();

        return view('transactions/mytransaction', ['transactions' => $transactions]);
    }

    public function show(Request $request, $transaction_id=null) {
        $detailtransaction = New Transaction();
        $detailtransactions = $detailtransaction->getDetailTransactionList($transaction_id);
        
        $transaction = New Transaction();
        $transactions = $transaction->getTransactionList($transaction_id);

        if($transaction_id != "") {
            $caritransaksi = transaction::find($transaction_id);

            if($caritransaksi == NULL) {
                return redirect()->route('transactionlist')->with("alert-none", "取引がありません");
            }
            else {
                return view('transactions/viewtransaction', ["transaction_id"=> $transaction_id , 'transactions' => $transactions, 'detailtransactions' => $detailtransactions]);
            }
            
        }
    }

    public function make(Request $request) {
        if ($request->isMethod('get')) {
            $products = New Products();
            $productName = $products->getProductNameTransaction();
    
            return view('transactions/addtransaction', ['productname'=> $productName]);
        }
        
        else if($request->isMethod('post')) {

            $rules = [
                'date' => ['required','after:today'],
                'address' => ['required'],
                'memo' => ['required'],
                // '*.quantity' => ['required'],
            ];
    
            $messages = [
                'date.required' => '注文日を選択しください',
                'date.after' => '登録する日にちは最低のは明日です。' ,
                'address.required' => '住所を入力してください',
                'memo.required' => 'メモがない場合「なし」を記入してください',
                //'*.quantity.required' => '数量を確認してください', buat semua pake bintang
            ];
            
            for ($i=0; $i <count($request->quantity) ; $i++) { 
                $rules['quantity.'.$i] = 'required';
                $messages['quantity.'.$i.'.required'] = '数量を確認してください';
            }
            
            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else {

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

    public function editorder(Request $request, $transaction_id) {
        if ($request->isMethod('get')) {

            if($transaction_id != "") {
                $caritransaksi = transaction::find($transaction_id);
    
                if($caritransaksi == NULL || $caritransaksi->status != 1 || $caritransaksi->delete_flag != 0 ) {
                    return redirect()->route('transactionlist')->with("alert-none", "取引がありません");
                }
                else {
                    $products = New Products();
                    $productName = $products->getProductNameTransaction();

                    $detiltransaction = New Transaction();
                    $detailtransactions = $detiltransaction->getDetailTransactionList($transaction_id);
            
                    $transactions = transaction::where('transaction_id', $transaction_id)->get()->ToArray();
    
                    return view('transactions/edittransaction' , ['transaction_id'=> $transaction_id, 'detiltransaction' => $detailtransactions, 'transaction' => $transactions, 'productname'=> $productName]);
                }
            }
        }
        else if ($request->isMethod('post')) {
            
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
            
            return view('transactions/confirmedit' , ['transaction_id'=> $transaction_id , 'orders'=> $order]);
        }   
    }

    public function editorderconfirm(Request $request, $transaction_id) {
        if ($request->isMethod('post')) {
           
            $transaction = transaction::find($request->transaction_id);

            $transaction->address = $request->address ;
            $transaction->memo = $request->memo;
            $transaction->status = 1;
            $transaction->transaction_date = date("yy-m-d", strtotime($request->date));
            $transaction->updated_by_user_id = Auth::User()->user_id;
            $transaction->updated_by_user_name = Auth::user()->user_name;
            $transaction->save();

            if($transaction->save()) {

                detail::where('transaction_id',  $request->transaction_id)
                    ->update(['delete_flag' => 1] );
                
                for ($i=0; $i < count($request->item) ; $i++) { 
                    $detail = New Detail();
                    $detail->transaction_id = $request->transaction_id;
                    $detail->product_id = $request->item[$i];
                    $detail->quantity = $request->quantity[$i];
                    $detail->updated_by_user_id = Auth::User()->user_id;
                    $detail->updated_by_user_name = Auth::user()->user_name;
                    $detail->created_by_user_id = Auth::User()->user_id;
                    $detail->created_by_user_name = Auth::user()->user_name;
                    $detail->save();

                    // // echo $request->item[$i]. ' ' . $request->quantity[$i];
                    // // hanya ganti qty 
                    // $detail_id = detail::where("product_id" , $request->item[$i])->where("transaction_id", $transaction_id)->first();
                    // // kalau ganti product id
                    // $details  = detail::find($detail_id->detail_id);
                    // $details->product_id = $request->item[$i];
                    // $details->quantity = $request->quantity[$i];
                    // $details->updated_by_user_id = Auth::User()->user_id;
                    // $details->updated_by_user_name =Auth::user()->user_name;

                    // $details->save();
                    // // detail::where('transaction_id', '=', $request->transaction_id)->update(['product_id' => $request->item[$i]], ['quantity' => $request->quantity[$i]], ['updated_by_user_id' => Auth::User()->user_id], ['updated_by_user_name' => Auth::user()->user_name]);
                }
            }
            return redirect()->route("transactionlist")->with('alert-success', '注文詳細を編集しました！');
        }
   
    }

    public function delete(Request $request) {

        $transaction = transaction::find($request->transaction_id);

        $transaction->updated_by_user_id = Auth::User()->user_id;
        $transaction->updated_by_user_name = Auth::user()->user_name;
       
        if($request->action == 1) {
            $transaction->status = 2;

            $alert = "取り消し完了";
            $type = "取り消しました";

        }
        else {
            $transaction->delete_flag = 1;

            detail::where('transaction_id',  $request->transaction_id)
                    ->update(['delete_flag' => 1],
                            ['created_by_user_id' => Auth::User()->user_id],
                            ['created_by_user_name' => Auth::user()->user_name]);

            $alert = "削除完了!";
            $type = " 削除";
        }
        
        $transaction->save();

            return redirect()->route("transactionlist")->with('alert', $alert)->with('type', $type);

    }


    //transaction total qty
    public function count(Request $request, $transaction_id) {
        $total = detail::where('transaction_id', $transaction_id)->where('delete_flag', 0)->sum('quantity');
        // select sum(quantity) from detailtransaction where transaction_id=12
        echo $total;
    }
    
}
