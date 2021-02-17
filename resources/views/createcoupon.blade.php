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
                  <h4 class="card-title">Create Coupon</h4>
                  <form class="cmxform" id="signupForm2"  method="POST" action="{{ route('createcoupon') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label>Logo upload</label>
                        <input id="logoupload" type="file" name="logo" required class="file-upload-default{{ $errors->has('logo') ? ' has-error' : '' }}" value="{{ old('logo') }}">
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
                        <input id="title" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" type="text" required value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                      </div>
                      
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' has-error' : '' }}" name="description" type="text" required value="{{ old('description') }}"></textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                      </div>

                      <div class="form-group row">
                        <div class="form-radio mr-2">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="percent" checked> Percentage off
                          </label>
                        </div>
                        <div class="form-radio">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="fixed"> Fixed off
                          </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="percentageoff">Percentage off (%)</label>
                        <input id="percentageoff" class="form-control{{ $errors->has('percentageoff') ? ' has-error' : '' }}" name="percentageoff" type="percentageoff" required value="{{ old('percentageoff') }}">
                       <span class="input-group-addon input-group-append border-left">
                          
                        </span>
                        @if ($errors->has('percentageoff'))
                            <span class="help-block">
                                <strong>{{ $errors->first('percentageoff') }}</strong>
                            </span>
                        @endif    
                      </div>

                      <div class="form-group">
                        <label for="fixedoff">Fixed off ($)</label>
                        <input id="fixedoff" class="form-control{{ $errors->has('fixedoff') ? ' has-error' : '' }}" name="fixedoff" type="fixedoff" required value="{{ old('fixedoff') }}" disabled>
                       <span class="input-group-addon input-group-append border-left">
                          
                        </span>
                        @if ($errors->has('fixedoff'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fixedoff') }}</strong>
                            </span>
                        @endif    
                      </div>
                      
                      <div class="form-group">
                        <label for="expirydate">Expiry date</label>
                        <div id="datepicker-popup" class="input-group date datepicker{{ $errors->has('expirydate') ? ' has-error' : '' }}" required value="{{ old('expirydate') }}">
                          <input id="expirydate" name="expirydate" type="text" class="form-control">
                          <span class="input-group-addon input-group-append border-left" >
                            <span class="mdi mdi-calendar input-group-text"></span>
                          </span>
                          @if ($errors->has('expirydate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('expirydate') }}</strong>
                            </span>
                          @endif    
                        </div>
                      </div>
                      {{-- <div class="form-group">
                        <label for="amount" >Amount</label>
                        <input id="amount" class="form-control{{ $errors->has('amount') ? ' has-error' : '' }}" name="amount" type="amount" required value="{{ old('amount') }}">
                        @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif    
                      </div> --}}
                      <div class="form-group">
                        <label for="userlist">Users</label>
                        <select class="js-example-basic-multiple w-100" multiple="multiple" name="userlist[]" value="{{ old('userlist[]') }}">
                          @foreach ($users as $user) 
                          <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}}</option>
                          @endforeach
                        </select>
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