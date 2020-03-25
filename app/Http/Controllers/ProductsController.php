<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Products as products;
use Auth;

class ProductsController extends Controller
{
    //panggil class , aturnya di web
    public function index(Request $request) {
        return view('products/products');
    }

    public function wood(Request $request) {
        $productslist = Products::where('product_type', 1)->get()->toArray();
        //return $productslist;
        //->with(['productslist'=>$productslist]);

        //return redirect()->route("woodlist")->with('type', '木造')->with(['productslist'=>$productslist]);
        return view('products/productlist' , ['productslist'=>$productslist])->with('alert', '木造');
    }

    public function other(Request $request) {

        $productslist = Products::where('product_type', 2)->get()->toArray();
        // $products = new Products();
        // $data = $products->getOtherList();

        //return redirect()->back()->with('alert', '材料');
        return view('products/productlist', ['productslist'=> $productslist ])->with('alert', '材料');;
      }

    public function addproduct(Request $request) {
        if ($request->isMethod('get')) 
        {
            return view('products/add');
        } 
        else if ($request->isMethod('post')) {

            $rules = [
                'product_type' => ['required'],
                'product_name' => ['required', 'not_in:0'],
                'product_image' => ['required' , 'image', 'mimes:jpg,jpeg,png'],
                //'img' => ['required', 'image','mimes:jpg,jpeg,png'],
            ];
    
            $messages = [
                'product_type.required' => '商品類を選択しください',
                'product_name.required' => '商品名を入力してください',
                'product_image.required' => '商品画像をアップロードしてください',
                'product_image.image' => '商品画像は画像だけお願いします',
                'product_image.mimes' => '商品画像の種類はpng/jpeg/jpgをお願いします。',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else {
            //   var_dump($request->product_image);
            //   var_dump($request->HasFile('product_image'));
            //   var_dump($request->file('product_image'));
    
            //   echo $request->file('product_image');
    
            //   var_dump( $request->product_image);
            //   var_dump ($request->product_image->path());
            //   $request->product_image('file')->move(base_path('app/temp'));
            //   $extension = explode('.' , request()->product_image);
            //   $extension = end($extension);
            //   echo $extension;
    
            //  echo request()->product_name.'.'.request()->product_image->getClientOriginalExtension();      

                
                $imageName = $request->product_name.'.'.$request->product_image->getClientOriginalExtension();
                //echo $imageName;
                $temppath = public_path('upload\temp');
                // echo $temppath;
                $move = $request->product_image->move($temppath, $imageName);
                $pathimage = '/upload/temp/'.$imageName;
                // echo $pathimage;

                $data["product_name"] = $request->product_name;
                $data["product_image"] = $pathimage;
                $data["product_type"] = $request->product_type;
                
                return view('products/confirmadd' , ['newproducts' => $data]);
            }

            //dd($request->all());
            //$path = $request->file('product_image')->store('avatars');
            // $upload_name = $_FILES['product_image'];
            
        }   

    }
    public function confirmproduct(Request $request) {

        $products = new Products();
        $products->product_name = $request->product_name;
        $products->product_type = $request->product_type;
        $products->product_image = "abc.jpg";
        $products->created_by_user_id = Auth::User()->user_id;
        $products->created_by_user_name = Auth::user()->user_name;
        $products->save();

        //katanya sih buat masukin ke database
        //$path = 'upload\temp' . $imageName;
        //$request->product_image = $path;

        return redirect()->route("productlist")->with('alert-success', '追加しました');
       
    }

}


           
