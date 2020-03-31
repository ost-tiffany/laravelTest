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
use App\Models\Types as types;
use Auth;

class ProductsController extends Controller
{
    //panggil class , aturnya di web
    public function index(Request $request , $type_id=null) {

        // product type
        $types = new Types();
        $data = $types->getTypeList();

        $products = new Products();
        $productslist = $products->getProductlist($type_id);

        if($type_id != '') {
            //$productslist = Products::join('types', 'products.product_type', '=', 'types.type_id')->where('product_type', $type_id)->where('delete_flag', 0)->get()->toArray();
            return view('products/productlist' , ['productslist'=>$productslist, 'types'=>$data]);
        } else {
            //products latest
            //$products = Products::join('types', 'products.product_type', '=', 'types.type_id')->where('delete_flag', 0)->latest()->limit(10)->get()->toArray();
            return view('products/products' , ['productslist'=> $productslist , 'types'=>$data]);
        }
    }

    public function addproduct(Request $request) {
        if ($request->isMethod('get')) 
        {
            //product-type adalah tabel type
            //product type
            $types = new Types();
            $data = $types->getTypeList();
            return view('products/add', ['types'=>$data]);
        } 
        else if ($request->isMethod('post')) {

            //product-type adalah tabel type
            //product type
            $types = new Types();
            $datatabel = $types->getTypeList();

            $rules = [
                'product_type' => ['required','not_in:0'],
                'product_name' => ['required',],
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

                
                $imageName = str_replace(' ','', $request->product_name.'.'.$request->product_image->getClientOriginalExtension());
                //echo $imageName;
                $temppath = public_path('upload\temp');
                // echo $temppath;
                $move = $request->product_image->move($temppath, $imageName);
                $pathimage = '/upload/temp/'.$imageName;
                // echo $pathimage;
                $data["product_name"] = $request->product_name;
                $data["product_image"] = $pathimage;
                $data["product_image_name"] = $imageName;
                $data["product_type"] = $request->product_type;
                
                return view('products/confirmadd' , ['newproducts' => $data, 'types'=>$datatabel]);
            }

            //dd($request->all());
            //$path = $request->file('product_image')->store('avatars');
            // $upload_name = $_FILES['product_image']; 
        }   
    }

    public function confirmproduct(Request $request) {

        //product-type adalah tabel type
        //product type
        $types = new Types();
        $data = $types->getTypeList();

        if ($request->isMethod('get')) 
        { 
            return view('products/confirmadd' , ['newproducts' => $data, 'types'=>$data]);
        } 
        else if ($request->isMethod('post')) {

            $products = new Products();
            $products->product_name = $request->product_name;
            $products->product_type = $request->product_type;
            $products->product_image = $request->product_image_name;
            $products->created_by_user_id = Auth::User()->user_id;
            $products->created_by_user_name = Auth::user()->user_name;
            $products->save();

            if($products->save()) {
                $product_id = $products->product_id;
                //tentuin path2nya
                // \\keknya nunjukin bkin baru juga kali ya?
                $oldpath = public_path('upload\temp\\'. $products->product_image); //yang lama
                $path =  public_path('upload\\'.$product_id.'\\'. $products->product_image); //yang baru
                $folder =  public_path('upload\\'.$product_id); //demi bkin folder

                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                //move file dari old path ke path baru
                rename($oldpath, $path);
                // echo $oldpath;
                // echo $path;
                
                return redirect()->route("productlist")->with('alert-success', '追加しました');
            }
        }
    }

