<!DOCTYPE html>
<html>
  <head> 
    @include('Dashboard.head')
  </head>
  <body>
    @include('Dashboard.header')
    <div class="d-flex align-items-stretch">
        @include('Dashboard.sidebar')
        <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">View Messages</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Message</a></li>
            <li class="breadcrumb-item active">Information            </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong></strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-hover">
                      <thead class="text-uppercase text-center align-middle">  
                        <tr>
                          <th>ID</th>
                          <th>user-id</th>
                          <th>Name</th>
                          <th>phone</th>
                          <th>email</th>
                          <th>Message</th>
                        </tr>
                      </thead>
                      <tbody class="text-center align-middle">
                        @foreach ($data as $booking)
                        @if ($booking->lister_id == Auth::user()->id)
                            <tr>
                                <td>{{ $booking->id}}</td>
                                <td>{{ $booking->user_id }}</td>
                                <td>{{ $booking->name}}</td>
                                <td>{{ $booking->phone}}</td>
                                <td>
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $booking->email }}" target="_blank" style="color: #7f8c8d;">
                                        {{ $booking->email }}
                                    </a>
                                </td>
                                <td>{{ $booking->message}}</td>
                        @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </section>
        </div>
        </div>   
       @include ('Dashboard.footer')
  </body>
</html>