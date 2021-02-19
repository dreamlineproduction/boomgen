    @extends('layout.layout')
       
    @section('content')
    
    <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Data table</h4>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                        <th>SNo</th>
                        <th>Customer Redeemed</th>
                        <th>Date Of Redeem</th>
                        <th>Coupon Seller</th>
                        <th>Coupon Code</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($userlist as $userlist) 
                        <td>{{ $userlist->id}}</td>
                        <td>{{App\Http\Controllers\UserlistController::getCustomerName($userlist->customerid)}}</td>
                        <td>{{ $userlist->purchasedon}}</td>
                        <td>
                          @php 
                            $coupon = App\Http\Controllers\UserlistController::getCouponSeller($userlist->couponid);
                            $path = url("/".$coupon); @endphp
                          <img src="{{ $path }}"/>
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