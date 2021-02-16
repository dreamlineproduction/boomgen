@extends('layout.layout')
       
@section('content')

    <div class="content-wrapper">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">User Details</h4>
            <div class="row">
            <div class="col-12 table-responsive">
                <div class="col-12 justify-content-center text-center">
                    @php $path = url("/".$coupon->logo); @endphp
                    <a href="{{$path}}">
                        <img src="{{$path}}" style="max-width: 200px; height: auto"/>
                    </a>
                </div>
                <table class="table table-borderless w-100 mt-4 ">
                    <tr>
                        <td>
                        <strong>Customer :</strong> {{$user->firstname . " " . $user->lastname}}</td>
                        <td>
                        <strong>Coupon Title :</strong> {{$coupon->title}}</td>
                    </tr>
                    <tr>
                        <td>
                        <strong>Purchased On :</strong> {{$userlist->purchasedon}}</td>
                        <td>
                        <strong>Expiry Date :</strong> {{$coupon->expirydate}}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Price :</strong> {{$coupon->amount}}</td>
                        <td>
                            <strong>Percentage :</strong> {{$coupon->percentage}}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Coupon Code :</strong> {{$coupon->couponcode}}</td>
                        <td>
                            <strong>Description :</strong> {{$coupon->description}}</td>
                    </tr>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
        
@endsection