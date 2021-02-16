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
              <h4 class="card-title">Edit User</h4>
              <form class="cmxform" id="signupForm1"  method="POST" action="{{ route('updateuser') }}" enctype="multipart/form-data">
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
                  <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username">Username</label>
                    <input id="username" class="form-control" name="username" value="{{$user->username}}" type="text" required>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" name="email" value="{{$user->email}}" type="email" required disabled>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  <input type="hidden" value="{{$user->id}}" name="id"/>
                  {{-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" name="password" type="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                    <label for="confirm_password">Confirm password</label>
                    <input id="confirm_password" class="form-control" name="confirm_password" type="password" required>
                    @if ($errors->has('confirm_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('confirm_password') }}</strong>
                        </span>
                    @endif
                    <span id="same_password" style="font-size : 20px; color: red;"></span>
                  </div> --}}
                  <div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
                    <label for="phonenumber">Phonenumber</label>
                    <input id="phonenumber" class="form-control" name="phonenumber" value="{{ $user->phonenumber }}" required type="text" >
                    @if ($errors->has('phonenumber'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phonenumber') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                    <label for="address1">Address 1</label>
                    <input id="address1" class="form-control" name="address1" value="{{ $user->address1 }}" required type="text">
                    @if ($errors->has('address1'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address1') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="address2">Address 2</label>
                    <input id="address2" class="form-control" name="address2" value="{{ $user->address2 }}"  type="text">
                  </div>
                  <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                    <label for="state">State</label>
                    <input id="state" class="form-control" name="state" value="{{ $user->state }}" required type="text" >
                    @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                    <label for="zip">Zip</label>
                    <input id="zip" class="form-control" name="zip" value="{{ $user->zip }}" required type="text" >
                    @if ($errors->has('zip'))
                        <span class="help-block">
                            <strong>{{ $errors->first('zip') }}</strong>
                        </span>
                    @endif
                  </div>
                  <button type="submit" class="btn btn-success mr-2">Submit</button>
                  <a class="btn btn-light" href="{{ route('home') }}">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection