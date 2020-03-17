<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products as products;

class ProductsController extends Controller
{
    //panggil class , aturnya di web
    public function index(Request $request) {
        $products = new Products();
        $data = $products->getproductsList();
        return view('products/products', ['productlist'=>$data]);
    }
}
