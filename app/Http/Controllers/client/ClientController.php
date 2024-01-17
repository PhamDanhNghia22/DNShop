<?php

namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\category;
use App\Models\products;
class ClientController extends Controller
{
    //
    public static function getBrands(){
        return Brand::get();
    }
    public static function getCategories(){
        return category::get();
    }

    public function Allproduct(){
        $products = products::orderby('id_prod','desc')->get();
        if($key=request()->key){
            $products = products::orderby('id_prod','desc')->where('name_prod','like',"%{$key}%")->get();
        }
        return view('client.layouts.shop',compact('products'));
    }
    public function ProductBrand($slug){
        $brand = Brand::first();
        $products= products::join('brand','products.brand_id','=','brand.id_brand')
        ->select('products.id_prod','products.name_prod','products.price','products.slug','products.img','brand.name_brand')->
        where('brand.slug_brand',$slug)->get();
        if($key=request()->key){
            $products = products::orderby('id_prod','desc')->where('name_prod','like',"%{$key}%")->get();
        }

        return view('client.layouts.shop',compact('products','brand'));
        
    }
}
