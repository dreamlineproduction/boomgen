@extends('layout.layout')
       
@section('content')

    <div class="content-wrapper">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">User Details</h4>
            <div class="row">
            <div class="col-12 table-responsive">
                {{-- <div class="col-12 justify-content-center text-center">
                    <a href="images/boomgen/splashscreen.png">
                        <img src="{{$coupon->logo}}"/>
                    </a>
                </div> --}}
                <table class="table table-borderless w-100 mt-4 ">
                    <tr>
                        <td>
                        <strong>Customer :</strong> {{$userlist->customer}}</td>
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
                            <strong>Base Price :</strong> {{$userlist->baseprice}}</td>
                        <td>
                            <strong>Purchased Price :</strong> {{$userlist->purchaseprice}}</td>
                    </tr>
                    <tr>
                        <td>
                        <strong>Status :</strong> <span class="@if ($userlist->status == 'onhold') badge badge-info @elseif ($userlist->status == 'pending') badge badge-success @else badge badge-danger @endif">{{$userlist->status}}</span></td>
                    </tr>
                    </table>
            </div>
            </div>
        </div>
        </div>
    </div>
        
@endsection