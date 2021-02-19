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
              <h4 class="card-title">Edit Ad</h4>
              <form class="cmxform" id="signupForm1"  method="POST" action="{{ route('updatead') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label>Logo upload</label>
                  <input id="logoupload" type="file" name="logo" class="file-upload-default{{ $errors->has('logo') ? ' has-error' : '' }}" value="{{ old('logo') }}">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" >
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                    </span>
                    @if ($errors->has('logo'))
                      <span class="help-block">
                          <strong>{{ $errors->first('logo') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="title">Title</label>
                  <input id="title" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" type="text" required value="{{ $ad->title }}">
                  @if ($errors->has('title'))
                      <span class="help-block">
                          <strong>{{ $errors->first('title') }}</strong>
                      </span>
                  @endif
                </div>
                
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea id="description" class="form-control{{ $errors->has('description') ? ' has-error' : '' }}" name="description" type="text" required value="{{ old('description') }}">{{ $ad->description }}</textarea>
                  @if ($errors->has('description'))
                      <span class="help-block">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                  @endif
                </div>
              
                @php 
                  $userArray = explode (",", $ad->selecteduser);
                @endphp
                <div class="form-group">
                  <label for="userlist">Users</label>
                  <select class="js-example-basic-multiple w-100" multiple="multiple" name="userlist[]">
                    @foreach ($user as $user) 
                    <option value="{{$user->id}}" {{ in_array($user->id,$userArray) ? 'selected':'' }}>{{$user->firstname}} {{$user->lastname}}</option>
                    @endforeach
                  </select>
                </div>

                <input type="hidden" value="{{$ad->id}}" name="id"/>

                <button type="submit" class="btn btn-success mr-2">Submit</button>
                <a class="btn btn-light" href="{{ route('adslist') }}">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection