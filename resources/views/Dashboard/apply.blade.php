<!DOCTYPE html>
<html>
  <head> 
    @include('Dashboard.head')
    </style>
  </head>
  <body>
    @include('Dashboard.header')
    <div class="d-flex align-items-stretch">
        @include('Dashboard.sidebar')
        <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Application Form</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="" style="color: #4949FF;">Applicant</a></li>
            <li class="breadcrumb-item active">Informations</li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <!-- Form Elements -->
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong style="color: #4949FF;">All Informations</strong></div>
                  <div class="block-body">
                    <form class="form-horizontal" action="{{ url('apply_confirm') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      
                      @if (Route::has('login'))
                      @Auth    
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #4949FF;"><strong>Full Name</strong></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="fullname" value="{{ Auth::user()->name }}" placeholder="Enter your full name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #4949FF;"><strong>Age</strong></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name ="age" placeholder="Age" required>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #4949FF;"><strong>Gender</strong></label>
                        <div class="col-sm-12">
                            <select name="gender" id="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #4949FF;"><strong>Email</strong></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Enter your email" required>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #4949FF;"><strong>Phone Number</strong></label>
                        <div class="col-sm-12">
                          <input type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}" placeholder="Enter your phone number" required>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #4949FF;"><strong>Current Address</strong></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="current_address" placeholder="Enter your current address" required>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #4949FF;"><strong>Permanent Address</strong></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="permanent_address" placeholder="Enter your permanent address" required>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #4949FF;"><strong>Upload a Valid ID</strong>(National ID, Passport, Voter's ID, Drivers license, Senior Citizen ID, Government Issued ID)</label>
                        <div class="col-sm-12">
                          <input type="file" name="image" placeholder="Enter image file" required>
                        </div>
                      </div>
                      @endAuth
                      @endif
                      <div class="line"></div>
                      <div class="form-group row">
                        <div class="col-sm-12 ml-auto">
                          <a href="dashboard" class="btn btn-secondary">Cancel</a>
                          <button type="submit" class="btn btn-success">Confirm</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        </div>
        </div>    
      <!-- Success Modal -->
      <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="successModalLabel">Success</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {{ session('message') }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
      </div>
    @include ('Dashboard.footer')
  </body>
</html>