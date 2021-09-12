<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link" id="dashboard-menu">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('booking.index') }}" class="nav-link" id="booking-menu">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Pemesanan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('customer.index') }}" class="nav-link" id="customer-menu">
                <i class="nav-icon fas fa-users"></i>
                <p>Pelanggan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('room.index') }}" class="nav-link" id="room-menu">
                <i class="nav-icon fas fa-th"></i>
                <p>Ruangan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link" id="user-menu">
                <i class="nav-icon fas fa-user"></i>
                <p>Pengguna</p>
            </a>
        </li>
    </ul>
</nav>
