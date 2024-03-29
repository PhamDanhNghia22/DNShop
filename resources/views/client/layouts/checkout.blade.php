@extends('layouts.client.app')
@section('content')
<!--================Checkout Area =================-->
<section class="checkout_area section-margin--small">
    <div class="container">
        <div class="returning_customer">
            <div class="check_title">
                <h2>Returning Customer? <a href="#">Click here to login</a></h2>
            </div>
            <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new
                customer, please proceed to the Billing & Shipping section.</p>
            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                <div class="col-md-6 form-group p_star">
                    <input type="text" class="form-control" placeholder="Username or Email*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Username or Email*'" id="name" name="name">
                    <!-- <span class="placeholder" data-placeholder="Username or Email"></span> -->
                </div>
                <div class="col-md-6 form-group p_star">
                    <input type="password" class="form-control" placeholder="Password*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password*'" id="password" name="password">
                    <!-- <span class="placeholder" data-placeholder="Password"></span> -->
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" value="submit" class="button button-login">login</button>
                    <div class="creat_account">
                        <input type="checkbox" id="f-option" name="selector">
                        <label for="f-option">Remember me</label>
                    </div>
                    <a class="lost_pass" href="#">Lost your password?</a>
                </div>
            </form>
        </div>
        <div class="cupon_area">
            <div class="check_title">
                <h2>Have a coupon? <a href="#">Click here to enter your code</a></h2>
            </div>
            <input type="text" placeholder="Enter coupon code">
            <a class="button button-coupon" href="#">Apply Coupon</a>
        </div>
        <div class="billing_details">
            <form action="/addOrder" method="post">
                @csrf
            <div class="row">
                
                <div class="col-lg-5">
                    <h3>Thông tin thanh toán</h3>
                    <div class="row contact_form" action="#" method="post" novalidate="novalidate">
                    <div class="col-md-12 form-group mb-3">
                    <label for="">Họ và tên</label>
                    <input type="text" name="username" class="form-control">
                    </div>
                    <div class="col-md-12 form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-12 form-group mb-3">
                    <label for="">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="col-md-12 form-group mb-3">
                    <label for="">Địa chỉ</label>
                    <input type="text" name="address" class="form-control">
                    </div>
                    
                        <!-- <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="last" name="name">
                            <span class="placeholder" data-placeholder="Last name"></span>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="company" name="company" placeholder="Company name">
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="number">
                            <span class="placeholder" data-placeholder="Phone number"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="compemailany">
                            <span class="placeholder" data-placeholder="Email Address"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select class="country_select">
                                <option value="1">Country</option>
                                <option value="2">Country</option>
                                <option value="4">Country</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add1" name="add1">
                            <span class="placeholder" data-placeholder="Address line 01"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add2" name="add2">
                            <span class="placeholder" data-placeholder="Address line 02"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city">
                            <span class="placeholder" data-placeholder="Town/City"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select class="country_select">
                                <option value="1">District</option>
                                <option value="2">District</option>
                                <option value="4">District</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Create an account?</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group mb-0">
                            <div class="creat_account">
                                <h3>Shipping Details</h3>
                                <input type="checkbox" id="f-option3" name="selector">
                                <label for="f-option3">Ship to a different address?</label>
                            </div>
                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        
                        <ul class="list">
                            <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
                            @if(session('cart'))
                            <?php $total = 0;?>
                            @foreach(session('cart') as $id => $detail)
                            <?php 
                                $tt = $detail['price'] * $detail['quantity'];
                                $total += $tt;
                            ?>
                            <li>
                                <a class="" href="#">{{$detail['name']}}<span class="middle">x {{$detail['quantity']}}</span> <span class="last"><?=number_format($tt)?>VNĐ</span></a></li>
                            @endforeach
                            @endif
                            
                            <!-- <li><a href="#">Fresh Tomatoes <span class="middle">x 02</span> <span class="last">$720.00</span></a></li>
                            <li><a href="#">Fresh Brocoli <span class="middle">x 02</span> <span class="last">$720.00</span></a></li> -->
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Subtotal <span><?=number_format($tt)?>VNĐ</span></a></li>
                            <li><a href="#">Shipping <span><?=number_format($tt)?>VNĐ</span></a></li>
                            <li><a href="#">Total <span><?=number_format($total)?>VNĐ</span></a></li>
                        </ul>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="selector">
                                <label for="f-option5">Check payments</label>
                                <div class="check"></div>
                            </div>
                            <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                Store Postcode.</p>
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                                <input type="radio" id="f-option6" name="selector">
                                <label for="f-option6">Paypal </label>
                                <img src="img/product/card.jpg" alt="">
                                <div class="check"></div>
                            </div>
                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                account.</p>
                        </div>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector">
                            <label for="f-option4">I’ve read and accept the </label>
                            <a href="#">terms & conditions*</a>
                        </div>
                        
                        <input type="hidden" name="total" class="form-control" value="{{ $total }}">
                        <div class="text-center">
                          <input type="submit" class="button button-paypal"  value="Thanh Toán">
                        </div>
                    </div>
                </div>
            
            </div>
            </form>
        </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->
@endsection