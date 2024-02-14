  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link border-0 mt-2">
      <img src="/assets/dist/img/Logo.png" alt="AdminLTE Logo" class="brand-image">
      <span class="brand-text font-weight-bold" style="color: #000000">Kapan Laundry</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-3">
      <!-- Sidebar user panel (optional) -->

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" style="background: #032030" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar" style="background: #032030">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                 <a href="/dashboard" class="nav-link {{ ($title === "Dashboard") ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @canany(['admin', 'kasir'])
          <li class="nav-header">Data Master</li>
          @endcanany

          @can('admin')
          <li class="nav-item">
            <a href="/outlet" class="nav-link {{ ($title === "Outlet") ? 'active' : '' }}">
              <i class="nav-icon fa-solid fa-shop"></i>
              <p>
                Outlet
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/paket" class="nav-link {{ ($title === "Paket") ? 'active' : '' }}">
              <i class="nav-icon fa-solid fa-cubes"></i>
              <p>
                Paket
              </p>
            </a>
          </li>
          @endcan

          @canany(['admin', 'kasir'])
          <li class="nav-item">
            <a href="/member" class="nav-link {{ ($title === "Member") ? 'active' : '' }}">
              <i class="nav-icon fa-solid fa-address-card"></i>
              <p>
                Member
              </p>
            </a>
          </li>
          @endcan
            
          @can('admin')
          <li class="nav-item">
            <a href="/user" class="nav-link {{ ($title === "User") ? 'active' : '' }}">
              <i class="nav-icon fa-solid fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>
          @endcan
          <li class="nav-header">Transaksi</li>
          @canany(['admin', 'kasir'])        
          <li class="nav-item">
            <a href="/transaksi" class="nav-link {{ ($title === "Transaksi") ? 'active' : '' }}">
              <i class="nav-icon fa-solid fa-hand-holding-dollar"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>
          @endcanany
          <li class="nav-item">
            <a href="/transaksi/laporan" class="nav-link {{ ($title === "Laporan") ? 'active' : '' }}">
              <i class="nav-icon fa-solid fa-money-check-dollar"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>