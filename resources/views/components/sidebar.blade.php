<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- <a href="#" class="brand-link text-center">
      <img src="{{ asset('assets/logos/logophil_circle.png') }}" alt="Cleanbreeze Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a> --}}

    <div class="sidebar">
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> --}}

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

{{-- <div class="sidebar bg-primary" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a class="text-light" href="{{ route('quotations.index') }}"><i class="fa fa-list"></i> <span>Quotations</span></a>
                </li>

                <li>
                    <a class="text-light" href="{{ route('quotations.create') }}"><i class="fa fa-cart-plus"></i> <span>Create Quotation</span></a>
                </li>

                <li>
                    <a class="text-light" href=""><i class="fa fa-user"></i> <span>Profile</span></a>
                </li>

                @if (auth()->user()->user_type_id == 1)
                    <li>
                        <a class="text-light" href="{{ route('accounts.index') }}"><i class="fa fa-id-badge"></i> <span>Accounts</span></a>
                    </li>

                    <li>
                        <a class="text-light" href="{{ route('products.index') }}"><i class="fa fa-cart-plus"></i> <span>Products</span></a>
                    </li>

                    <li>
                        <a class="text-light" href=""><i class="fa fa-file"></i> <span>Reports</span></a>
                    </li>
                @endif

                <li>
                    <a class="text-light" href=""><i class="fa fa-history"></i> <span>Activity Logs</span></a>
                </li>

                <li>
                    <a class="text-light" href="#" class="logout_user"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div> --}}