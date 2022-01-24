<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
{{--        <div class="sidebar-brand-icon">--}}
{{--            <img src="/images/testlo2.png" width="100px" height="50px">--}}
{{--        </div>--}}
        <div class="sidebar-brand-text mx-3">IPB Pay</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active':'' }}">
        <a class="nav-link" href="{{ action('AdminController@index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fas fa-fw fa-tachometer-alt" {{ Request::is('admin/dashboard') ? 'style=color:#FFCF1F;':'' }}></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Nav Item - Currency -->
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/members') ? 'active':'' }}" href="{{ route('admin.members.index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fas fa-fw fa-user" {{ Request::is('admin/members') ? 'style=color:#FFCF1F;':'' }}></i>
            <span>Member</span></a>
    </li>
    <li class="nav-item {{ Request::is('admin/kyc') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.kyc.index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fa fa-exchange-alt" {{ Request::is('admin/kyc') ? 'style=color:#FFCF1F;':'' }}></i>
            <span id="black-3">KYC / AML</span></a>
    </li>

    <!-- Nav Item - Currency -->
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/currencies') ? 'active':'' }}" href="{{ route('admin.currencies.index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fas fa-fw fa-coins" {{ Request::is('admin/currencies') ? 'style=color:#FFCF1F;':'' }}></i>
            <span>Currency</span></a>
    </li>

    <!-- Nav Item - Currency -->
    <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/withdraw*') ? 'active':'' }}" href="{{ route('admin.withdraw.index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fas fa-fw fa-money-bill" {{ Request::is('admin/withdraw*') ? 'style=color:#FFCF1F;':'' }}></i>
            <span>Withdraws</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-list"></i>
            <span>Transactions</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($currencies as $currency)
                    <a class="collapse-item" onclick="waitingDialog.show('@lang('pages.loading')');" href="{{ route('admin.transaction', ['currency' => $currency->symbol]) }}">{{ $currency->name }}</a>
                @endforeach
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.payment') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fas fa-fw fa fa-money-bill"></i>
            <span>Payment</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
