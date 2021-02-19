    @extends('layout.layout')
       
    @section('content')
    
    <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Users List</h4>
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
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                        <th>S.No #</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $count = 1 @endphp
                      @foreach ($users as $user) 
                        <td>{{ $count++}}</td>
                        <td>{{ $user->firstname}} {{ $user->lastname}}</td>
                        <td>
                        @php $path = url("/".$user->image); @endphp
                        @if($user->image != "")
                        <img src="{{ $path }}"/>
                        @endif
                        </td>
                        <td>{{ $user->username}}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->phonenumber}}</td>
                        <td>{{ $user->address1}}</td>
                        <td>{{ $user->address2}}</td>
                        <td>{{ $user->state}}</td>
                        <td>{{ $user->zip}}</td>

                        <td style="display: flex; flex-direction: row;flex-wrap: nowrap;">
                          <a href="{{ route('edituser', $user->id) }}" class="btn btn-outline-primary mx-1" style="padding: 7px;width: 70px;">Edit</a>
                          <form action="{{ route('blockuser') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="blockid" value="{{$user->id}}"/>
                            @if($user->status == "1")
                              <a href="{{ route('blockuser') }}" class="btn btn-outline-secondary mx-1" style="padding: 7px;width: 70px;" onclick="this.closest('form').submit();return false;">Block</a>
                            @else
                              <a href="{{ route('blockuser') }}" class="btn btn-outline-secondary mx-1" style="padding: 7px;width: 70px;" onclick="this.closest('form').submit();return false;">Unblock</a>
                            @endif
                          </form>
                          <form action="{{ route('deleteuser') }}" id="deleteform{{$user->id}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="deleteid" value="{{$user->id}}"/>
                          </form>
                          <button onclick="showSwal('deleteform{{$user->id}}')" style="padding: 7px;width: 70px;" class="btn btn-outline-danger mx-1">Delete</button>
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