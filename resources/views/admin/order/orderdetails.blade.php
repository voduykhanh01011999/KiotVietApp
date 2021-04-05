@extends('admin.layout.index')
@section('title')
    Order Details
@endsection
@section('content')
                <div class="card mb-4">
                            <div class="card-header bg-success" style="color:#fff;">
                                <i class="fas fa-table mr-1"></i>
                               DANH SÁCH CHI TIẾT
                            </div>
                            <div class="card-body">
                                    <div class="text-left mb-2">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#EditOrder">
                                            <i class="fas fa-edit"></i> Sửa hóa đơn
                                        </button>
                                    </div>
                                <div class="card" style="width: 65rem;">
                                    <div class="card-header bg-success" style="color:#fff;">
                                        CHI TIẾT HOA ĐƠN : <span class="badge badge-success">{{$details['id']}}</span>
                                    </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Id / Mã hóa đơn: <span class="badge badge-success">{{$details['id']}} / {{$details['code']}}</span> </li>
                                            <li class="list-group-item">Id / Mã khách hàng: <span class="badge badge-success">{{$details['customerId']}} / {{$details['customerCode']}}</span> </li>
                                            <li class="list-group-item">Tên khách hàng: <span class="badge badge-success">{{$details['customerName']}}</span></li>
                                            <li class="list-group-item">Chi tiết nhận hàng:
                                            @if(isset($details['orderDelivery']))
                                            <li class="list-group-item">Mã giao hàng: <span class="badge badge-success">@if(isset($details['orderDelivery']['deliveryCode'])){{$details['orderDelivery']['deliveryCode']}}@endif</span></li>
                                            <li class="list-group-item">Giá giao hàng: <span class="badge badge-success">@if(isset($details['orderDelivery']['price'])){{number_format($details['orderDelivery']['price'])}}VNĐ@endif</span></li>
                                            <li class="list-group-item">Tên người nhận: <span class="badge badge-success">@if(isset($details['orderDelivery']['receiver'])){{$details['orderDelivery']['receiver']}}@endif</span></li>
                                            <li class="list-group-item">Số điện thoại: <span class="badge badge-success">@if(isset($details['orderDelivery']['contactNumber'])){{$details['orderDelivery']['contactNumber']}}@endif</span></li>
                                            <li class="list-group-item">Khu vực giao hàng: <span class="badge badge-success">@if(isset($details['orderDelivery']['locationName'])){{$details['orderDelivery']['locationName']}}@endif</span></li>
                                            <li class="list-group-item">Ngày giao hàng: <span class="badge badge-success">@if(isset($details['orderDelivery']['expectedDelivery'])){{\Carbon\Carbon::parse($details['orderDelivery']['expectedDelivery'])->format('d/m/Y  H:i:s')}}@endif</span></li>
                                                @if(isset($details['orderDelivery']['partnerDelivery']))
                                                    <li class="list-group-item">Mã đối tác: <span class="badge badge-success">{{$details['orderDelivery']['partnerDelivery']['code']}}</span></li>
                                                    <li class="list-group-item">Tên đối tác: <span class="badge badge-success">{{$details['orderDelivery']['partnerDelivery']['name']}}</span></li>
                                                @endif
                                            @endif
                                             </li>
                                            <li class="list-group-item">Tổng tiền đơn hàng: <span class="badge badge-success">@if(isset($details['total'])){{number_format($details['total'])}}@endif</span></li>
                                            <li class="list-group-item">Tổng đã trả: <span class="badge badge-success">@if(isset($details['totalPayment'])){{number_format($details['totalPayment'])}}@endif</span></li>
                                            <li class="list-group-item">Ngày đặt hàng: <span class="badge badge-success">@if(isset($details['purchaseDate'])){{ \Carbon\Carbon::parse($details['purchaseDate'])->format('d/m/Y  H:i:s')}}@endif</span></li>
                                            <li class="list-group-item">Trạng thái đơn hàng: 
                                                @if($details['status']==1)
                                                        <span class="badge badge-success">{{('Hoạt động')}}</span>
                                                    @else
                                                        <span class="badge badge-success">{{('Đã hủy')}}</span>
                                                @endif   
                                            </li>
                                            <li class="list-group-item">Trạng thái phiếu:
                                            @if(isset($details['statusValue']))
                                                    <span class="badge badge-success">{{$details['statusValue']}}</span>
                                            @endif
                                            </li>
                                            <li class="list-group-item">Id cửa hàng:
                                            @if(isset($details['retailerId']))
                                                    <span class="badge badge-success">{{$details['retailerId']}}</span>
                                            @endif          
                                            </li>
                                            <li class="list-group-item">Id kênh bán:
                                                @if(isset($details['SaleChannelId']))
                                                        <span class="badge badge-success">{{$details['SaleChannelId']}}</span>
                                                @endif
                                              </li>
                                            <li class="list-group-item">Tên kênh bán: <span class="badge badge-success">@if(isset($details['SaleChannelName'])){{$details['SaleChannelName']}} @endif</span></li>
                                            <li class="list-group-item">Chi tiết kênh:
                                                @if(isset($details['SaleChannel']))
                                                    <li class="list-group-item">Trạng thái hoạt động<span class="badge badge-success">
                                                    @if(isset($details['SaleChannel']['IsActive']))
                                                        @if($details['SaleChannel']['IsActive']==true)
                                                                {{('Hoạt động')}}
                                                            @else
                                                                {{('Không hoạt động')}}
                                                        @endif
                                                    @endif
                                                    </span>
                                                    </li>
                                                @endif
                                                <li class="list-group-item">Logo kênh bán: <i class="@if(isset($details['SaleChannel']['Img'])){{$details['SaleChannel']['Img']}}@endif" style="color:green;"></i></li>
                                                <li class="list-group-item">Ngày tạo: <span class="badge badge-success">@if(isset($details['SaleChannel']['CreatedDate'])){{ \Carbon\Carbon::parse($details['SaleChannel']['CreatedDate'])->format('d/m/Y  H:i:s')}}@endif</span> </li>
                                            </li>
                                            
                                        </ul>
                                 </div>                       
                            </div>
                        </div>
@include('admin.order.modaledit')
@endsection