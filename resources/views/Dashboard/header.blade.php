<header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between border-bottom-shadow">
          <div class="navbar-header">
              <a href="{{url('/home')}}" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong style="color: #1E90FF;">Escapadia-</strong><strong>Dashboard</strong></div>
              <div class="brand-text brand-sm"><strong  style="color: #1E90FF;">E</strong><strong>D</strong></div></a>
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <div class="dropdown">
            <button class="btn btn-light rounded-pill px-4 py-2 shadow-sm" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }} <i class="bi bi-caret-down-fill"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 rounded-3" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item text-muted fw-semibold small" href="#" style="pointer-events: none;">Manage Account</a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item text-success py-2 px-3 rounded hover-bg" href="{{ route('profile.show') }}">Profile</a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item text-danger py-2 px-3 rounded hover-bg" type="submit">Log Out</button>
                </form>
              </li>
            </ul>
          </div>

          <style>
            .hover-bg:hover {
              background-color:rgba(82, 35, 35, 0.23);
            }
          </style>
        </div>
      </nav>
    </header>