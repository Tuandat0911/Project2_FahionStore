<aside class="main-sidebar sidebar-light-green elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Shopping</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://t3.ftcdn.net/jpg/05/53/79/60/360_F_553796090_XHrE6R9jwmBJUMo9HKl41hyHJ5gqt9oz.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
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
                    <a href="{{ route('adminHome') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                @can('category_list')
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Categories
                            </p>
                        </a>
                    </li>
                @endcan

                @can('menu_list')
                    <li class="nav-item">
                        <a href="{{ route('menu.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                Menu
                            </p>
                        </a>
                    </li>
                @endcan

                @can('product_list')
                    <li class="nav-item">
                        <a href="{{ route('product.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>
                @endcan

                @can('slider_list')
                    <li class="nav-item">
                        <a href="{{ route('slider.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>
                                Sliders
                            </p>
                        </a>
                    </li>
                @endcan

                @can('setting_list')
                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Settings
                            </p>
                        </a>
                    </li>
                @endcan

                @can('user_list')
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                @endcan

                @can('role_list')
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-tag"></i>
                            <p>
                                Roles
                            </p>
                        </a>
                    </li>


                <li class="nav-item">
                    <a href="{{ route('permission.create')  }}" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            Permissions
                        </p>
                    </a>
                </li>
                @endcan

                @can('order_list')
                    <li class="nav-item">
                        <a href="{{ route('order.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Orders
                            </p>
                        </a>
                    </li>
                @endcan

                @can('inventory_list')
                    <li class="nav-item">
                        <a href="{{ route('inventory.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Inventory
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ route('login.logoutHandling') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
