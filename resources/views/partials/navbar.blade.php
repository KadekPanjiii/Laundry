  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" style="color: #0056b3" data-widget="pushmenu" href="#" role="button"><i class="fas fa-align-left"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{ auth()->user()->role }} <i class="fas fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="/profile" class="dropdown-item">
            <i class="fas fa-user mr-1"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="/logout" class="dropdown-item text-danger">
            <i class="fas fa-sign-out-alt"></i> Keluar
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->