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
            <h2 class="h5 no-margin-bottom">View Application</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Application</a></li>
            <li class="breadcrumb-item active">Information            </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Application</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-hover">
                      <thead>
                          <th>#</th>
                          <th>User-ID</th>
                          <th>fullname</th>
                          <th>Gender</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Current Address</th>
                          <th>Permanent Address</th>
                          <th>Application Status</th>
                          <th>ID Image</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $application)
                        @if ($application->user_id == Auth::user()->id)
                            <tr>
                                <td>{{ $application->id}}</td>
                                <td>{{ $application->fullname }}</td>
                                <td>{{ $application->age}}</td>
                                <td>{{ $application->gender}}</td>
                                <td>{{ $application->phone}}</td>
                                <td>{{ $application->email}}</td>
                                <td>{{ $application->current_address}}</td>
                                <td>{{ $application->permanent_address}}</td>
                                <td>{{ $application->status}}</td>
                                <td>
                                <img src="{{ asset('ID/' . $application->image) }}" alt="ID Image"
                                    width="100" height="100"
                                    style="object-fit: cover; border-radius: 8px; cursor: pointer;"
                                    data-toggle="modal" data-target="#imageModal{{ $application->id }}">
                                </td>

                                  <!-- Full-Size Image Modal -->
                                  <div class="modal fade" id="imageModal{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $application->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="imageModalLabel{{ $application->id }}">Image Preview</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body text-center">
                                          <img src="{{ asset('ID/' . $application->image) }}" alt="Full Image"
                                              class="img-fluid rounded"
                                              style="max-height: 90vh; width: auto;">
                                        </div>
                                      </div>
                                    </div>
                                  </div>

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