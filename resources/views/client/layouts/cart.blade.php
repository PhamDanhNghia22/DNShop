@extends('layouts.client.app')
@section('content')
<section class="cart_area">
            @if(session('cart'))
                @if(Session::has('message'))
                <div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                    <strong>{{ Session::get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
			@else
			<div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
				<strong>Giỏ hàng của bạn đang trống</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
            @endif
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Product</th>
                              <th scope="col">Price</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total</th>
                          </tr>
                      </thead>
                      <tbody>
					  <?php $total=0; ?>
						@if(session('cart'))
						@foreach(session('cart') as $id => $details)
						<?php 
						$tt= $details['quantity'] * $details['price'] ;
						$total += $tt;
						?>
                          <tr>
                              <td>
                                  <div class="media">
                                      <div class="d-flex">
                                          <img src="{{asset('uploads/img/'.$details['img'])}}" style="width:200px" alt="">
                                      </div>
                                      <div class="media-body">
                                          <p>{{$details['name']}}</p>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <h5>{{number_format($details['price'])}} VNĐ</h5>
                              </td>
                              <td>
                                  <div class="product_count">
                                      <input type="text" name="qty" id="sst" maxlength="12" value="{{$details['quantity']}}" title="Quantity:"
                                          class="input-text qty">
                                      <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                          class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                      <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                          class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                  </div>
                              </td>
                              <td>
                                  <h5>{{ number_format($tt) }} VNĐ</h5>
                              </td>
                          </tr>
                          @endforeach
            			@endif
                          <tr>
                              <td>

                              </td>
                              <td>

                              </td>
                              <td>
                                  <h5>Subtotal</h5>
                              </td>
                              <td>
                                  <h5> {{ number_format($total) }} VNĐ</h5>
                              </td>
                          </tr>
						  
                          <tr class="shipping_area">
                              <td class="d-none d-md-block">

                              </td>
                              <td>

                              </td>
                              <td>
                              <a href="/deletecart" class="btn btn-danger">Delete Cart</a>
                              </td>
                              <td>
                                  <!-- <div class="shipping_box">
                                      <ul class="list">
                                          <li><a href="#">Flat Rate: $5.00</a></li>
                                          <li><a href="#">Free Shipping</a></li>
                                          <li><a href="#">Flat Rate: $10.00</a></li>
                                          <li class="active"><a href="#">Local Delivery: $2.00</a></li>
                                      </ul>
                                      <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                      <select class="shipping_select">
                                          <option value="1">Bangladesh</option>
                                          <option value="2">India</option>
                                          <option value="4">Pakistan</option>
                                      </select>
                                      <select class="shipping_select">
                                          <option value="1">Select a State</option>
                                          <option value="2">Select a State</option>
                                          <option value="4">Select a State</option>
                                      </select>
                                      <input type="text" placeholder="Postcode/Zipcode">
                                      
                                  </div> -->
                                  
                                  <a class="gray_btn" href="#">Update Details</a>
                              </td>
                          </tr>
                          <tr class="out_button_area">
                              <td class="d-none-l">

                              </td>
                              <td class="">

                              </td>
                              <td>

                              </td>
                              <td>
                                
                                  <div class="checkout_btn_inner d-flex align-items-center">
                                      <a class="gray_btn" href="/">Continue Shopping</a>
                                      <a class="primary-btn ml-2" href="/checkout">Proceed to checkout</a>
                                  </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
</section>

<!-- <div class="width-30 ">
	<h3>Thông tin đặt hàng</h3>
	<form action="/addOrder" method="post">
		@csrf
		<div class="form-group mb-3">
		<label for="">Họ và tên</label>
		<input type="text" name="username" class="form-control">
		</div>
		<div class="form-group mb-3">
		<label for="">Email</label>
		<input type="email" name="email" class="form-control">
		</div>
		<div class="form-group mb-3">
		<label for="">Số điện thoại</label>
		<input type="text" name="phone" class="form-control">
		</div>
		<div class="form-group mb-3">
		<label for="">Địa chỉ</label>
		<input type="text" name="address" class="form-control">
		</div>
		<div class="form-group mb-3">
		<input type="hidden" name="total" class="form-control" value="{{ $total }}">
		</div>
		<button type="submit" class="btn btn-warning text-white">Thanh toán</button>
        <form  method="POST">
        @csrf
        <input type="hidden" name="total" value="{{$total}}">
        <button type="submit" name="payment" value="2"  class="btn btn-primary text-white" >Thanh toán online</button>
    </form>
		
	</form>
   
</div>

</div> -->


@endsection