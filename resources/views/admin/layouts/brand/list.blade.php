@extends('layouts.admin.app')
@section('content')
<div class="content_yield">
	<div class="row">
		<h3 class="page_title">Nhãn hiệu</h3>
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
	<a href="/admin/brand/create" class="btn bg-color-green add_new_button"><i class="fas fa-plus"></i> Thêm mới</a>

	<table class="table table_xk table-hover table-bordered">
		<thead class="thead_green">
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">Logo</th>
				<th class="text-center">Tên nhãn hiệu</th>
				<th class="text-center">Trạng thái</th>
				<th class="text-center">#</th>
			</tr>
		</thead>
		<tbody>
			<!-- Loop -->
           @foreach($brands as $brand)
			<tr>
				<td class="text-center">{{$brand->id_brand}}</td>
				<td class="text-center">
					<img src="{{asset('uploads/img/'.$brand->img)}}" width="50" height="50" alt="logo">
				</td>
				<td class="text-center">
					<a href="">
						<h4>{{$brand->name_brand}}</h4>
					</a>
				</td>
				
				<td class="text-center">{{$brand->status==0?'Hiện':'Ẩn'}}</td>
				<td class="text-center action_icon">
					<a href="/admin/brand/edit/{{$brand->id_brand}}"><i class="far fa-edit edit"></i></a>
					<a href="/admin/brand/delete/{{$brand->id_brand}}" class="fas fa-trash-alt deletebutton text-danger btn" ></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


@endsection