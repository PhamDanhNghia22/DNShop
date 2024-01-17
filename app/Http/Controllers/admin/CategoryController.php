<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\category;
use DB;
use Str;
class CategoryController extends Controller
{
    public function index(){
        $categories = category::get();
        return view('admin.layouts.category.list', compact('categories'));
    }
    public function create(){
        return view('admin.layouts.category.create');
    }

    public function store(CategoryRequest $request){

        $data = new category(
            [
                'name_cate' => $request->name_cate,
                'slug' => Str::slug($request->name_cate),
                'status' => $request->status
            ]
        );
        if($data){
            $data->save();
            return redirect('/admin/category/index')->with('message','Thêm thành công');

        }else{
            return back()->with('err','Thêm đã bị lỗi');
        }
        


    }

    public function edit($id){
        $category = category::find($id);
        return view('admin.layouts.category.edit',compact('category'));
    }

    public function update(Request $request, $id){
        $category = category::find($id);
        if($category){
            $category->name_cate= $request->name;
            $category->status= $request->status;
            $category->slug= Str::slug($request->name);
            $category->save();
            return redirect('/admin/category/index')->with('message','Thêm thành công');
        }else{
            return back()->with('err','Cập nhật đã bị lỗi');
        }
        

    }

    public function delete($id){
        $category = category::find($id);
        if($category){
            $category->delete();
            return redirect('/admin/category/index')->with('message','Xóa thành công');
        }else{
            return back()->with('err','Không thể xóa');
        }
    }
}
