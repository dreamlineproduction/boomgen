@extends('layout.layout')
       
@section('content')

    <div class="content-wrapper">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Ad Details</h4>
            <div class="row">
            <div class="col-12 table-responsive">
                <div class="col-12 justify-content-center text-center">
                    @php $path = url("/".$ad->logo); 
                    @endphp
                    @if($ad->logo)
                    <a href="{{$path}}">
                        <img src="{{$path}}" style="max-width: 200px; height: auto"/>
                    </a>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12">
                        <label><span style="font-size: 1.13rem">Title :</span>  {{$ad->title}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label><h4>Description</h4></label>
                    </div>
                    <div class="col-12">
                        <p>{{$ad->description}}</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
        
@endsection