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
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Booking</a></li>
        <li class="breadcrumb-item active">Information</li>
        <i class="fas fa-question-circle" style="color: #1E90FF; cursor: pointer;" onclick="toggleInstruction()"></i>
          <div id="instruction-box-statistic" style="display:none; background-color:#f9f9f9; border:1px solid #ccc; padding:10px; border-radius:5px; width:250px; margin-top:5px;">
            You can see your bookings and it's status.
          </div>

          <script>
            function toggleInstruction() {
              const box = document.getElementById("instruction-box-statistic");
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
              <div class="title"><strong style="color: #1E90FF;">Booking</strong></div>
              <div class="table-responsive"> 
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Property_id</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Number of Guest</th>
                      <th>Price</th>
                      <th>Payment</th>
                      <th>Booking Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $booking)
                    @if (Auth::user()->id == $booking->user_id)
                        <tr class="text-center  fs-1 fw-bold">
                            <td>{{ $booking->id}}</td>
                            <td>{{ $booking->property_id}}</td>
                            <td>{{ $booking->name}}</td>
                            <td>{{ $booking->phone}}</td>
                            <td>{{ $booking->email}}</td>
                            <td>{{ $booking->start_date}}</td>
                            <td>{{ $booking->end_date}}</td>
                            <td>{{ $booking->number_of_guests}}</td>
                            <td>{{ $booking->price}}</td>
                            <td>{{ $booking->payment_method}}</td>
                            <td>@if ($booking->status == 'approved')
                              <span class="badge bg-success text-white fs-5 px-3 py-2">Approved</span>
                            @elseif ($booking->status == 'rejected')
                              <span class="badge bg-danger text-white fs-5 px-3 py-2">Rejected</span>
                            @else
                              <span class="badge bg-warning text-white fs-5 px-3 py-2">Pending</span>
                            @endif
                            </td>
                            <td>
                              <button class="btn-action btn btn-danger" {{ $booking->status == 'approved' ? 'disabled' : '' }} data-toggle="modal" data-target="#confirmDeleteModal">Cancel</a></button>                     
                            </td>
                        </tr>
                    @endif
                    <!-- Confirm Delete Modal -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Cancellation</h5>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete this listing?
                              </div>
                              <div class="modal-footer">
                                <form id="deleteForm" method="Get" action="{{ url('cancel_booking', $booking->id) }}">
                                  @csrf
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Return</button>
                                  <button type="submit" class="btn btn-primary">Yes, Cancel</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div> 
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>                
          </div>
                        <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong style="color: #1E90FF;">Approved Booking</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Property_id</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Number of Guest</th>
                          <th>Price</th>
                          <th>Payment</th>
                          <th>Payment Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $booking)
                        @if (Auth::user()->id == $booking->lister_id)
                        @if ($booking->status == 'approved' and $booking->stay_status == 'pending' or $booking->stay_status == 'checked_in' or $booking->stay_status == 'completed')
                            <tr class="text-center  fs-1 fw-bold">
                                <td>{{ $booking->id}}</td>
                                <td>{{ $booking->property_id}}</td>
                                <td>{{ $booking->name}}</td>
                                <td>{{ $booking->phone}}</td>
                                <td>{{ $booking->email}}</td>
                                <td>{{ $booking->start_date}}</td>
                                <td>{{ $booking->end_date}}</td>
                                <td>{{ $booking->number_of_guests}}</td>
                                <td>{{ $booking->price}}</td>
                                <td>{{ $booking->payment_method}}</td>
                                <td>@if ($booking->payment_status == 'paid')
                                <span class="badge bg-success text-white fs-5 px-3 py-2">Paid</span>
                                @else
                                  <span class="badge bg-danger text-white fs-5 px-3 py-2">Unpaid</span>
                                @endif
                                </td>
                                <td>
                                <form action="{{ url('payment/'. $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @if($booking->payment_status == 'paid')
                                      <button type="submit" class="btn btn-warning" disabled>Paid</button>
                                    @else
                                      <button type="submit" class="btn-action btn btn-success">Paid</button>
                                    @endif
                                </form>
                                </td>
                            </tr>
                        @endif
                        @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>                
              </div>
              <div class="col-lg-6">
                <div class="block">
                  <div class="title"><strong style="color: #1E90FF;">Check in</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Arrival Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $booking)
                        @if (Auth::user()->id == $booking->lister_id)
                        @if ($booking->status == 'approved' and $booking->stay_status == 'pending')  
                        <tr>
                          <th>{{$booking->id}}</th>
                          <td>{{$booking->name}}</td>
                          <td>{{$booking->phone}}</td>
                          <td>{{$booking->start_date}}</td>
                          <td>{{$booking->stay_status}}</td>
                          <td>
                            <form action="{{ url('checkin/'. $booking->id) }}" method="POST" style="">
                                @csrf
                                <button id=".btn-action" type="submit" class="btn-action btn btn-success">Check In</button>
                            </form>
                          </td>
                        </tr>
                        @endif
                        @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="block">
                  <div class="title"><strong style="color: #1E90FF;">Check out</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-sm">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Departing Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $booking)
                      @if (Auth::user()->id == $booking->lister_id)
                      @if ($booking->status == 'approved' and $booking->stay_status == 'checked_in')  
                      <tr>
                        <th>{{$booking->id}}</th>
                        <td>{{$booking->name}}</td>
                        <td>{{$booking->phone}}</td>
                        <td>{{$booking->end_date}}</td>
                        <td>{{$booking->stay_status}}</td>
                        <td>
                          <form action="{{ url('checkout/'. $booking->id) }}" method="POST" style="">
                              @csrf
                              <button type="submit" class="btn-action btn btn-success">Check Out</button>
                          </form>
                        </td>
                      </tr>
                      @endif
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
  @include('Dashboard.footer')
  </body>
</html>