<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title')|E-gestion</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ 'vendors/css/vendor.bundle.base.css' }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>
    <div class="container-scroller">
        <!-- .navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper align-items-center">
                <a class="navbar-brand brand-logo" href="{{route("homeUser",['nom' =>Auth::user()->nom] )}}"><img src="{{ asset('images/logo.png')}}"alt="logo" /></a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-sort-variant"></span>
                </button>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                </br></br></br></br>
                    <li class="nav-item nav-search d-none d-sm-block">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="search">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="search" aria-label="search"
                                aria-describedby="search" id="myInput">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item count-indicator na">
                        @if (Auth::user()->nom)
                        <a class="nav-link" id="profileDropdown">
                            <span class="nav-profile-name">Salut, {{ Str::upper(Auth::user()->nom) }}</span>  
                        </a>
                    @endif 
                    </li>
                    {{-- panier --}}
                 
                     {{-- <li class="nav-item dropdown count-indicator arrow-none">
                        <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center"
                           href="" >
                            <span class="count bg-success"></span>
                            <i class="mdi mdi-cart-outline" style="font-size: 35px; "></i>
                        </a>
                    </li> --}}
                  
                    <li class="nav-item dropdown count-indicator arrow-none">
                        <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center"
                           href="" >
                            <span class="count bg-success">0</span>
                            <i class="mdi mdi-cart-outline" style="font-size: 35px; "></i>
                        </a>
                    </li>

              
                </ul>
            </div>
        </nav>
        <!-- end .navbar -->
        <!-- sidebar .nav -->
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <div class="dropdown sidebar-profile-dropdown">
                    <a class="dropdown-toggle d-flex align-items-center justify-content-between" href="#"
                        data-toggle="dropdown" id="profileDropdown1">
                        <img src="{{asset('images/users/'.Auth::user()->photo)}}" alt="profile" class="sidebar-profile-icon" />
                        <div>                           
                            <div class="nav-profile-name">{{ Str::upper(Auth::user()->nom) }}</div>
                            <div class="nav-profile-designation"></div>
                        </div>           
                    </a>
                    <div class="dropdown-menu navbar-dropdown dropdown-menu-left" aria-labelledby="profileDropdown1">
                        <a class="dropdown-item" href="{{route('profile.edit')}}">
                            <i class="mdi mdi-account"></i>
                            Profil
                        </a>
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                <i class="mdi mdi-logout"></i>
                            Se deconnecter</button>
                        </form>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <div class="sidebar-title">Main</div>
                        <a class="nav-link" href="{{route("homeUser",['nom' =>Auth::user()->nom] )}}">
                            <i class="mdi mdi-cards-variant menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="sidebar-title">Web application</div>
                        <a class="nav-link" href="pages/apps/email.html">
                            <i class="mdi mdi-cart-outline menu-icon"></i>
                            <span class="menu-title">Ventes</span>
                        </a>
                    </li>
                </ul>
                <div class="designer-info">
                    Crée par: <a href="https://www.bootstrapdash.com/" target="_blank">Fatma</a>
                </div>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper p-0">
                    
                    {{-- contenu --}}
                      @yield('content')
                    {{-- end contenu --}}
                    <!-- content-wrapper ends -->

                    <!-- partial:partials/_footer.html -->
                    <footer class="footer"
                        style="position: fixed;background-color: #f8f8f8;padding: 20px; width: 100%; bottom: 0;text-align: center">
                        <div class="justify-content-center justify-content-sm-between">
                            <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019. All
                                rights
                                reserved.</span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
     <!-- base:js -->
     <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
     <!-- endinject -->
     <!-- Plugin js for this page-->
     <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
     <!-- End plugin js for this page-->
     <!-- inject:js -->
     <script src="{{asset('js/off-canvas.js')}}"></script>
     <script src="{{asset('js/hoverable-collapse.js')}}"></script>
     <script src="{{asset('js/template.js')}}"></script>
     <script src="{{asset('js/settings.js')}}"></script>
     <script src="{{asset('js/todolist.js')}}"></script>
     <!-- endinject -->
     <!-- plugin js for this page -->
     <!-- End plugin js for this page -->
     <!-- Custom js for this page-->
     <script src="{{asset('js/dashboard.js')}}"></script>
     <script src="{{asset('js/jquery.min.js')}}"></script>
     <script src="{{asset('js/filtre.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
     <!-- End custom js for this page-->
</body>
@yield('script')
</html>
