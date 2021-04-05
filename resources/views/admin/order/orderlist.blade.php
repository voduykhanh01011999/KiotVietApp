@extends('admin.layout.index')
@section('title')
    Order List
@endsection
@section('content')
<div class="card mb-4">
                            <div class="card-header bg-success" style="color:#FFF;">
                                <i class="fas fa-table mr-1"></i>
                               DANH SÁCH HÓA ĐƠN 
                            </div>
                            <div class="card-body">
                                    <div class="text-left mb-2">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AddOrder">
                                            <i class="fas fa-plus-circle"></i> Thêm hóa đơn
                                        </button>
                                    </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr style="text-align:center;font-size:7pt;">
                                                <th>ID/Code</th>
                                                <th>Tên chi nhánh</th>
                                                <th>Tên khách hàng</th>
                                                <th>Sản phẩm mua / Số lượng</th>
                                                <th>Tổng tiền thanh toán</th>
                                                <th>Tiền đã trả</th>
                                                <th>Thời gian đặt hàng</th>
                                                <th colspan="2">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order as $od)
                                            @if($od['status']!=4) 
                                            <tr style="text-align:center;font-size:7pt;">
                                                <td>{{$od['id']}} / {{$od['code']}}</td>
                                                <td>{{$od['branchName']}}</td>
                                                <td>
                                                    @if(isset($od['customerName']))
                                                            {{$od['customerName']}}
                                                        @else
                                                            {{('NULL')}}
                                                    @endif                                                
                                                </td>
                                                <td>
                                                    @if(isset($od['orderDetails']))
                                                        @foreach($od['orderDetails'] as $dt)
                                                            {{$dt['productName']}} / {{$dt['quantity']}}
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>{{number_format($od['total'])}} VNĐ</td>
                                                <td>{{number_format($od['totalPayment'])}} VNĐ</td>
                                                <td>{{ \Carbon\Carbon::parse($od['createdDate'])->format('d/m/Y  H:i:s')}}</td>
                                                <td><a class="btn btn-success btn-sm" href="{{url('/order/details/'.$od['id'])}}"><i class="fas fa-eye"></i> Chi tiết</a></td>
                                                <td><a class="btn btn-success btn-sm" href="{{url('/order/delete/'.$od['id'])}}"><i class="fas fa-eye"></i> Xóa</a></td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

@include('admin.order.modaladd')
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $('.chon').on('change',function(){
            var action = $(this).attr('id');
            
             var id = $(this).val();
             
             
             var _token = $('input[name="_token"]').val();
            if(id != 0)
            {
                $.ajax({
                    url:('order/selectCustomer'),
                    method:'post',
                    data: {action:action,id:id,_token:_token},
                    success:function(data){
                        $('#Code').val(data.code);
                        $('#Name').val(data.name);
                        
                    }
                });
            }else{
                $('#Code').val(''); 
                $('#Name').val('');
            }
            
            });

        })
	</script>
@endsection