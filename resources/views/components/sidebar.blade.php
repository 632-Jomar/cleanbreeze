<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('quotations.index') }}" class="brand-link">
        <img src="{{ asset('assets/logos/logophil_circle.png') }}" class="brand-image img-circle" style="opacity: .8">
        <p class="brand-text font-weight-light m-0">Clean<span class="text-info">breeze</span></p>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ setActive(['quotations.index', 'quotations.show']) }}" href="{{ route('quotations.index') }}">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Quotations</p>
                    </a>
                </li>

                @if (auth()->user()->user_type_id == 2)
                    <li class="nav-item">
                        <a class="nav-link {{ setActive('quotations.create') }}" href="{{ route('quotations.create') }}">
                            <i class="nav-icon fa fa-cart-plus"></i>
                            <p>Create Quotation</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ setActive('profile.index') }}" href="{{ route('profile.index') }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>

                @if (auth()->user()->user_type_id == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ setActive('accounts.index') }}" href="{{ route('accounts.index') }}">
                            <i class="nav-icon fa fa-id-badge"></i>
                            <p>Accounts</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="nav-icon fa fa-cart-plus"></i>
                            <p>Products</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ setActive('reports.index') }}" href="{{ route('reports.index') }}">
                            <i class="nav-icon fa fa-file"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ setActive('activity-logs.index') }}" href="{{ route('activity-logs.index') }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link logout_user" role="button">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>