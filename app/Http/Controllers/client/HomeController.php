<?php

namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Brand;
use DB;
class HomeController extends Controller
{
    //
    public function index(){
        $brands= Brand::get();
        $products = products::orderBy('id_prod','desc')->paginate(8);
        $SellProducts = products::join('cart','cart.prodID','=','products.id_prod')
        ->select('products.id_prod','products.name_prod','products.price','products.img','products.slug',DB::raw('COUNT(cart.prodID) as prodID'))
        ->orderBy('products.id_prod','desc')
        ->groupBy('products.id_prod')
        ->paginate(8);

        return view('client.layouts.home',compact('products','SellProducts'));
        // return view('welcome');
    }
    
    public function ProductDetail($slug){
        $relateProd = products::inRandomOrder()->limit(5)->get();
        $productDetail = products::where('slug',$slug)->first();
        $productDetail['soluotxem']= $productDetail['soluotxem'] +1;
        $productDetail->update();
        return view('client.layouts.ProductDetail',compact('productDetail','relateProd'));

    }

    
}
