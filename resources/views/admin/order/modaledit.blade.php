<div class="modal fade" id="EditOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="{{url('/order/update/'.$details['id'])}}" method="post">
    @csrf
   
      <div class="modal-header bg-success" style="color:#fff;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar-plus"></i> Sửa hóa đơn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <select class="form-control" name="BranchId" id="exampleFormControlSelect2">
                                
                            @foreach($branches as $bc)
                                <option @if($details['branchId'] == $bc['id']) selected @endif value="{{$bc['id']}}">{{$bc['branchName']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control chon CustomerId" name="CustomerId" id="CustomerId">
                                
                            @foreach($customer as $ctm)
                                <option @if($details['customerId'] == $ctm['id']) selected @endif value="{{$ctm['id']}}">{{$ctm['name']}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address">Họ tên người nhận</label>
                        <input type="text" class="form-control" id="Receiver" name="Receiver" value="@if(isset($details['orderDelivery']['receiver'])) {{$details['orderDelivery']['receiver']}} @endif">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contactNumber">Số điện thoại</label>
                        <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" value="@if(isset($details['orderDelivery']['contactNumber'])) {{$details['orderDelivery']['contactNumber']}} @endif">
                </div>
            </div>
            <div class="form-group">
                <label for="Address">Địa chỉ nhận</label>
                <input type="text" class="form-control" id="Address" name="Address" value="@if(isset($details['orderDelivery']['address'])) {{$details['orderDelivery']['address']}} @endif">      
            </div>
            
            <div class="form-group">
                <label for="locationName">Khu Vực</label>
                <input type="text" class="form-control" name="LocationName" id="LocationName" value="@if(isset($details['orderDelivery']['locationName'])) {{$details['orderDelivery']['locationName']}} @endif">
            </div>

            <div class="form-group">
                <label for="DeliveryCode">Mã vận đơn</label>
                <input type="text" class="form-control" id="DeliveryCode" name="DeliveryCode" value="@if(isset($details['orderDelivery']['deliveryCode'])) {{$details['orderDelivery']['deliveryCode']}} @endif">
            </div>
            <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect2">Mã đối tác</label>
                    <input type="text" class="form-control" name="Code" id="Code" value="@if(isset($details['orderDelivery']['partnerDelivery']['code'])) {{$details['orderDelivery']['partnerDelivery']['code']}} @endif">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Name">Tên đối tác</label>
                        <input type="text" class="form-control Name" id="Name" name="Name" value="@if(isset($details['orderDelivery']['partnerDelivery']['name'])){{$details['orderDelivery']['partnerDelivery']['name']}} @endif">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect2">Ngày giao hàng</label>
                    <input type="date" class="form-control" name="ExpectedDelivery" >
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect2">Phí giao hàng</label>
                    <input type="number" class="form-control" name="Price" id="Price" value="@if(isset($details['orderDelivery']['price'])){{$details['orderDelivery']['price']}}@endif">
                </div>
            </div>
                <div class="form-group">
                    <label for="">Trạng thái giao hàng</label>
                    <div class="form-check">
                        <input class="form-check-input" name="Status" type="radio" id="gridCheck1" @if(isset($details['orderDelivery']['status'])) @if($details['orderDelivery']['status']==3) checked @endif @endif  value="3">
                        <label class="form-check-label" for="gridCheck1">
                            Chưa giao
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="Status" type="radio" id="gridCheck2" @if(isset($details['orderDelivery']['status'])) @if($details['orderDelivery']['status']==4) checked @endif @endif  value="4">
                        <label class="form-check-label" for="gridCheck2">
                            Đã giao
                        </label>
                    </div>
             </div>
             <div class="form-row" hidden>
                <div class="form-group col-md-12">
                <label for="exampleFormControlSelect2">Sản phẩm</label>
                    <select multiple class="form-control" name="ProductId[]" id="ProductId">
                    @foreach($product as $pd)
                        @if(isset($details['orderDetails']))
                            @foreach($details['orderDetails'] as $od)
                               <option @if($od['productId'] == $pd['id']) selected @endif  value="{{$pd['id']}}">{{$pd['name']}}</option>
                            @endforeach

                        @endif
                       
                   @endforeach
                       
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Quantity">Số lượng các sản phẩm</label><br>
                        @php $stt=0; @endphp
                        @if(isset($details['orderDetails']))
                            @foreach($details['orderDetails'] as $dt)
                                @php $stt++; @endphp
                                <label for="Quantity">Sản phẩm {{$stt}}</label><br>
                                <input type="number"  class="form-control" name="Quantity[]" id="Quantity" min="1" max="50" value="@if(isset($dt['quantity'])){{$dt['quantity']}}@endif">
                            @endforeach
                        @endif
                </div>
                
            </div>
            <div class="form-group">
            @php
                if(isset($details['orderDetails']))
                {
                    foreach($details['orderDetails'] as $od)
                    {
                        if(isset($od['note'])){
                            $note = $od['note'];
                        }
                        
                    }
                }
             @endphp
                    <label for="Note">Ghi chú</label>
                    <textarea class="form-control"id="" cols="30" rows="10" name="Note" id="Note">@if(isset($note)){{$note}}@endif</textarea>
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

