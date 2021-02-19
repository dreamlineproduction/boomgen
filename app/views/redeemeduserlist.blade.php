    @extends('layout.layout')
       
    @section('content')
    
    <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Redeemed List</h4>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                        <th>S.No #</th>
                        <th>Customer Redeemed</th>
                        <th>Date Of Redeem</th>
                        <th>Coupon Seller</th>
                        <th>Coupon Code</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $count = 1 @endphp
                      @foreach ($userlist as $userlist) 
                        <td>{{ $count++}}</td>
                        <td>{{App\Http\Controllers\UserlistController::getCustomerName($userlist->customerid)}}</td>
                        <td>{{ $userlist->purchasedon}}</td>
                        <td>
                          @php 
                            $coupon = App\Http\Controllers\UserlistController::getCouponSeller($userlist->couponid);
                            if($coupon != ""){
                              $path = url("/".$coupon);
                            }
                            @endphp
                            @if($coupon != "")
                              <img src="{{ $path }}"/>
                            @endif
                        </td>
                        <td>{{App\Http\Controllers\UserlistController::getCouponCode($userlist->couponid)}}</td></td>
                        <td>
                          <a href="{{ route('viewuser', $userlist->id) }}" class="btn btn-outline-primary">View</a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
    @endsection