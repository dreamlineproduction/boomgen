@extends('layout.layout')
       
@section('content')

<div class="content-wrapper">
      
      <div class="row grid-margin">
        
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
              @endif
              @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
              <h4 class="card-title">Update Account Details</h4>
              <form class="cmxform" id="signupFormnew"  method="POST" action="{{ route('updateadmin') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                    <label for="firstname">Firstname</label>
                    <input id="firstname" class="form-control" value="{{$user->firstname}}" name="firstname" type="text" required>
                    @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                    <label for="lastname">Lastname</label>
                    <input id="lastname" class="form-control" name="lastname" value="{{$user->lastname}}" type="text" required >
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" name="email" value="{{$user->email}}" type="email" required >
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label>Profile Picture</label>
                    <input id="profilepicture" type="file" name="profilepicture" class="file-upload-default{{ $errors->has('profilepicture') ? ' has-error' : '' }}" value="{{ old('profilepicture') }}">
                    <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" >
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                      </span>
                      @if ($errors->has('profilepicture'))
                        <span class="help-block">
                            <strong>{{ $errors->first('profilepicture') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <input type="hidden" value="{{$user->id}}" name="id"/>

                  <button type="submit" class="btn btn-success mr-2">Submit</button>
                  <a class="btn btn-light" href="{{ route('home') }}">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection