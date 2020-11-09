<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo mr-5" href="{{ url('/') }}"><img src="{{ url('images/blue.png') }}" class="mr-2" alt="logo"/></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <h1>Allotments</h1>
    <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item">
            <h4 class="font-weight-bold">Hi, Jeff</h4>
        </li>
      <li class="nav-item nav-profile text-center">
        <a class="nav-link" href="#">
            <!-- TODO: Include a gravatar image here if available? -->
          <div class="lv-avatar">JM</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="ti-settings text-primary"></i>
            Settings
          </a>
          <a class="dropdown-item">
            <i class="ti-power-off text-primary"></i>
            Logout
          </a>
        </div>
      </li>
      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="ti-more"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="ti-layout-grid2"></span>
    </button>
  </div>
</nav>
<div>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-5 mb-4 mb-xl-0">
                    <h4 class="font-weight-bold">Hi, {name here}</h4>
                </div>
                <div class="col-12 col-xl-7">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="border-right pr-4 mb-3 mb-xl-0">
                            <p class="text-muted">Balance</p>
                            <h4 class="mb-0 font-weight-bold">$40079.60 M</h4>
                        </div>
                        <div class="border-right pr-4 mb-3 mb-xl-0">
                            <p class="text-muted">Today’s profit</p>
                            <h4 class="mb-0 font-weight-bold">$175.00 M</h4>
                        </div>
                        <div class="border-right pr-4 mb-3 mb-xl-0">
                            <p class="text-muted">Purchases</p>
                            <h4 class="mb-0 font-weight-bold">4006</h4>
                        </div>
                        <div class="pr-3 mb-3 mb-xl-0">
                            <p class="text-muted">Downloads</p>
                            <h4 class="mb-0 font-weight-bold">4006</h4>
                        </div>
                        <div class="mb-3 mb-xl-0">
                            <button class="btn btn-warning rounded-0 text-white">Downloads</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


