<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use DB;
use App\Http\Requests\BrandRequest;
use Str;
class BrandController extends Controller
{
    public function index(){
        $brands= Brand::get();
        // $DetailBrand = Brand::first();
        return view('admin.layouts.brand.list',compact('brands'));
    }
    public function create(){
        $brands= Brand::get();
        // echo $DetailBrand;
        return view('admin.layouts.brand.create',compact('brands'));
    }

    public function store(BrandRequest $request ){

        // $validation = Validator::make($request->all(),[
        //     'name'=> 'required|uniqued:brand',
        //     'logo'=>'required|mimes:jpg,bmp,png|file',
        //     'status'=>'required|in:0,1',

        // ]);
        if ($request->hasFile('logo')) {
            $path = 'uploads/img';
            $thumnail = $request->file('logo');
            $image = $thumnail->getClientOriginalName();
            $path_name = $request->file('logo')->move(public_path($path), $image);
        }
        

        $data = new Brand([
            'name_brand'=> $request->name_brand,
            'slug_brand'=>Str::slug($request->name_brand),
            'img'=>$image,
            'status'=>$request->status
        ]);
        $data->save();
        return redirect('/admin/brand/index')->with('message','Thêm thành công');



    }

    public function edit($id){
        $brand= Brand::find($id);
        return view('admin.layouts.brand.edit',compact('brand'));
    }

    public function update(Request $request, $id){
        if ($request->hasFile('logo')) {
            $path = 'uploads/img';
            $thumnail = $request->file('logo');
            $image = $thumnail->getClientOriginalName();
            $path_name = $request->file('logo')->move(public_path($path), $image);
        }else{
            $image = $thumnail->getClientOriginalName();
        }
        $brand= Brand::find($id);
        $brand->name_brand = $request->name;
        $brand->slug_brand = Str::slug($request->name);
        $brand->img= $image;
        $brand->status= $request->status;
        $brand->save();
        return redirect('/admin/brand/index')->with('message','Cập nhật thành công');

    }

    public function delete($id){
        $brand= Brand::find($id);
        if($brand){
            $brand->delete();
            return redirect('/admin/brand/index')->with('message','Xóa thành công');
        }
    }
}
