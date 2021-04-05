<div class="modal fade" id="EditCustomer{{$stt}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="{{url('/customer/update/'.$ctm['id'])}}" method="post">
    @csrf
      <div class="modal-header bg-success" style="color:#fff;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-edit"></i> Sửa khách hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="code">Mã khách hàng</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{$ctm['code']}}">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="inputPassword4">Tên khách hàng</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$ctm['name']}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{$ctm['address']}}">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="contactNumber">Số điện thoại</label>
                    <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="{{$ctm['contactNumber']}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="birthDate">Ngày sinh</label>
                    <input type="date" class="form-control" id="birthDate" name="birthDate" value="">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="email">Email khách hàng</label>
                    <input type="email" class="form-control" id="email" name="email" value="@if(isset($ctm['email'])){{$ctm['email']}}@endif">
                </div>
            </div>
            <div class="form-group">
                <label for="">Giới tính</label>
                <div class="form-check">
                    <input class="form-check-input" @if(isset($ctm['gender'])) @if($ctm['gender'] == true) checked @endif @endif name="gender" type="radio" id="gridCheck1" value="true">
                    <label class="form-check-label" for="gridCheck1">
                        Nam
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" @if(isset($ctm['gender'])) @if($ctm['gender'] == false) checked @endif @endif name="gender" type="radio" id="gridCheck2" value="false">
                    <label class="form-check-label" for="gridCheck2">
                        Nữ
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="locationName">Khu Vực</label>
                <input type="text" class="form-control" name="locationName" id="locationName" value="@if(isset($ctm['locationName'])){{$ctm['locationName']}}@endif">
            </div>
            <div class="form-group">
                <label for="comments">Ghi chú</label>
                <textarea class="form-control" id="comments" name="comments" rows="3">@if(isset($ctm['comments'])){{$ctm['comments']}}@endif</textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">Chọn chi nhánh</label>
                <select class="form-control" id="branchId" name="branchId">
                     <option value="0">Chọn chi nhánh</option>
                    @foreach($ShowBranches as $Bc)
                        <option @if($ctm['branchId'] == $Bc['id']) selected @endif value="{{$Bc['id']}}">{{$Bc['branchName']}}</option>
                    @endforeach
                </select>
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