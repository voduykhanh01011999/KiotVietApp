<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Input;
use Str;
class CustomerController extends Controller
{
    public function getCustomer(){
        try{
            $access_token = fopen("../storage/app/public/access_token.txt","r");
            $access_token = fgets($access_token);
            
           
            $retailer = fopen("../storage/app/public/retailer.txt","r");
            $retailer = fgets($retailer);
    
            $response = Http::withHeaders(
                [
                    'Retailer'=>$retailer,
                    'Authorization'=>'Bearer '.$access_token,
                    'Accept'=>'application/json',
                ]
            )->get('https://public.kiotapi.com/customers');
            $Branches = Http::withHeaders(
                [
                    'Retailer'=>$retailer,
                    'Authorization'=>'Bearer '.$access_token,
                    'Accept'=>'application/json',
                ]
            )->get('https://public.kiotapi.com/branches');
           
            $checkstatus = $response->status();
            $checkstatusBranches = $Branches->status();
            if($checkstatus==200 &&  $checkstatusBranches==200)
            {
                
                $customer = $response->json()['data'];
              
                $ShowBranches = $Branches->json()['data'];
                
                
                return view('admin.customer.listcustomer',compact('customer','ShowBranches'));
            }else{
                return redirect()->back()->with('error','Không tìm thấy yêu cầu!!!');
            }
           
           
        }
        catch(Exception $e)
        {
            echo "Cửa hàng hết thời hạn sử dụng";
        }
       
       
        }
        public function getDetailsCustomer($id)
        {
            $retailer = fopen("../storage/app/public/retailer.txt","r");
            $retailer = fgets($retailer);
            
            $access_token = fopen("../storage/app/public/access_token.txt","r");
            $access_token = fgets($access_token);
            $response = Http::withHeaders([
                'Retailer' => $retailer,
                'Authorization'=>'Bearer '.$access_token,
            ])->get('https://public.kiotapi.com/customers/'.$id);
            $checkstatus = $response->status();
           

            if($checkstatus == 200)
            {
                $details = $response->json();
               
                return view('admin.customer.customerdetails',compact('details'));
            }else{
                return redirect()->back()->with('error','Không tìm thấy thông tin khách hàng!!!');
            }
            
        }
        public function postCreateCtm(Request $request)
        {
           
            $retailer = fopen("../storage/app/public/retailer.txt","r");
            $retailer = fgets($retailer);
            
            $access_token = fopen("../storage/app/public/access_token.txt","r");
            $access_token = fgets($access_token);
           
           
            $response = Http::withHeaders([
                'Retailer' => $retailer,
                'Authorization'=>'Bearer '.$access_token,
            ])->post('https://public.kiotapi.com/customers/', [
                'code'=>$request->code,
                'name'=>$request->name,
                'gender'=>$request->gender,
                'birthDate'=>$request->birthDate,
                'contactNumber'=>$request->contactNumber,
                'address'=>$request->address,
                'locationName'=>$request->locationName,
                'email'=>$request->email,
                'comments'=>$request->comments,
                'branchId'=>$request->branchId,
                
            ]);
            $data = $response->json();
        
            $checkstatus = $response->status();
            if($checkstatus!=200 && isset($data['responseStatus']))
            {   
                return redirect()->back()->with('error',$data['responseStatus']['message']);
                
            }else{
                return redirect()->back()->with('thongbao','Thêm thành công!!!');
            }
        }
        public function postUpdateCtm(Request $request,$id)
        {
            $retailer = fopen("../storage/app/public/retailer.txt","r");
            $retailer = fgets($retailer);
            
            $access_token = fopen("../storage/app/public/access_token.txt","r");
            $access_token = fgets($access_token);
        

           
            $response = Http::withHeaders([
                'Retailer' => $retailer,
                'Authorization'=>'Bearer '.$access_token,
            ])->put('https://public.kiotapi.com/customers/'.$id, [
                'code'=>$request->code,
                'name'=>$request->name,
                'gender'=>$request->gender,
                'birthDate'=>$request->birthDate,
                'contactNumber'=>$request->contactNumber,
                'address'=>$request->address,
                'locationName'=>$request->locationName,
                'email'=>$request->email,
                'comments'=>$request->comments,
                'branchId'=>$request->branchId,
            ]);
            $data = $response->json();
          
            $checkstatus = $response->status();
            if($checkstatus!=200 && isset($data['responseStatus']))
            {   
                return redirect()->back()->with('error',$data['responseStatus']['message']);
                
            }else{
                return redirect()->back()->with('thongbao','Cập nhật thành công!!!');
            }
        }
        public function getDeleteCtm($id){
            $retailer = fopen("../storage/app/public/retailer.txt","r");
            $retailer = fgets($retailer);
            
            $access_token = fopen("../storage/app/public/access_token.txt","r");
            $access_token = fgets($access_token);
            
            $response = Http::withHeaders([
                'Retailer' => $retailer,
                'Authorization'=>'Bearer '.$access_token,
            ])->delete('https://public.kiotapi.com/customers/'.$id);

            $checkstatus = $response->status();
            if($checkstatus==200){
                return redirect()->back()->with('thongbao','Xóa khách hàng thành công!!!');
            }else{
                return redirect()->back()->with('error','Xóa không thành công!!!');
            }
        }
        
}

