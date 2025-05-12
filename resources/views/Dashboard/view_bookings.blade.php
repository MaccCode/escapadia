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
            <h2 class="h5 no-margin-bottom">View Bookings</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Bookings</a></li>
            <li class="breadcrumb-item active">Information            </li>
            <i class="fas fa-question-circle" style="color: #1E90FF; cursor: pointer;" onclick="toggleInstruction()"></i>
            <div id="instruction-box-update" style="display:none; background-color:#f9f9f9; border:1px solid #ccc; padding:10px; border-radius:5px; width:250px; margin-top:5px;">
              You can manage bookings of your property here. Approve or Reject is your choice.
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
                    <div class="title"><strong>Pending</strong></div>
                    <div class="table-responsive"> 
                      <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>User-ID</th>
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
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $booking)
                        @if (Auth::user()->id == $booking->lister_id)
                        @if ($booking->status == 'pending')
                            <tr class="text-center  fs-1 fw-bold">
                                <td>{{ $booking->id}}</td>
                                <td>{{ $booking->user_id}}</td>
                                <td>{{ $booking->property_id}}</td>
                                <td>{{ $booking->name}}</td>
                                <td>{{ $booking->phone}}</td>
                                <td>{{ $booking->email}}</td>
                                <td>{{ $booking->start_date}}</td>
                                <td>{{ $booking->end_date}}</td>
                                <td>{{ $booking->number_of_guests}}</td>
                                <td>{{ $booking->price}}</td>
                                <td>{{ $booking->payment_method}}</td>
                                <td>{{ $booking->payment_status}}</td>
                                <td>
                                    @if($booking->status === 'pending')
                                      <span class="badge bg-warning text-white fs-5 px-3 py-2">Pending</span>
                                    @endif
                                </td>
                                <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmRejectModal{{ $booking->id }}">Reject</button>
                                </td>
                                <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmApproveModal{{ $booking->id }}">Approve</button>

                                </td>
                            </tr>
                        @endif
                        @endif
                        <!-- Confirm Approve Modal -->
                          <div class="modal fade" id="confirmApproveModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmApproveModalLabel{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                  <h5 class="modal-title" id="confirmApproveModalLabel{{ $booking->id }}">Confirm Approval</h5>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to approve this booking?
                                </div>
                                <div class="modal-footer">
                                  <form method="POST" action="{{ url('approve_booking/' . $booking->id) }}">
                                    @csrf
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Yes, Approve</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        <!-- Confirm Reject Modal -->
                        <div class="modal fade" id="confirmRejectModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmRejectModalLabel{{ $booking->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="confirmRejectModalLabel{{ $booking->id }}">Confirm Rejection</h5>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to reject this booking?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ url('reject_booking/' . $booking->id) }}">
                                            @csrf
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Yes, Reject</button>
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
                    <div class="title"><strong>Approved</strong></div>
                    <div class="table-responsive"> 
                      <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>User-ID</th>
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
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $booking)
                        @if (Auth::user()->id == $booking->lister_id)
                        @if ($booking->status == 'approved')
                            <tr class="text-center  fs-1 fw-bold">
                                <td>{{ $booking->id}}</td>
                                <td>{{ $booking->user_id}}</td>
                                <td>{{ $booking->property_id}}</td>
                                <td>{{ $booking->name}}</td>
                                <td>{{ $booking->phone}}</td>
                                <td>{{ $booking->email}}</td>
                                <td>{{ $booking->start_date}}</td>
                                <td>{{ $booking->end_date}}</td>
                                <td>{{ $booking->number_of_guests}}</td>
                                <td>{{ $booking->price}}</td>
                                <td>{{ $booking->payment_method}}</td>
                                <td>{{ $booking->payment_status}}</td>
                                <td>
                                @if($booking->status === 'approved')
                                  <span class="badge bg-success text-white fs-5 px-3 py-2">Approved</span>
                                @endif
                            </tr>
                          @endif
                          @endif
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="block">
                    <div class="title"><strong>Rejected</strong></div>
                    <div class="table-responsive"> 
                      <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>User-ID</th>
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
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $booking)
                        @if (Auth::user()->id == $booking->lister_id)
                        @if ($booking->status == 'rejected')
                            <tr class="text-center  fs-1 fw-bold">
                                <td>{{ $booking->id}}</td>
                                <td>{{ $booking->user_id}}</td>
                                <td>{{ $booking->property_id}}</td>
                                <td>{{ $booking->name}}</td>
                                <td>{{ $booking->phone}}</td>
                                <td>{{ $booking->email}}</td>
                                <td>{{ $booking->start_date}}</td>
                                <td>{{ $booking->end_date}}</td>
                                <td>{{ $booking->number_of_guests}}</td>
                                <td>{{ $booking->price}}</td>
                                <td>{{ $booking->payment_method}}</td>
                                <td>{{ $booking->payment_status}}</td>
                                <td>
                                @if($booking->status === 'rejected')
                                  <span class="badge bg-danger text-white fs-5 px-3 py-2">Rejected</span>
                                @endif
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
        </div>
      </div>      
    </section>     
  </div>
</div>
@include ('Dashboard.footer')
</body>
</html>