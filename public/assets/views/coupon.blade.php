
    
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
                        <th>Order #</th>
                        <th>Logo</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Percentage</th>
                        {{-- <th>Amount</th> --}}
                        <th>Expiry Date</th>
                        <th>Coupons</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon) 
                          <tr>
                            <td>{{ $coupon->id}}</td>
                            @php $path = url("/".$coupon->logo); @endphp
                            <td> <img src="{{ $path }}" alt="logo" /></td>
                            <td>{{ $coupon->title}}</td>
                            <td>{{ $coupon->description}}</td>
                            <td>{{ $coupon->percentage}}</td>
                            {{-- <td>${{ $coupon->amount}}</td> --}}
                            <td>{{ $coupon->expirydate}}</td>
                            <td>
                              <a class="btn btn-outline-primary" href="{{ route('viewcoupon', $coupon->id) }}">View</a>
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