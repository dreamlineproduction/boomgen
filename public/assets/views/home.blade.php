
    @extends('layout.layout')
       
    @section('content')
    
    <div class="content-wrapper">
          <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
              <h4 class="page-title">Dashboard</h4>
              <div class="d-flex align-items-center">
                {{-- <div class="wrapper mr-4 d-none d-sm-block">
                  <p class="mb-0">Summary for
                    <b class="mb-0">September 2017</b>
                  </p>
                </div>
                <div class="wrapper">
                  <a href="#" class="btn btn-link btn-sm font-weight-bold">
                    <i class="icon-share-alt"></i>Export CSV
                  </a>
                </div> --}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 card-statistics">
              <div class="row">
                <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card card-tile">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between pb-2">
                        <h5>Number of Users</h5>
                        <i class="icon-people"></i>
                      </div>
                      <div class="d-flex justify-content-between">
                        <p class="text-muted">Total : {{$usercount}}</p>
                      </div>
                      {{-- <div class="progress progress-md">
                        <div class="progress-bar bg-info w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div> --}}
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card card-tile">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between pb-2">
                        <h5>Number of Coupons</h5>
                        <i class="icon-list"></i>
                      </div>
                      <div class="d-flex justify-content-between">
                        <p class="text-muted">Redeemed : {{$redeemedCouponCount}}</p>
                        <p class="text-muted">Total : {{$couponCount}}</p>
                      </div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-success w-25" role="progressbar" aria-valuenow="{{$redeemedCouponCount}}" aria-valuemin="0" aria-valuemax="{{$couponCount}}"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>          
          <div class="row">
             <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <h4 class="card-title">Latest Users</h4>
                  </div>
                  @foreach ($users as $user)
                      <div class="list d-flex align-items-center border-bottom py-3">
                        <div class="wrapper w-100 ml-3">
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                              @php 
                              $time = "";
                                if (isset($user->created_at)) {
                                  $now = Carbon\Carbon::now();
                                  $created = $user->created_at;
                                  $diff = $created->diffInMinutes($now);
                                  if($diff == 1){
                                      $time = $diff . " " . "minute ago";
                                  }else {
                                      $time = $diff . " " . "minutes ago";
                                  }
                                  if ($diff >= 60){
                                    $diff = $created->diffInHours($now);
                                    if($diff == 1){
                                      $time = $diff . " " . "hour ago";
                                    }else {
                                      $time = $diff . " " . "hours ago";
                                    }
                                  }
                                  if ($diff >= 24){
                                    $diff = $created->diffInDays($now);
                                    if($diff == 1){
                                      $time = $diff . " " . "day ago";
                                    }else {
                                      $time = $diff . " " . "days ago";
                                    }
                                  }
                                  if ($diff >= 30){
                                    $diff = $created->diffInMonths($now);
                                    if($diff == 1){
                                      $time = $diff . " " . "month ago";
                                    }else {
                                      $time = $diff . " " . "months ago";
                                    }
                                  } 
                                  if ($diff >= 365){
                                    $diff = $created->diffInYears($now);
                                    if($diff == 1){
                                      $time = $diff . " " . "year ago";
                                    }else {
                                      $time = $diff . " " . "years ago";
                                    }
                                  }   
                                }
                                  
                              @endphp
                              <p class="mb-0"><b>{{$user->firstname}} {{$user->lastname}}</b> </p>
                            </div>
                            <small class="text-muted ml-auto">{{$time}}</small>
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
              </div>
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h4 class="card-title">Latest Coupons</h4>
                    </div>
                    @foreach ($coupons as $coupon)
                      <div class="list d-flex align-items-center border-bottom py-3">
                        @php $path = url("/".$coupon->logo); @endphp
                        <img class="img-sm rounded-circle" src="{{ $path }}" alt="">
                        <div class="wrapper w-100 ml-3">
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                              @php 
                                  $now = Carbon\Carbon::now();
                                  $created = $coupon->created_at;
                                  $diff = $created->diffInMinutes($now);
                                  if($diff == 1){
                                      $time = $diff . " " . "minute ago";
                                  }else {
                                      $time = $diff . " " . "minutes ago";
                                  }
                                  if ($diff >= 60){
                                    $diff = $created->diffInHours($now);
                                    if($diff == 1){
                                      $time = $diff . " " . "hour ago";
                                    }else {
                                      $time = $diff . " " . "hours ago";
                                    }
                                  }
                                  if ($diff >= 24){
                                    $diff = $created->diffInDays($now);
                                    if($diff == 1){
                                      $time = $diff . " " . "day ago";
                                    }else {
                                      $time = $diff . " " . "days ago";
                                    }
                                  }
                                  if ($diff >= 30){
                                    $diff = $created->diffInMonths($now);
                                    if($diff == 1){
                                      $time = $diff . " " . "month ago";
                                    }else {
                                      $time = $diff . " " . "months ago";
                                    }
                                  } 
                                  if ($diff >= 365){
                                    $diff = $created->diffInYears($now);
                                    if($diff == 1){
                                      $time = $diff . " " . "year ago";
                                    }else {
                                      $time = $diff . " " . "years ago";
                                    }
                                  }   
                              @endphp
                              <p class="mb-0"><b>{{$coupon->title}}</b> </p>
                            </div>
                            <small class="text-muted ml-auto">{{$time}}</small>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
            </div>
          </div>
        </div>
        
    @endsection