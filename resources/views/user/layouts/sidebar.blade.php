<div class="sidebar-nav slimscrollsidebar">
    <div class="sidebar-head">
        <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
    <div class="user-profile">
        <div class="dropdown user-pro-body">
            <div><img src="{{ asset('admin/plugins/images/users/defaultavatar.png') }}" alt="user-img" class="img-circle"></div>
            <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}<span class=""></span></a> 
        </div>
    </div>
    <ul class="nav" id="side-menu" style="font-size: large;">
        <li> 
            <a href="{{ route('home') }}" class="waves-effect active"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        @can('products.products', Auth::user())
        <li> 
            <a href="{{ route('product.index') }}" class="waves-effect"><i class="fa fa-cart-plus"></i> Products</a>
        </li>
        @endcan
        @can('products.pos', Auth::user())
        <li> 
            <a href="{{ route('pos') }}" class="waves-effect"><i class="fa fa-credit-card-alt"></i> POS</a>
        </li>
        @endcan
        @can('products.sales', Auth::user())
        <li> 
            <a href="{{ route('sale.index') }}" class="waves-effect"><i class="fa fa-money"></i> Sales</a>
        </li>
        @endcan
        @can('products.report', Auth::user())
        <li> 
            <a href="{{ route('salesreport') }}" class="waves-effect"><i class="fa fa-database"></i> Report</a>
        </li>
        @endcan
        @can('products.expenses', Auth::user())
        <li> 
            <a href="{{ route('expense.index') }}" class="waves-effect"><i class="fa fa-money"></i> Expenses</a>
        </li>
        @endcan
        @can('products.settings', Auth::user())
        <li>
            <a href="javascript:void(0);" class="waves-effect">
                <i class="fa fa-cog" data-icon="v"></i> <span class="hide-menu"> Settings<span class="fa arrow"></span> </span>
            </a>
            <ul class="nav nav-second-level">
                <li> 
                    <a href="{{ route('role.index') }}" class="waves-effect">Roles</a>
                </li>
                <li> 
                    <a href="{{ route('permission.index') }}" class="waves-effect">Permissions</a>
                </li>
                <li> 
                    <a href="{{ route('user.index') }}" class="waves-effect">Users</a>
                </li>
            </ul>
        </li>
        @endcan
        <li> 
            <a href="{{ route('logout') }}" class="waves-effect"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</div>