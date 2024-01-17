<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tạo mới đơn hàng</title>
        <!-- Bootstrap core CSS -->
        <link href="{{asset('payment/jumbotron-narrow.css')}}" rel="stylesheet"/>
        <link href="{{asset('payment/bootstrap.min.css')}}" rel="stylesheet"/>
        <!-- <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/> -->
        <!-- Custom styles for this template -->
        <!-- <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">  
        <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script> -->
    </head>

    <body>
    <?php //require_once("./config.php"); ?>         
        <div class="container">
        <h3>Tạo mới đơn hàng</h3>
            <div class="table-responsive">
                <form action="{{url('/create_payment')}}" id="frmCreateOrder" method="post"> 
                    @csrf 
                    <div class="form-group">
                        <label for="amount">Số tiền</label>
                        <?php $total =0 ;?>
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
						<?php 
						$tt= $details['quantity'] * $details['price'] ;
						$total += $tt;
                        ?>
                        @endforeach
                        @endif
                        <input class="form-control" id="amount"  min="1" name="amount"  value="{{$total}}" readonly/>
                    </div>
                     <h4>Chọn phương thức thanh toán</h4>
                    <div class="form-group">
                        <h5>Cách 1: Chuyển hướng sang Cổng VNPAY chọn phương thức thanh toán</h5>
                       <input type="radio" Checked="True" id="bankCode" name="bankCode" value="">
                       <label for="bankCode">Cổng thanh toán VNPAYQR</label><br>
                       
                       <h5>Cách 2: Tách phương thức tại site của đơn vị kết nối</h5>
                       <input type="radio" id="bankCode" name="bankCode" value="VNPAYQR">
                       <label for="bankCode">Thanh toán bằng ứng dụng hỗ trợ VNPAYQR</label><br>
                       
                       <input type="radio" id="bankCode" name="bankCode" value="VNBANK">
                       <label for="bankCode">Thanh toán qua thẻ ATM/Tài khoản nội địa</label><br>
                       
                       <input type="radio" id="bankCode" name="bankCode" value="INTCARD">
                       <label for="bankCode">Thanh toán qua thẻ quốc tế</label><br>
                       
                    </div>
                    <div class="form-group">
                        <h5>Chọn ngôn ngữ giao diện thanh toán:</h5>
                         <input type="radio" id="language" Checked="True" name="language" value="vn">
                         <label for="language">Tiếng việt</label><br>
                         <input type="radio" id="language" name="language" value="en">
                         <label for="language">Tiếng anh</label><br>
                         
                    </div>
                    <button type="submit"  class="btn btn-default" >Thanh toán</button>
                </form>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY 2020</p>
            </footer>
        </div>  
        
        <script src="{{asset('payment/jquery-1.11.3.min.js')}}"></script>
    </body>
</html>

