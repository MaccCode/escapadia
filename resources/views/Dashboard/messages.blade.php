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
            <h2 class="h5 no-margin-bottom">View Listings</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Listing</a></li>
            <li class="breadcrumb-item active">Information            </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Property</strong></div>
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
                                <td>{{ $booking->email}}</td>
                                <td>{{ $booking->message}}</td>
                        <!-- Confirm Delete Modal -->
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete this listing?
                              </div>
                              <div class="modal-footer">
                                <form id="deleteForm" method="" action="">
                                  @csrf
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-danger"><a href="{{ url('listing_delete', $booking->id) }}">Yes, Delete</a></button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div> 
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