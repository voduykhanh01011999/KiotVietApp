@extends('admin.layout.index')
@section('title')
    Chi tiết khách hàng
@endsection
@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger" id="alert">
            @foreach($errors->All() as $err)
                {{$err}} <br>
            @endforeach
        </div>
    @endif
<div class="card mb-4">
                            <div class="card-header bg-success" style="color:#fff;">
                                <i class="fas fa-table mr-1"></i>
                               DANH SÁCH CHI TIẾT
                            </div>
                            <div class="card-body">
                                <div class="card" style="width: 65rem;">
                                    <div class="card-header bg-success" style="color:#fff;">
                                        CHI TIẾT KHÁCH HÀNG : <span class="badge badge-success">{{$details['name']}}</span>
                                    </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Id khách hàng: <span class="badge badge-success">{{$details['id']}}</span> </li>
                                            <li class="list-group-item">Mã khách hàng: <span class="badge badge-success">{{$details['code']}}</span></li>
                                            <li class="list-group-item">Ngày sinh: <span class="badge badge-success">@if(isset($details['birthDate'])){{$details['birthDate']}}@endif</span></li>
                                            <li class="list-group-item">Giới tính: <span class="badge badge-success">
                                            @if(isset($details['gender']))
                                                @if($details['gender']==true)
                                                        {{('Nam')}}
                                                    @else
                                                        {{('Nữ')}}
                                                @endif
                                            @else
                                                {{('NULL')}}
                                            @endif
                                            </span></li>
                                            <li class="list-group-item">Số điện thoại: <span class="badge badge-success">
                                            @if(isset($details['contactNumber']))
                                                    {{$details['contactNumber']}} 
                                                @else 
                                                    {{('NULL')}} 
                                            @endif
                                            </span></li>
                                            <li class="list-group-item">Địa chỉ: <span class="badge badge-success">@if(isset($details['address'])){{$details['address']}} @else {{('NULL')}} @endif</span></li>
                                            <li class="list-group-item">Id Chi nhánh: <span class="badge badge-success">@if(isset($details['branchId'])){{$details['branchId']}} @else {{('NULL')}} @endif</span></li>
                                            <li class="list-group-item">Phường xã: <span class="badge badge-success">@if(isset($details['wardName'])){{$details['wardName']}} @else {{('NULL')}} @endif</span></li>
                                            <li class="list-group-item">Khu vực: <span class="badge badge-success">@if(isset($details['locationName'])){{$details['locationName']}} @else {{('NULL')}} @endif</span></li>
                                            <li class="list-group-item">Email: <span class="badge badge-success">@if(isset($details['email'])){{$details['email']}} @else {{('NULL')}} @endif</span></li>
                                            <li class="list-group-item">Ảnh đại diện: 
                                                @if(isset($details['avatar']))
                                                        <img src="{{$details['avatar']}}" style="width:80px;" alt="">
                                                    @else
                                                        <span class="badge badge-success">{{('NULL')}}</span>
                                                @endif
                                            </li>
                                            <li class="list-group-item">Ghi chú: <span class="badge badge-success">
                                            @if(isset($details['comments']))
                                                {{$details['comments']}}
                                            @else
                                                {{('NULL')}}
                                            @endif
                                            </span></li>
                                            <li class="list-group-item">Nợ hiện tại: <span class="badge badge-success">@if(isset($details['debt'])){{number_format($details['debt'])}}VNĐ @else {{('NULL')}} @endif </span></li>
                                            <li class="list-group-item">Tổng số tiền bán: <span class="badge badge-success">@if(isset($details['totalInvoiced'])){{number_format($details['totalInvoiced'])}}VNĐ @else {{('NULL')}}@endif </span></li>
                                            <li class="list-group-item">Tổng bán trừ trả hàng: <span class="badge badge-success">@if(isset($details['totalRevenue'])){{number_format($details['totalRevenue'])}}VNĐ @else {{('NULL')}}@endif </span></li>
                                            <li class="list-group-item">Điểm tích lũy: <span class="badge badge-success">@if(isset($details['totalPoint'])){{number_format($details['totalPoint'])}}VNĐ @else {{('NULL')}}@endif </span></li>
                                            <li class="list-group-item">Điểm thưởng: <span class="badge badge-success">@if(isset($details['totalPoint'])){{number_format($details['totalPoint'])}}VNĐ @else {{('NULL')}}@endif </span></li>
                                        </ul>
                                 </div>                       
                            </div>
                        </div>
@endsection

