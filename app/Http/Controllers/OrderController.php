<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Str;

class OrderController extends Controller
{
    public function getOrder()
    {
        $access_token = fopen("../storage/app/public/access_token.txt","r");
        $access_token = fgets($access_token);

        $retailer = fopen("../storage/app/public/retailer.txt","r");
        $retailer  = fgets($retailer);
       
        //Hóa đơn
        $orderResponse = Http::withHeaders(
            [
                'Retailer'=>$retailer,
                'Authorization'=>'Bearer '.$access_token,
                'Accept'=>'aplication/json',
            ]
        )->get('https://public.kiotapi.com/orders/');
        //Chi nhánh
        $BranchesResponse = Http::withHeaders(
            [
                'Retailer'=>$retailer,
                'Authorization'=>'Bearer '.$access_token,
                'Accept'=>'aplication/json',
            ]
        )->get('https://public.kiotapi.com/branches');
        //Khách hàng
        $CustomerResponse = Http::withHeaders(
            [
                'Retailer'=>$retailer,
                'Authorization'=>'Bearer '.$access_token,
                'Accept'=>'aplication/json',
            ]
        )->get('https://public.kiotapi.com/customers');
        //Sản phẩm
        $ProductResponse = Http::withHeaders(
            [
                'Retailer'=>$retailer,
                'Authorization'=>'Bearer '.$access_token,
                'Accept'=>'aplication/json',
            ]
        )->get('https://public.kiotapi.com/products');
        
       
        if($orderResponse->status() == 200 && $BranchesResponse->status() == 200 && $CustomerResponse->status()==200 && $ProductResponse->status()==200)
        {
            $order = $orderResponse->json()['data'];
            $customer = $CustomerResponse->json()['data'];
            $branches = $BranchesResponse->json()['data'];
            $product = $ProductResponse->json()['data'];
            return view('admin.order.orderlist',compact('order','customer','branches','product'));
        }else{
            return rierdirect()->back()->with('error','Không tìm thấy dữ liệu');
        }
       
    }

    public function getDetails($id)
    {
        $access_token = fopen("../storage/app/public/access_token.txt","r");
        $access_token = fgets($access_token);

        $retailer = fopen("../storage/app/public/retailer.txt","r");
        $retailer  = fgets($retailer);
        //Chi nhánh
        $BranchesResponse = Http::withHeaders(
            [
                'Retailer'=>$retailer,
                'Authorization'=>'Bearer '.$access_token,
                'Accept'=>'aplication/json',
            ]
        )->get('https://public.kiotapi.com/branches');
        //Khách hàng
        $CustomerResponse = Http::withHeaders(
            [
                'Retailer'=>$retailer,
                'Authorization'=>'Bearer '.$access_token,
                'Accept'=>'aplication/json',
            ]
        )->get('https://public.kiotapi.com/customers');
        $ProductResponse = Http::withHeaders(
            [
                'Retailer'=>$retailer,
                'Authorization'=>'Bearer '.$access_token,
                'Accept'=>'aplication/json',
            ]
        )->get('https://public.kiotapi.com/products');

        $orderResponse = Http::withHeaders(
            [
                'Retailer'=>$retailer,
                'Authorization'=>'Bearer '.$access_token,
                'Accept'=>'aplication/json',
            ]
        )->get('https://public.kiotapi.com/orders/'.$id);
        $checkstatus = $orderResponse->status();
        if($checkstatus == 200)
        {
            $details = $orderResponse->json();
           
            $customer = $CustomerResponse->json()['data'];
            $branches = $BranchesResponse->json()['data'];
            $product = $ProductResponse->json()['data'];
           
            return view('admin.order.orderdetails',compact('details','branches','customer','product'));
        }
    }    

