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
            <i class="fas fa-question-circle" style="color: #1E90FF; cursor: pointer;" onclick="toggleInstruction()"></i>
            <div id="instruction-box-update" style="display:none; background-color:#f9f9f9; border:1px solid #ccc; padding:10px; border-radius:5px; width:250px; margin-top:5px;">
              Messages of costumers or potential costumers. (You can click on the email to respond)
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
                  <div class="title"><strong>Property Inquiry Message</strong></div>
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
                   @foreach ($messages as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->user_id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $data->email }}" target="_blank" style="color: #7f8c8d;">
                                {{ $data->email }}
                            </a>
                        </td>
                        <td>{{ $data->message }}</td>
                    </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Booked Messages</strong></div>
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
                   @foreach ($bookings as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->user_id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $data->email }}" target="_blank" style="color: #7f8c8d;">
                                {{ $data->email }}
                            </a>
                        </td>
                        <td>{{ $data->message }}</td>
                    </tr>
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