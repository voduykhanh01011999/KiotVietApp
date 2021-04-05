@extends('admin.layout.index')
@section('title')
    List Customer
@endsection
@section('content')
<div class="card mb-4">
                            <div class="card-header bg-success" style="color:#fff;">
                                <i class="fas fa-table mr-1"></i>
                               DANH SÁCH KHÁCH HÀNG
                            </div>
                            <div class="card-body">
                                <div class="text-left mb-2">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AddCustomer">
                                        <i class="fas fa-plus-circle"></i> Thêm khách hàng
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr style="text-align:center;font-size:8pt;">
                                                <th>ID Khách Hàng</th>
                                                <th>Ảnh Đại Diện</th>
                                                <th>Tên Khách Hàng</th>
                                                <th>Ngày Sinh</th>
                                                <th>Địa Chỉ</th>
                                                <th>Số Điện Thoại</th>
                                                <th colspan="3">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $stt=0; @endphp
                                        @foreach($customer as $ctm) 
                                            @php $stt++; @endphp
                                            <tr style="text-align:center;font-size:10pt;">
                                            <td>{{$ctm['id']}}</td>
                                            <td>
                                            @if(isset($ctm['avatar']))
                                                    <img src="{{$ctm['avatar']}}" style="width:100px;" alt="">
                                                @else
                                                    <span class="badge badge-danger">{{('NULL')}}</span>
                                            @endif
                                            </td>
                                            <td>{{$ctm['name']}}</td>
                                            <td>
                                                @if(isset($ctm['birthDate']))
                                                    {{\Carbon\Carbon::parse($ctm['birthDate'])->format('d/m/Y')}}
                                                @endif
                                            </td>
                                            <td>{{$ctm['address']}}</td>
                                            <td>{{$ctm['contactNumber']}}</td>
                                            <td><a class="btn btn-success btn-sm" href="{{url('/customer/details/'.$ctm['id'])}}"><i class="fas fa-eye"></i>Chi tiết</a></td>
                                            <td><a class="btn btn-success btn-sm" data-toggle="modal" data-target="#EditCustomer{{$stt}}"><i class="fas fa-edit"></i> Sửa</a></td>
                                            <td><a class="btn btn-success btn-sm" onclick="return Xoa()" href="{{url('/customer/delete/'.$ctm['id'])}}"><i class="fas fa-trash-alt"></i> Xóa</a></td>
                                            @include('admin.customer.modaledit')
                                            </tr>
                                        @endforeach
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

@include('admin.customer.modaladd')
@endsection

@section('script')
    <script>
         $(document).ready(function(){

    $('.chonTQAdd').on('change',function(){
        var action = $(this).attr('id');
        var matp = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';

        if(action=='TinhThanhPho')
        {
        result = 'QuanHuyenAdd';
        }
        $.ajax({
            url: ('customer/postTQ'),
            method: 'POST',
            data: {action:action,matp:matp,_token:_token},
            success:function(data){
                
                $('#'+result).html(data);
            }
        });
});

});
</script>
@endsection