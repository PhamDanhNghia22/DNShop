@extends('layouts.admin.app')
@section('content')
<div class="content_yield">
        @if(Session::has('message'))
			<div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
				<strong>{{ Session::get('message') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
        @endif
	<form action="/admin/category/update/{{$category->id_cate}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="col-md-12 m-auto">
		<h3 class="mb-5 font-weight-bold">Cập nhật Thể loại</h3>
		<div class="col-lg-10 col-md-12 col-sm-12 row">
			<div class="form-group">
                <label class="form-label font-weight-bold">Tên Thể Loại:</label>
                <input type="text" class="form-control" name="name" placeholder="Tên thể loại" value="{{$category->name_cate}}">
			</div>
			<!-- <div class="form-group">
                <label class="form-label font-weight-bold">Hình ảnh:</label>
                <input type="file" class="form-control" name="logo" placeholder="Logo thể loại">
			</div> -->
			<div class="form-group">
                 <label class="form-label font-weight-bold">Trạng thái</label>
				 <select  name="status"  id="status" class="form-control">
                 <?php 
                        $trangthai= array('0'=>'Hiện','1'=>'Ẩn')
                ?>
                    @foreach($trangthai as $key=> $value)
                    @if($key == $category->status)
                        <option selected value="{{$key}}">{{$value}}</option>
                        @else
                        <option  value="{{$key}}">{{$value}}</option>
                    @endif
                    @endforeach
				 </select>
            	<br>

			</div>
			
			<div class="form-group text-right">
				<a class="btn btn-info mt-3" href="" title="back"><i class="fas fa-arrow-left"> Xem danh sách</i></a>
                <button type="submit" class="font-weight-bold text-white btn bg-color-green mt-3">Lưu</button>
			</div>
		</div>
	</div>
    </form>
</div>
<script language='javascript'>
 function isNumberKey(evt)
 {
 	var charCode = (evt.which) ? evt.which : event.keyCode
 	if (charCode > 31 && (charCode < 48 || charCode > 57))
 		return false;
 		return true;
 }
 </script>
@endsection
