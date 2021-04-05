@extends('admin.layout.index')
@section('title')
    List Product
@endsection
@section('content')
<div class="card mb-4">
                            <div class="card-header bg-success" style="color:#fff;">
                                <i class="fas fa-table mr-1"></i>
                               THÔNG TIN KẾT NỐI ĐẾN CỬA HÀNG KIOT VIET
                            </div>
                            <div class="card-body">
                            <form action="{{url('/setting/connect')}}" method="post">
                            @csrf
                                    <div class="form-group">
                                        <label for="retailer">Tên cửa hàng</label>
                                        <input type="text" class="form-control" id="retailer" name="retailer" value="{{$retailer}}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="client_id">Client ID</label>
                                        <input type="text" class="form-control" id="client_id" name="client_id" value="{{$client_id}}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="client_secret">Client Secret (Mã bảo mật)</label>
                                        <input type="text" class="form-control" id="client_secret" name="client_secret" value="{{$client_secret}}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Token kết nối</label>
                                        <textarea class="form-control" id="access_token" name="access_token" rows="3">{{$access_token}}</textarea>
                                    </div>
                                    <button class="btn btn-success" type="submit"><i class="fas fa-network-wired"></i>
                                    Connect
                                    </button>
                            </form>
                            </div>
                        </div>


@endsection