<?php

namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\order;
use App\Models\cart;
use App\Models\create_payment;
class OrderController extends Controller
{
    //
    protected $dataPayment;
    public function Cart(){
        session('cart');
        return view('client.layouts.cart');
    }

    public function AddToCart(Request $request, $id){
        $product = products::find($id);
        $qty = $request->qty;
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            if(isset($qty)){
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + $qty;

            }else{
                $cart[$id]['quantity']++;
            }
            
        }else{
            if(isset($qty)){
                $cart[$id]=[
                    "id_prod"=>$product->id_prod,
                    "name"=>$product->name_prod,
                    "price"=>$product->price,
                    "quantity"=>$qty,
                    "img"=>$product->img,
                ];  
            }else{
                $cart[$id]=[
                    "id_prod"=>$product->id_prod,
                    "name"=>$product->name_prod,
                    "price"=>$product->price,
                    "quantity"=>1,
                    "img"=>$product->img,
                ]; 
            }
             
        }
        session()->put('cart', $cart);
        return redirect('/gio-hang')->with('message','Thêm giỏ hàng thành công');
    }
    public function update_cart(Request $request){
        $id = $request->id;
        $qty = $request->qty;
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity']=$qty;
            session()->put('cart',$cart);
            $mess = [
                "status"=>200,
                "mess"=>"Cập nhật thành công",
            ];
        }
    
        return response()->json($mess);


    }

    public function deletcart(Request $request){
        session()->flush();
        return redirect("/") ;
        // if(session('cart')){
            
        // }
        
        
    }
    public function checkout(){
        session('cart');
        return view('client.layouts.checkout');
    }
    public function paypost(Request $request){
        $data = $request->except('_token','payment');
        if($request->payment == 2){
            session(['OrderId'=>$data]);
            return view('client.layouts.vnp_payment');
        }else{
            $orderID = order::insertGetId([
                'username'=> $request->username,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'address'=> $request->address,
                'total'=> $request->total,
    
            ]);
            $this->CartAdd($orderID);
            return redirect('/');
        }
        


        
        return redirect('/');
        // print_r(session('cart')['name']);
        
        
       
                    

    }

    public function CartAdd($id){
        $order = order::find($id);
        $cart = session()->get('cart');
        // print_r($cart['name']);
        foreach($cart as $id=> $val){
            $dataCart = cart::Insert([
                'prodID'=>$val['id_prod'],
                'orderID'=>$order->id,
                'prod_name'=>$val['name'],
                'price'=>$val['price'],
                'quantity'=>$val['quantity'],
                'img'=>$val['img'],
            ]);
            
            session()->flush();
            
        }
    }
    public function create_payment(Request $request){
        $data= $request->all();
        // dd($request->amount);
        $vnp_TmnCode = "MGKGUYQ2";
        $vnp_TxnRef = rand(1,10000); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount =str_replace('','',$data['amount']) * 100; // Số tiền thanh toán
        $vnp_Locale = $data['language']; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = $data['bankCode']; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => route('vnpay_return'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASH_SECRET')) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, env('VNP_HASH_SECRET'));//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }

    public function vnp_ReturnUrl(Request $request){
        // $vnpayData = $request->all();
        // dd($vnpayData);
        if(session()->has('OrderId')){
            try{
                $vnpayData = $request->all();
                $data = session()->get('OrderId');
                $dataOrderId = order::insertGetId([
                    'username'=> $data['username'],
                    'email'=> $data['email'],
                    'phone'=> $data['phone'],
                    'address'=>$data['address'],
                    'total'=> $data['total'],
        
                ]);
                if($dataOrderId){
                    $this->CartAdd($dataOrderId );
                    $create_vnpayment= create_payment::insert([
                        'p_tranaction_id' => $dataOrderId,
                        'p_money'=>$data['total'],
                        'p_note'=>$vnpayData['vnp_OrderInfo'],
                        'p_vnp_response_code'=>$vnpayData['vnp_ResponseCode'],
                        'p_code_vnpay'=>$vnpayData['vnp_TransactionNo'],
                        'p_code_bank'=>$vnpayData['vnp_BankCode'],
                        'p_time'=>date('Y-m-d H:i',strtotime($vnpayData['vnp_PayDate']))
                    ]);

                }
                return redirect('/');
            }catch(Exception $exception){
                return redirect('/');
            }
        }

    }

        
}
// array:11 [▼ // app\Http\Controllers\client\OrderController.php:115
//   "vnp_Amount" => "5960000000"
//   "vnp_BankCode" => "VNPAY"
//   "vnp_CardType" => "QRCODE"
//   "vnp_OrderInfo" => "9701"
//   "vnp_PayDate" => "20231029001412"
//   "vnp_ResponseCode" => "24"
//   "vnp_TmnCode" => "MGKGUYQ2"
//   "vnp_TransactionNo" => "0"
//   "vnp_TransactionStatus" => "02"
//   "vnp_TxnRef" => "9701"
//   "vnp_SecureHash" => "eb62f1bbdf02785e7d2c47312645c9d507a608faf39fbdd9057871941a379848de6e009642772d207407d75f2213b31bae9d76ec22496b035600d35c2e3f84ec"
// ]