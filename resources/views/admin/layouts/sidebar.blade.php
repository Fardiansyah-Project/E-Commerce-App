<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ url('admin/dashboard') }}">
            <img src="{{ asset('assets/images/snikers2.png') }}" alt="logo" />
        </a>
        <a class="sidebar-brand brand-logo-mini w-100" href="{{ url('admin/dashboard') }}">
            <img src="{{ asset('assets/images/letter-s.png') }}" alt="logo" />
        </a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        {{-- <img class="img-xs rounded-circle " src="{{ asset('assets/images/faces/face15.jpg') }}"
                            alt=""> --}}
                        @if (!empty(auth()->user()->avatar))
                            <img src="{{ asset('storage/images/profile/' . auth()->user()->avatar) }}"
                                class="rounded-circle" alt="Avatar" width="40">
                        @else
                            <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . auth()->user()->name }}"
                                class="rounded-circle" alt="Avatar" width="40">
                        @endif
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">
                            {{ Auth::user()->name }}
                        </h5>
                        <span>{{ Auth::user()->role }}</span>
                    </div>
                </div>
                {{-- <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a> --}}
                {{-- <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div> --}}
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigasi</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-home-analytics"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ url('admin/products') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-package-variant-closed"></i>
                </span>
                <span class="menu-title">Produk</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link {{ request()->is('orders') ? 'active' : '' }}" data-toggle="collapse" href="#ui-basic"
                aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-email"></i>
                </span>
                <span class="menu-title">Data Pesanan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/orders/get-order') }}">Pesanan</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/orders/success') }}">Pesanan
                            Selesai</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/orders/history') }}">Riwayat
                            Pesanan</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Lainnya</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}"
                href="{{ url('admin/categories') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-package-variant-closed"></i>
                </span>
                <span class="menu-title">Kategori Produk</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" data-toggle="collapse" href="#users"
                aria-expanded="false" aria-controls="users">
                <span class="menu-icon">
                    <i class="mdi mdi-account-group"></i>
                </span>
                <span class="menu-title">Daftar Pengguna</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users/customers') }}">Customer</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users/admins') }}">Admin</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
