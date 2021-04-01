<div class="modal fade" id="AddOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="{{url('/order/create')}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="modal-header bg-success" style="color:#fff;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar-plus"></i> Thêm hóa đơn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <select class="form-control" name="BranchId" id="exampleFormControlSelect2">
                                <option value="">--Chọn chi nhánh--</option>
                            @foreach($branches as $bc)
                                <option value="{{$bc['id']}}">{{$bc['branchName']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control chon CustomerId" name="CustomerId" id="CustomerId">
                                <option value="0">--Chọn khách hàng--</option>
                            @foreach($customer as $ctm)
                                <option value="{{$ctm['id']}}">{{$ctm['name']}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address">Họ tên người nhận</label>
                        <input type="text" class="form-control" id="Receiver" name="Receiver" placeholder="Nhập họ tên người nhận">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contactNumber">Số điện thoại</label>
                        <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" placeholder="Nhập số điện thoại">
                </div>
            </div>
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="birthDate">Địa chỉ nhận</label>
                        <input type="text" class="form-control" id="Address" name="Address" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="LocationName">Tỉnh, Huyện</label>
                        <input type="text" class="form-control" id="LocationName" name="LocationName" placeholder="Nhập tỉnh huyện">
                </div>
            </div>
            <div class="form-group">
                <label for="">Phường Xã</label>
                <input type="text" class="form-control" id="WardName" name="WardName" placeholder="Nhập Xã">
            </div>
            <div class="form-group">
                <label for="DeliveryCode">Mã vận đơn</label>
                <input type="text" class="form-control" id="DeliveryCode" name="DeliveryCode" placeholder="Nhập mã vận đơn">
            </div>
            <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect2">Mã đối tác</label>
                    <input type="text" class="form-control" name="Code" id="Code" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Name">Tên đối tác</label>
                        <input type="text" class="form-control Name" id="Name" name="Name" value="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect2">Ngày giao hàng</label>
                    <input type="date" class="form-control" name="date">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect2">Phí giao hàng</label>
                    <input type="number" class="form-control" name="Price" id="Price">
                </div>
            </div>
                <div class="form-group">
                    <label for="">Trạng thái giao hàng</label>
                    <div class="form-check">
                        <input class="form-check-input" name="Status" type="radio" id="gridCheck" value="3">
                        <label class="form-check-label" for="gridCheck">
                            Chưa giao
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="Status" type="radio" id="gridCheck" value="4">
                        <label class="form-check-label" for="gridCheck">
                            Đã giao
                        </label>
                    </div>
             </div>
             <div class="form-row">
                <div class="form-group col-md-6">
                <label for="exampleFormControlSelect2">Sản phẩm</label>
                    <select class="form-control chonsanpham ProductId" name="ProductId" id="ProductId">
                            <option value="0">--Chọn sản phẩm--</option>
                        @foreach($product as $pd)
                            <option value="{{$pd['id']}}">{{$pd['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect2">Giá đơn hàng</label>
                    <input type="number"  class="form-control" name="PriceOrder" id="PriceOrder">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect2">Số lượng</label>
                    <input type="number"  class="form-control" name="Quantity" id="Quantity">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect2">Ghi chú</label>
                    <input type="text" class="form-control" name="Note">
                </div>
            </div>
            <div class="form-group">
                <label for="">Rank</label>
                <input type="number" class="form-group" name="Rank">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
            <button  type="submit" class="btn btn-success"><i class="far fa-save"></i> Lưu</button>
        </div>
      </form>
    </div>
  </div>
</div>

