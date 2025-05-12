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
            <h2 class="h5 no-margin-bottom">View Gallery</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Images</a></li>
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
                      <thead class="text-center">
                          <th>Property ID</th>
                          <th>User ID</th>
                          <th>Name/Title</th>
                          <th>Add Image</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @foreach ($data as $listing)
                        @if ($listing->user_id == Auth::user()->id)
                            <tr>
                                <td>{{ $listing->id}}</td>
                                <td>{{ $listing->user_id }}</td>
                                <td>{{ $listing->title}}</td>
                                <td>
                                  <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addImageModal{{ $listing->id }}">
                                    Add Image
                                  </button>
                                </td>
                            </tr>
                         <!-- Modal -->
                          <div class="modal fade" id="addImageModal{{ $listing->id }}" tabindex="-1" aria-labelledby="addImageModalLabel{{ $listing->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">

                                <div class="modal-header bg-info text-white">
                                  <h5 class="modal-title" id="addImageModalLabel{{ $listing->id }}">Add Image</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="{{ url('add_image') }}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  <input type="hidden" name="property_id" value="{{ $listing->id }}">

                                  <div class="modal-body">
                                    <div class="mb-3">
                                      <label for="image{{ $listing->id }}" class="form-label">Select Image</label>
                                      <input type="file" class="form-control" name="image" id="image{{ $listing->id }}" required>
                                    </div>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                  </div>
                                </form>
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
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Images</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-hover">
                      <thead class="text-center">
                          <th>#</th>
                          <th>Property ID</th>
                          <th>Name/Title</th>
                          <th>Add Image</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @foreach ($gallery as $data)
                        @if ($listing->user_id == Auth::user()->id)
                            <tr>
                                <td>{{ $data->id}}</td>
                                <td>{{ $data->property_id }}</td>
                                <td>
                                <img src="{{ asset('Gallery/' . $data->image) }}" alt="Property Image"
                                    width="200" height="100"
                                    style="object-fit: cover; border-radius: 8px; cursor: pointer;"
                                    data-toggle="modal" data-target="#imageModal{{ $data->id }}">
                                  </td>
                                  <!-- Full-Size Image Modal -->
                                  <div class="modal fade" id="imageModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="imageModalLabel{{ $data->id }}">Image Preview</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body text-center">
                                          <img src="{{ asset('Gallery/' . $data->image) }}" alt="Full Image"
                                              class="img-fluid rounded"
                                              style="max-height: 90vh; width: auto;">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <td><button class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal"  data-id="{{ $data->id }}">Delete</a></button></td>
                            </tr>
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete this Image?
                              </div>
                              <div class="modal-footer">
                                <form id="deleteForm" action = "{{ url('image_delete/'. $data->id)}} method="POST">
                                  @csrf
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-danger">Yes, Delete</button>
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