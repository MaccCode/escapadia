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
            <h2 class="h5 no-margin-bottom">View Completed Booking</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Booking</a></li>
            <li class="breadcrumb-item active">Information</li>
            <i class="fas fa-question-circle" style="color: #1E90FF; cursor: pointer;" onclick="toggleInstruction()"></i>
            <div id="instruction-box-update" style="display:none; background-color:#f9f9f9; border:1px solid #ccc; padding:10px; border-radius:5px; width:250px; margin-top:5px;">
              Completed bookings are shown here as for traceability.
            </div>

            <script>
              function toggleInstruction() {
                const box = document.getElementById("instruction-box-update");
                box.style.display = box.style.display === "none" ? "block" : "none";
              }
            </script>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Completed Booking</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-sm">
                      <thead>
                          <th>#</th>
                          <th>User-ID</th>
                          <th>Lister-ID</th>
                          <th>Property-ID</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Start</th>
                          <th>End</th>
                          <th>Price</th>
                          <th>Payment-Status</th>
                          <th>Status</th>
                          <th>Created</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php
                          $sorted = $data->sortByDesc('created_at');
                      @endphp

                      @foreach ($sorted as $completed)
                          @if ($completed->lister_id == Auth::user()->id)
                              <tr>
                                  <td>{{ $completed->id }}</td>
                                  <td>{{ $completed->user_id }}</td>
                                  <td>{{ $completed->lister_id }}</td>
                                  <td>{{ $completed->property_id }}</td>
                                  <td>{{ $completed->name }}</td>
                                  <td>{{ $completed->phone }}</td>
                                  <td>{{ $completed->email }}</td>
                                  <td>{{ $completed->start_date }}</td>
                                  <td>{{ $completed->end_date }}</td>
                                  <td>{{ $completed->price }}</td>
                                  <td>{{ $completed->payment_status }}</td>
                                  <td>{{ $completed->status }}</td>
                                  <td>{{ $completed->created_at }}</td>
                              </tr>
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