
    
    @extends('layout.layout')
       
    @section('content')
   
    
    
    
  
    
    <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Coupon List</h4>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                        <th>S.No #</th>
                        <th>Logo</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Percentage/Fixed Off</th>
                        {{-- <th>Amount</th> --}}
                        <th>Expiry Date</th>
                        <th>Coupons</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($coupons as $coupon) 
                          <tr>
                            <td>{{ $count++}}</td>
                            <td> 
                              @php
                                if($coupon->logo){
                                  $path = url("/".$coupon->logo);
                                }
                              @endphp
                              @if($coupon->logo)
                                <img src="{{ $path }}" alt="logo" />
                              @endif
                            </td>
                            <td>{{ $coupon->title}}</td>
                            <td>{{ $coupon->description}}</td>
                            <td>
                                @if ($coupon->percentage != "") 
                                  {{ $coupon->percentage}}
                                @else 
                                  {{ $coupon->fixed}}
                                @endif
                            </td>
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