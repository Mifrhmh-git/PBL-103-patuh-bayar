<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
        <a href="{{ url('layout/home') }}" class="nav-link {{ Request::is('layout/home') ? 'bg-success text-white' : '' }}">
          <i class="nav-icon fas fa-home text-white"></i>
          <p class="text-white">
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('Wargas') }}" class="nav-link {{ Request::is('Wargas') ? 'bg-success text-white' : '' }}">
          <i class="nav-icon fas fa-users text-white"></i>
          <p class="text-white">
            Data Warga
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('Pembayarans') }}" class="nav-link {{ Request::is('Pembayarans') ? 'bg-success text-white' : '' }}">
          <i class="nav-icon fas fa-address-book text-white"></i>
          <p class="text-white">
            Data Pembayaran
          </p>
        </a>
      </li>

    </ul>
</nav>
