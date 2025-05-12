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
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">User</a></li>
        <li class="breadcrumb-item active">Information</li>
      </ul>
    </div>
    <section class="no-padding-top">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="block">
              <div class="title"><strong style="color: #4949FF;">All Users</strong></div>
              <div class="table-responsive"> 
                <table class="table table-striped table-sm">
                  <thead class="text-center">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>User Type</th>
                      <th>Action</th>
                      <th>Make Admin</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user as $data)
                      <tr class="text-center  fs-1 fw-bold">
                          <td>{{ $data->id}}</td>
                          <td>{{ $data->name}}</td>
                          <td>{{ $data->email}}</td>
                          <td>{{ $data->phone}}</td>
                          <td>
                              @if ($data->usertype == 'lister')
                                  <span class="badge bg-warning text-white fs-5 px-3 py-2">Lister</span>
                              @elseif ($data->usertype == 'user') 
                                  <span class="badge bg-success text-white fs-5 px-3 py-2">User</span>
                              @else
                                  <span class="badge bg-danger text-white fs-5 px-3 py-2">Admin</span>
                              @endif
                          </td>
                          <td>
                            @if ($data->usertype ==  'user')
                              <form action="{{ url('make_lister/'. $data->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                    <button type="submit" class="btn-action btn btn-warning">Lister</button>
                              </form>
                            @else
                              <form action="{{ url('make_user/'. $data->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                      <button type="submit" class="btn-action btn btn-success">User</button>
                                </form>
                            @endif
                          </td>
                          <td>
                          @if (in_array($data->usertype, ['user', 'lister']))
                              <form action="{{ url('make_admin/' . $data->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  <button type="submit" class="btn-action btn btn-danger">Admin</button>
                              </form>
                          @else
                              <button type="submit" class="btn-action btn btn-danger" disabled>Admin</button>
                          @endif
                          </td>
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
  @include('Dashboard.footer')
  </body>
</html>