    public function productedit(Request $request, $product_id) {

        //product-type adalah tabel type
        //product type
        $types = new Types();
        $data = $types->getTypeList();

        if($request->isMethod('get')) {
            $product = Products::where('product_id', $product_id)->get()->toArray();

            return view('products/productedit', ['product_id'=>$product_id, 'productsdata'=>$product, 'types'=>$data]);
        }

        if($request->isMethod('post')) {
           
            $rules = [
                'product_type' => ['required','not_in:0'],
                'product_name' => ['required'],
                'product_image' => ['image', 'mimes:jpg,jpeg,png'],
            ];
    
            $messages = [
                'product_type.required' => '商品類を選択しください',
                'product_name.required' => '商品名を入力してください',
                'product_image.image' => '商品画像は画像だけお願いします',
                'product_image.mimes' => '商品画像の種類はpng/jpeg/jpgをお願いします。',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else {
                
                if($request->product_image == "") {
                    $imageName = $request->product_image_old;
                    $id = $request->product_id;
                    $pathimage = '/upload'.'/'.$id.'/'.$imageName;

                    // echo $imageName;
                    // echo $pathimage;   
                } 
                else {

                    $imageName = str_replace(' ','', $request->product_name.'.'.$request->product_image->getClientOriginalExtension());
                    //echo $imageName;
                    $temppath = public_path('upload\temp');
                    // echo $temppath;
                    $move = $request->product_image->move($temppath, $imageName);
                    $pathimage = '/upload/temp/'.$imageName;
                }
            
                $newproduct["product_name"] = $request->product_name;
                $newproduct["product_type"] = $request->product_type ;
                $newproduct["product_image_name"] = $imageName;
                $newproduct["product_image"] = $pathimage;
                $newproduct["product_image_name_old"] = $request->product_image_old;

           return view('products/confirmedit', ['product_id'=>$product_id, 'productdata'=>$newproduct, 'types'=>$data]);
            }
        }
    }

    public function producteditconfirm(Request $request, $product_id) {

        if ($request->isMethod('get')) 
        {
            //product-type adalah tabel type
            //product type
            $types = new Types();
            $data = $types->getTypeList();

            return view('products/confirmedit', ['product_id'=>$product_id, 'productdata'=>$newproduct, 'types'=>$data]);

        } 
        else if ($request->isMethod('post')) {

            $product = Products::find($product_id);
            $product->product_name = $request->product_name;
            $product->product_type = $request->product_type;
            $product->product_image = $request->product_image_name;
            $product->updated_by_user_id = Auth::User()->user_id;
            $product->updated_by_user_name = Auth::user()->user_name;
            $product->save();

            if($product->save()) {
                $path = $request->product_image;
                $name = $request->product_image_name;

                if($path != "/upload"."/".$product_id."/".$name ) {
                    
                    //tentuin path2nya
                    // \\keknya nunjukin bkin baru juga kali ya?
                    $oldpath = public_path('upload\temp\\'. $product->product_image); //yang lama
                    $path =  public_path('upload\\'.$product_id.'\\'. $product->product_image); //yang baru
                    $folder =  public_path('upload\\'.$product_id); //demi bkin folder

                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }
                    //move file dari old path ke path baru
                    rename($oldpath, $path);
                    // echo $oldpath;
                    // echo $path;

                    //foto lama masuk delete folder
                    $imageOld = $request->product_image_name_old;
                    $oldpath2 = public_path('upload\\'.$product_id.'\\'. $imageOld); //image yang diganti
                    $delete = public_path('upload\delete');
                
                    if (!file_exists($delete)) {
                        mkdir($delete, 0777, true);
                    }
                    rename($oldpath2 , $delete.'\\'.$imageOld);        
                }

            return redirect()->route("productlist")->with('alert-success', '編集しました！');
            }
        }
    }

    public function productdelete(Request $request) {

        $products = Products::find($request->product_id);
        //echo $products;

        $products->delete_flag = 1;
        $products->updated_by_user_id = Auth::User()->user_id;
        $products->updated_by_user_name = Auth::user()->user_name;
        $products->save();

         //foto lama masuk delete folder
         $product_id = $request->product_id;
         $imageOld = $products->product_image;
         $oldpath2 = public_path('upload\\'.$product_id.'\\'. $imageOld); //image yang diganti
         $delete = public_path('upload\delete');
     
         if (!file_exists($delete)) {
             mkdir($delete, 0777, true);
         }
        rename($oldpath2 , $delete.'\\'.$imageOld);
        

        return redirect()->back()->with('alert', '削除完了!')->with('type', '削除');
    }

}


           
