
<div class="d-flex align-items-stretch">
<nav id="sidebar">
        <div class="sidebar-header d-flex flex-column align-items-center py-3 border-bottom border-secondary">
            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center mb-2"
                style="width: 50px; height: 50px;">
                <span class="fw-bold fs-5">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
            </div>
            @if (Auth::user()->usertype == 'lister' and 'admin')
              <h6 class="mb-0 ms-1 fw-bold">{{ Auth::user()->name }}<i class="fa fa-check-circle ms-3" style="color: #4949FF;"></i></h6>
            @else
              <h6 class="mb-0 ms-1 fw-bold">{{ Auth::user()->name }}</i></h6>
            @endif
            <small class="text-muted">{{ ucfirst(Auth::user()->usertype) }}</small>
        </div>
        <ul class="list-unstyled">
        @if (Auth::User()->usertype == 'lister')
                <li><a href="{{url('/dashboard')}}"> <i class="bi bi-speedometer"></i>Overview </a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="bi bi-house"></i>Property</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('/create_listing')}}"><i class="bi bi-house-add"></i>Add</a></li>
                    <li><a href="{{url('/view_listing')}}"><i class="bi bi-house-gear"></i>View</a></li>
                    <li><a href="{{ url('/gallery_view') }}"><i class="bi bi-image"></i> Gallery</a></li>
                  </ul>
                </li>
                <li ><a href="#exampledropdownDropdown-book" aria-expanded="false" data-toggle="collapse"><i class="bi bi-book"></i>Booking</a>
                  <ul id="exampledropdownDropdown-book" class="collapse list-unstyled ">
                    <li><a href="{{url('/view_bookings')}}"><i class="bi bi-journal-text"></i>View Booking</a></li>
                    <li><a href="{{url('/view_complete')}}"><i class="bi bi-journal-check"></i>Completed</a></li>
                  </ul>
                </li>
                <li><a href="#exampledropdownDropdown-message" aria-expanded="false" data-toggle="collapse"><i class="bi bi-chat-left-text"></i></i>Messages</a>
                  <ul id="exampledropdownDropdown-message" class="collapse list-unstyled ">
                    <li><a href="{{url('messages')}}"><i class="bi bi-envelope-open"></i>Messages</a></li>
                  </ul>
                </li>
                @elseif (Auth::User()->usertype == 'admin')
                <li><a href="{{url('/dashboard')}}"> <i class="bi bi-speedometer"></i>Overview </a></li>
                <li><a href="{{url('/users')}}"> <i class="bi bi-person"></i>Users</a></li>
                @else
                <li><a href="{{url('/dashboard')}}"> <i class="bi bi-speedometer"></i>Overview </a></li>
                <li ><a href="#exampledropdownDropdown-lister" aria-expanded="false" data-toggle="collapse"><i class="bi bi-patch-check"></i>Apply as Lister</a>
                  <ul id="exampledropdownDropdown-lister" class="collapse list-unstyled ">
                    <li><a href="{{url('apply')}}"><i class="bi bi-envelope-open"></i>Application</a></li>
                    <li><a href="{{url('application_update')}}"><i class="bi bi-envelope-open"></i>Status</a></li>
                  </ul>
                </li>        
              @endif
        </ul>
     </nav>
</div>