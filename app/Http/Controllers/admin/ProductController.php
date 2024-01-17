<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Productrequest;
use App\Models\products;
use App\Models\Brand;
use App\Models\category;
use DB;
use Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = Brand::get();
        $categories= category::get();
        $products = products::paginate(10);
        if($key = request()->key){
            $products = products::where('name_prod','like','%'.$key.'%')->paginate(10);
        }
        return view('admin.layouts.product.index',compact('products','brands','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::get();
        $categories= category::get();
        return view('admin.layouts.product.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Productrequest $request)
    {
        //
        if($request->hasFile('logo')){
            $path= 'uploads/img/';
            $thumnail = $request->file('logo');
            $image = $thumnail->getClientOriginalName();
            $path_name = $thumnail->move(public_path($path),$image);
        }
        $data = new products([
            'name_prod'=>$request->name_prod,
            'price'=>$request->price,
            'img'=>$image,
            'soluotxem'=> 0,
            'slug'=>Str::slug($request->name_prod),
            'brand_id'=>$request->brand_id,
            'cate_id'=>$request->cate_id,
            'status_prod'=>$request->status,
            'noibat'=>$request->noibat,
            'description'=>$request->mota, 
        ]);
        if($data){
            $data->save();
            return redirect('/admin/product/index')->with('message','Thêm thành công');
        }else{
            return back()->with('err','Lỗi thêm sản phẩm');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $brands = Brand::get();
        $categories= category::get();
        $product = products::find($id);
        return view('admin.layouts.product.edit',compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $product = products::find($id);
        if($product){
            if($request->hasFile('logo')){
                $path= 'uploads/img';
                $thumnail = $request->file('logo');
                $image = $thumnail->getClientOriginalName();
                $path_name = $thumnail->move(public_path($path),$image);
            }else $image = $request->image;


            $product->name_prod = $request->name;
            $product->price = $request->price;
            $product->img = $image;
            $product->noibat = $request->noibat;
            $product->status_prod = $request->status;
            $product->description = $request->mota;
            $product->cate_id = $request->cate_id;
            $product->brand_id = $request->brand_id;
            $product->slug = Str::slug($request->name);

            $product->save();
            return redirect('/admin/product/index')->with('message','Cập nhật thành công');

        }else{
            return back()->with('err','Cập nhật bị lỗi');
        }
        
        
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = products::find($id);
        if($product){
            $product->delete();
            return redirect('/admin/product/index')->with('message','Xóa thành công');
        }else{
            return back()->with('err','Xóa bị lỗi');
        }

    }
}
