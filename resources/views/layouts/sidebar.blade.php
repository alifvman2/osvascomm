<style>
      #sidebar .nav-link.active {
            background-color: blue;
            color: white;
      } ;
</style>
<div class="sidebar" id="sidebar" style="background-color: rgba(255, 255, 255, 1);">
      <ul class="nav flex-column">
            <li class="nav-item mt-3">
                <a class="nav-link {{ request()->routeIs('Admin.index') ? 'active' : '' }}" href="{{ route('Admin.index') }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link {{ request()->routeIs('Admin.Users.*') ? 'active' : '' }}" href="{{ route('Admin.Users.index') }}">
                    <i class="fa-regular fa-user"></i>
                    <span class="sidebar-text">Manajemen User</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link {{ request()->routeIs('Admin.Product.*') ? 'active' : '' }}" href="{{ route('Admin.Product.index') }}">
                    <i class="fa-solid fa-book"></i>
                    <span class="sidebar-text">Manajemen Produk</span>
                </a>
            </li>
      </ul>
</div>