    public function postCreateOd(Request $request)
    {
        $access_token = fopen("../storage/app/public/access_token.txt","r");
        $access_token = fgets($access_token);

        $retailer = fopen("../storage/app/public/retailer.txt","r");
        $retailer  = fgets($retailer);
        //Tìm kiếm giá SP 
        
        foreach($request->ProductId as $pq)
        {
            $SelectPrice[] = Http::withHeaders(
                [
                    'Retailer'=>$retailer,
                    'Authorization'=>'Bearer '.$access_token,
                    'Accept'=>'aplication/json',
                ]
            )->get('https://public.kiotapi.com/products/'.$pq)->json();
        }
       
            // $test =  $SelectPrice[$i]['basePrice'];
        
        
        
        $infoproduct = array();
        //"Price"=>$request->PriceOrder
        foreach($request->ProductId as $pd){
            foreach($SelectPrice as $price){
                if($price['id'] == $pd ){

                
                $infoproduct[] = array(
                    "ProductId"=>$pd,
                    "Quantity"=>$request->Quantity,
                    "Price"=>$price['basePrice'],
                    "Note"=>$request->Note,
                    "Rank"=>0,
                    
                    );
            }
        }
    }
       
       
        
        $response = Http::withHeaders([
            'Retailer' => $retailer,
            'Authorization'=>'Bearer '.$access_token,
        ])->post('https://public.kiotapi.com/orders/',
         [
            'BranchId'=>$request->BranchId,
            'CustomerId'=>$request->CustomerId,
            'orderDelivery'=>[
                "Receiver"=>$request->Receiver,
                "ContactNumber"=>$request->ContactNumber,
                "Address"=>$request->Address,
                "LocationName"=>$request->LocationName,
                "WardName"=>$request->WardName,
                "DeliveryCode"=>$request->DeliveryCode,
                "PartnerDelivery"=>[
                    "Code"=>$request->Code,
                    "Name"=>$request->Name,
                ],
                "ExpectedDelivery"=>$request->ExpectedDelivery,
                "Price"=>$request->Price,
                "Status"=>$request->Status
            ],
            "OrderDetails"=> $infoproduct,
            
            
        ]);   
        
        $checkstatus = $response->status();
        $checkerror = $response->json();
        
        if($checkstatus!=200 && isset($checkerror['responseStatus']))
        {
            return redirect()->back()->with('error',$checkerror['responseStatus']['message']);
            
        }else{
            return redirect()->back()->with('thongbao','Thêm thành công!!!');
        }
    }
    public function postSelect(Request $request)
    {
        $data = $request->all();
        $access_token = fopen("../storage/app/public/access_token.txt","r");
        $access_token = fgets($access_token);

        $retailer = fopen("../storage/app/public/retailer.txt","r");
        $retailer  = fgets($retailer);
       
        if($data['action'])
        {
            $output = '';
            if($data['action']=="CustomerId"){
                $customer = Http::withHeaders(
                    [
                        'Retailer'=>$retailer,
                        'Authorization'=>'Bearer '.$access_token,
                        'Accept'=>'aplication/json',
                    ]
                )->get('https://public.kiotapi.com/customers/'.$data['id'])->json();
                $output1=$customer['code']; 
               $output2 = $customer['name'];
            
                
            }
            return response()->json(['code'=>$output1,'name'=>$output2]);
            //echo $output,$name;  
        }
    }
    public function postUpdateOd(Request $request,$id)
    {
        $access_token = fopen("../storage/app/public/access_token.txt","r");
        $access_token = fgets($access_token);

        $retailer = fopen("../storage/app/public/retailer.txt","r");
        $retailer  = fgets($retailer);
        $infoproduct = array();
        //Tìm giá sản phẩm theo ID
        foreach($request->ProductId as $pq)
        {
            $SelectPrice[] = Http::withHeaders(
                [
                    'Retailer'=>$retailer,
                    'Authorization'=>'Bearer '.$access_token,
                    'Accept'=>'aplication/json',
                ]
            )->get('https://public.kiotapi.com/products/'.$pq)->json();
        }

        foreach($request->ProductId as $key => $pd){
            foreach($SelectPrice as $price){
                if($price['id'] == $pd ){
                    
                       
                $infoproduct[] = array(
                    "ProductId"=>$pd,
                    "Quantity"=>$request->Quantity[$key],
                    "Price"=>$price['basePrice']*$request->Quantity[$key],
                    "Note"=>$request->Note,
                    "Rank"=>0, 
                    );
                }
            
        }
    }
        $response = Http::withHeaders([
            'Retailer' => $retailer,
            'Authorization'=>'Bearer '.$access_token,
        ])->put('https://public.kiotapi.com/orders/'.$id,
         [
            'BranchId'=>$request->BranchId,
            'CustomerId'=>$request->CustomerId,
            'status'=>$request->StatusP,
            'orderDelivery'=>[
                "Receiver"=>$request->Receiver,
                "ContactNumber"=>$request->ContactNumber,
                "Address"=>$request->Address,
                "LocationName"=>$request->LocationName,
                "WardName"=>$request->WardName,
                "DeliveryCode"=>$request->DeliveryCode,
                "PartnerDelivery"=>[
                    "Code"=>$request->Code,
                    "Name"=>$request->Name,
                ],
                "ExpectedDelivery"=>$request->ExpectedDelivery,
                "Price"=>$request->Price,
                "Status"=>$request->Status
            ],
                "OrderDetails"=>$infoproduct,
        ]);   
        
        $checkstatus = $response->status();
        $checkerror = $response->json();
            dd($checkerror);
        if($checkstatus!=200 && isset($checkerror['responseStatus']))
        {
            return redirect()->back()->with('error',$checkerror['responseStatus']['message']);
            
        }else{
            return redirect()->back()->with('thongbao','Cập nhật thành công!!!');
        }
    }
    public function getDeleteOd($id)
    {
        $access_token = fopen("../storage/app/public/access_token.txt","r");
        $access_token = fgets($access_token);

        $retailer = fopen("../storage/app/public/retailer.txt","r");
        $retailer  = fgets($retailer);
        $orderResponse = Http::withHeaders(
            [
                'Retailer'=>$retailer,
                'Authorization'=>'Bearer '.$access_token,
                'Accept'=>'aplication/json',
            ]
        )->delete('https://public.kiotapi.com/orders/'.$id);
        $checkstatus = $orderResponse->status();
        if($checkstatus != 200)
        {
            return redirect()->back()->with('error',"Xóa thất bại");
        }else{
            return redirect()->back()->with('thongbao','Xóa thành công!!!');
        }

    }
    
  
}
