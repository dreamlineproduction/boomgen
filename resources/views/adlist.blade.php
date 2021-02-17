
    
    @extends('layout.layout')
       
    @section('content')
    <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Advertisement List</h4>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                        <th>S.No. #</th>
                        <th>Logo</th>
                        <th>Title</th>
                        <th>Description</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $count = 1 @endphp
                        @foreach ($ads as $ad) 
                          <tr>
                            <td>{{ $count++}}</td>
                            @php $path = url("/".$ad->logo); @endphp
                            <td> <img src="{{ $path }}" alt="logo" /></td>
                            <td>{{ $ad->title}}</td>
                            <td>{{ $ad->description}}</td>
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