<!DOCTYPE html>
<html>
<head> 
  @include('Dashboard.head')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js Library -->
</head>
<body>
@include('Dashboard.header')
<div class="d-flex align-items-stretch">
@include('Dashboard.sidebar')


<div class="page-content">
<div class="container-fluid">
  <ul class="breadcrumb">
    <li class="breadcrumb-item"><a style="color: #1E90FF;">Statistics</a>
        <i class="fas fa-question-circle" style="color: #1E90FF; cursor: pointer;" onclick="toggleInstruction()"></i>
    <div id="instruction-box-statistic" style="display:none; background-color:#f9f9f9; border:1px solid #ccc; padding:10px; border-radius:5px; width:250px; margin-top:5px;">
      Information about the Monthly Commission.
    </div>

    <script>
      function toggleInstruction() {
        const box = document.getElementById("instruction-box-statistic");
        box.style.display = box.style.display === "none" ? "block" : "none";
      }
    </script>
  </li>
  </ul>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
      <div class="line-chart block chart rounded-lg shadow p-4 bg-dark">
        <div class="title"><strong style="color: #1E90FF;">Monthly Commission</strong></div>
        <canvas id="lineChartCustom1"></canvas>
      </div>
    </div>
  </div>
</div>
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Application</a></li>
      <li class="breadcrumb-item active">Information</li>
        <i class="fas fa-question-circle" style="color: #1E90FF; cursor: pointer;" onclick="toggleInstructioneye()"></i>
        <div id="instruction-box-approve" style="display:none; background-color:#f9f9f9; border:1px solid #ccc; padding:10px; border-radius:5px; width:250px; margin-top:5px;">
          Application of costumers to be a property lister. You can approved via button
        </div>

        <script>
          function toggleInstructioneye() {
            const box = document.getElementById("instruction-box-approve");
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
            <div class="title"><strong style="color: #1E90FF;">All Applications to Become a Lister</strong></div>
            <div class="table-responsive"> 
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>User-ID</th>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Current Address</th>
                    <th>Permanent Address</th>
                    <th>Application Status</th>
                    <th>ID Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($application as $data)
                    @if ($data->usertype != 'lister')
                      <tr>
                        <td>{{ $data->user_id }}</td>
                        <td>{{ $data->fullname }}</td>
                        <td>{{ $data->age }}</td>
                        <td>{{ $data->gender }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->current_address }}</td>
                        <td>{{ $data->permanent_address }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                          <img src="{{ asset('ID/' . $data->image) }}" alt="ID Image"
                              width="100" height="100"
                              style="object-fit: cover; border-radius: 8px; cursor: pointer;"
                              data-toggle="modal" data-target="#imageModal{{ $data->user_id }}">
                        </td>
                        <td>
                          <form action="{{ url('approve_application', $data->user_id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                          </form>
                        </td>
                      </tr>

                      <!-- Full-Size Image Modal -->
                      <div class="modal fade" id="imageModal{{ $data->user_id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $data->user_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="imageModalLabel{{ $data->user_id }}">Image Preview</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-center">
                              <img src="{{ asset('ID/' . $data->image) }}" alt="Full Image"
                                  class="img-fluid rounded"
                                  style="max-height: 90vh; width: auto;">
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
</div>

@include('Dashboard.footer')

<script>
  var monthlySales = @json($salesData);
</script>

</body>
</html>
