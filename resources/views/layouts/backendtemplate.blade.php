<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('admin_template/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('admin_template/vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{asset('admin_template/css/fontastic.css')}}">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('admin_template/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('admin_template/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('admin_template/img/favicon2.ico')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_template/DataTables/datatables.min.css')}}"/>
    <link href="{{asset('admin_template/css/select2.css')}}" rel="stylesheet">
    @yield('css')
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar bg-info">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span style="font-size: 25px;" class="font-weight-bold">HMS</span><span class="ml-2" style="font-size: 15px;">(Hospital Management System)</span></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                <!-- Notifications-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="far fa-bell"></i><span class="badge bg-red badge-corner">6</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Server Rebooted</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                          <div class="notification-time"><small>10 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all notifications                                            </strong></a></li>
                  </ul>
                </li>
                <!-- Messages                        -->
                <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fas fa-envelope"></i><span class="badge bg-orange badge-corner">6</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="{{asset('admin_template/img/avatar-1.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="{{asset('admin_template/img/avatar-2.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="{{asset('admin_template/img/avatar-3.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages</strong></a></li>
                  </ul>
                </li>
                <!-- Languages dropdown    -->
                {{-- <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="{{asset('admin_template/img/flags/16/GB.png')}}" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                  <ul aria-labelledby="languages" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="{{asset('admin_template/img/flags/16/DE.png')}}" alt="English" class="mr-2">German</a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="{{asset('admin_template/img/flags/16/FR.png')}}" alt="English" class="mr-2">French                                         </a></li>
                  </ul>
                </li> --}}
                <!-- Logout    -->
                <li class="nav-item"><a href="#" class="nav-link logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <span class="d-none d-sm-inline">Logout</span><i class="fas fa-sign-out-alt"></i></a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar">
              @hasrole('patient')<img src="{{asset('admin_template/img/avatar-7.jpg')}}" alt="..." class="img-fluid rounded-circle">@endhasrole
              @hasrole('physician')<img src="{{asset('admin_template/img/avatar-2.jpg')}}" alt="..." class="img-fluid rounded-circle">@endhasrole
              @hasrole('nurse')<img src="{{asset('admin_template/img/avatar-3.jpg')}}" alt="..." class="img-fluid rounded-circle">@endhasrole
              @hasrole('admin')<img src="{{asset('admin_template/img/avatar-11.jpg')}}" alt="..." class="img-fluid rounded-circle">@endhasrole
            </div>
            <div class="title">
              <h1 class="h4">{{Auth::user()->name}}</h1>
              <p>{{Str::ucfirst(Auth::user()->getRoleNames()->first())}}</p>
            </div>
          </div>
          {{-- <h1>{{Illuminate\Support\Str::of(request()->path())->basename()}}</h1> --}}
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">
            <li class="{{ request()->path() === 'admin' ? 'active' : '' }}"><a href="{{route('dashboard')}}"> <i class="icon-home"></i>Home</a></li>
            <li><a href="#exampledropdownDropdown0" aria-expanded="{{ collect(['nurses', 'physicians', 'patients'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? 'true' : 'false' }}" data-toggle="collapse" class="{{ collect(['nurses', 'physicians', 'patients'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? '' : 'collapsed' }}"> <i class="fas fa-users"></i>Users</a>
              <ul id="exampledropdownDropdown0" class="collapse list-unstyled {{ collect(['nurses', 'physicians', 'patients'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? 'show' : '' }}">
                <li class="{{ (request()->is('admin/nurses')) ? 'active' : '' }}"><a href="{{route('nurses.store')}}">Nurse</a></li>
                @hasanyrole('nurse|physician|admin')
                <li class="{{ (request()->is('admin/patients')) ? 'active' : '' }}"><a href="{{route('patients.store')}}">Patient</a></li>
                @endhasrole
                <li class="{{ (request()->is('admin/physicians')) ? 'active' : '' }}"><a href="{{route('physicians.store')}}">Physician</a></li>
              </ul>
            </li>
            @hasanyrole('physician|admin')
            <li><a href="#exampledropdownDropdown1" aria-expanded="{{ collect(['assignphysicians', 'assignprocedures'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? 'true' : 'false' }}" data-toggle="collapse" class="{{ collect(['assignphysicians', 'assignprocedures'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? '' : 'collapsed' }}"><i class="fas fa-user-md"></i>Physician Task</a>
              <ul id="exampledropdownDropdown1" class="collapse list-unstyled {{ collect(['assignphysicians', 'assignprocedures'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? 'show' : '' }}">
                <li class="{{ (request()->is('admin/assignphysicians')) ? 'active' : '' }}"><a href="{{route('assignphysicians.store')}}">Assign Department</a></li>
                <li class="{{ (request()->is('admin/assignprocedures')) ? 'active' : '' }}"><a href="{{route('assignprocedures.store')}}">Assign Procedure</a></li>
              </ul>
            </li>
            @endhasrole
            <li><a href="#exampledropdownDropdown2" aria-expanded="{{ collect(['appointments', 'medications', 'prescribes', 'procedures', 'assigndiseases'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? 'true' : 'false' }}" data-toggle="collapse" class="{{ collect(['appointments', 'medications', 'prescribes', 'procedures', 'assigndiseases'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? '' : 'collapsed' }}"><i class="fas fa-briefcase-medical"></i>Medical Treatment</a>
              <ul id="exampledropdownDropdown2" class="collapse list-unstyled {{ collect(['appointments', 'medications', 'prescribes', 'procedures', 'assigndiseases'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? 'show' : '' }}">
                <li class="{{ (request()->is('admin/appointments')) ? 'active' : '' }}"><a href="{{route('appointments.store')}}">Appointment</a></li>
                @hasanyrole('physician|patient')
                <li class="{{ (request()->is('admin/prescribes')) ? 'active' : '' }}"><a href="{{route('prescribes.store')}}">Prescribe</a></li>
                @endhasrole
                @hasanyrole('admin|physician|nurse')
                <li class="{{ (request()->is('admin/assigndiseases')) ? 'active' : '' }}"><a href="{{route('assigndiseases.store')}}">Patient Disease</a></li>
                @endhasrole 
                {{-- @hasrole('admin')
                <li class="{{ (request()->is('admin/procedures')) ? 'active' : '' }}"><a href="{{route('procedures.create')}}">Procedure</a></li>
                <li class="{{ (request()->is('admin/medications')) ? 'active' : '' }}"><a href="{{route('medications.create')}}">Medication</a></li>
                @endhasrole --}}
              </ul>
            </li>
            <li><a href="#exampledropdownDropdown3" aria-expanded="{{ collect(['departments', 'rooms', 'stays'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? 'true' : 'false' }}" data-toggle="collapse" class="{{ collect(['departments', 'rooms', 'stays'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? '' : 'collapsed' }}"><i class="fas fa-procedures"></i>Livelihood</a>
              <ul id="exampledropdownDropdown3" class="collapse list-unstyled {{ collect(['departments', 'rooms', 'stays'])->contains(Illuminate\Support\Str::of(request()->path())->basename()) ? 'show' : '' }}">
                {{-- @hasrole('admin')
                <li class="{{ (request()->is('admin/departments')) ? 'active' : '' }}"><a href="{{route('departments.create')}}">Department</a></li>
                <li class="{{ (request()->is('admin/rooms')) ? 'active' : '' }}"><a href="{{route('rooms.create')}}">Room</a></li>
                @endhasrole --}}
                <li class="{{ (request()->is('admin/stays')) ? 'active' : '' }}"><a href="{{route('stays.store')}}">Stay</a></li>
              </ul>
            </li>
            {{-- <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page </a></li> --}}
          </ul>
        </nav>
        <div class="content-inner">
          @yield('content')
        </div>
      </div>
    </div>
        @yield('appjs')
    <!-- JavaScript files-->
    <script src="{{asset('admin_template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admin_template/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admin_template/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin_template/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    @section('javascript')
      <script src="{{asset('admin_template/js/charts-home.js')}}"></script>
    @show
      <script src="{{asset('admin_template/js/front.js')}}"></script>
    <!-- Main File-->
  </body>
</html>