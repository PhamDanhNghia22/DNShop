@extends('layouts.admin.app')
@section('content')
<div class="content_yield">
	<div class="row">
		<h3 class="page_title">Sản phẩm</h3>
		<div class="col-md-12">
			@if(Session::has('message'))
			<div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
				<strong>{{ Session::get('message') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@elseif(Session::has('err'))
			<div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
				<strong>{{ Session::get('err') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
		</div>

	</div>
	<div class="d-flex ">
		<a href="/admin/product/create" class="btn bg-color-green add_new_button"><i class="fas fa-plus"></i> Thêm mới</a>
		<form action=""class="" role="form">
			<input type="text" class="p-2" placeholder="Tìm kiếm....." name="key" value="{{request()->key}}" />
			<button type="submit" class="btn  bg-color-green ">Tìm kiếm</button>
		</form>
	</div>
	
	<table class="table table_xk table-hover table-bordered">
		<thead class="thead_green">
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">Logo</th>
				<th class="text-center">Tên sản phẩm</th>
				<th class="text-center">Trạng thái</th>
				<th class="text-center">Nổi bật</th>
				<th class="text-center">Thể loại</th>
				<th class="text-center">Thương Hiệu</th>
				<th class="text-center">#</th>
			</tr>
		</thead>
		<tbody>
			<!-- Loop -->
           @foreach($products as $product)
			<tr>
				<td class="text-center">{{$product->id_prod}}</td>
				<td class="text-center">
					<img src="{{asset('uploads/img/'.$product->img)}}" width="50" height="50" alt="logo">
				</td>
				<td class="text-center">
					<a href="">
						<h4>{{$product->name_prod}}</h4>
					</a>
				</td>
				
				<td class="text-center">{{$product->status_prod==0?'Hiện':'Ẩn'}}</td>
				<td class="text-center">{{$product->noibat==0?'Hiện':'Ẩn'}}</td>
                <td class="text-center">
                    @foreach($categories as $category)
                        @if($product->cate_id == $category->id_cate)
                            {{$category->name_cate}}
                        @endif
                    @endforeach
                </td>
                <td class="text-center">
                    @foreach($brands as $brand)
                        @if($product->brand_id == $brand->id_brand)
                            {{$brand->name_brand}}
                        @endif
                    @endforeach
                </td>
				<td class="text-center action_icon">
					<a href="/admin/product/edit/{{$product->id_prod}}"><i class="far fa-edit edit"></i></a>
					<a href="/admin/product/delete/{{$product->id_prod}}" class="fas fa-trash-alt deletebutton text-danger btn" ></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


@endsection