<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ action('Backend\HomeController@index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
{{--        <div class="sidebar-brand-icon">--}}
{{--            <img src="/images/testlo2.png" width="100px" height="50px">--}}
{{--        </div>--}}
        <img src="{{ asset('landing/assets/images/backend/logo.png') }}" height="50px" width="50px">
        <div class="sidebar-brand-text mx-3" id="black-logo" align="left">IPB Pay</div>

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('home') ? 'active':'' }}">
        <a class="nav-link" href="{{ action('Backend\HomeController@index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #FFCF1F"></i>
            <span id="black-1">@lang('menu.dashboard')</span></a>
    </li>
    <li class="nav-item {{ Request::is('kyc') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('user.kyc.index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fa fa-exchange-alt" style="color: #FFCF1F"></i>
            <span id="black-3">@lang('menu.kyc')</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-list fa-cog" style="color: #FFCF1F"></i>
            <span id="black-2">@lang('menu.transactions')</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach($currencies as $currency)
                    <a class="collapse-item" onclick="waitingDialog.show('@lang('pages.loading')');" href="{{ route('transaction.search', $currency->symbol) }}">{{ $currency->name }}</a>
                @endforeach
            </div>
        </div>
    </li>
    <li class="nav-item {{ Request::is('transfers') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('user.transfers.index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fa fa-exchange-alt" style="color: #FFCF1F"></i>
            <span id="black-3">@lang('menu.digital-currency-transfer')</span></a>
    </li>
    <li class="nav-item {{ Request::is('exchanges') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('user.exchanges.index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fa fa-coins" style="color: #FFCF1F"></i>
            <span id="black-3">@lang('menu.exchange')</span></a>
    </li>
{{--    <li class="nav-item {{ Request::is('payments') ? 'active':'' }}">--}}
{{--        <a class="nav-link" href="{{ action('Backend\PaymentController@index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">--}}
{{--            <i class="fas fa-fw fa fa-money-bill" style="color: #FFCF1F"></i>--}}
{{--            <span id="black-3">@lang('menu.alt-payment')</span></a>--}}
{{--    </li>--}}
    <li class="nav-item {{ Request::is('histories') ? 'active':'' }}">
        <a class="nav-link" href="{{ action('Backend\HistoryController@index') }}" onclick="waitingDialog.show('@lang('pages.loading')');">
            <i class="fas fa-fw fa-file-alt" style="color: #FFCF1F"></i>
            <span id="black-4">@lang('menu.history')</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle" id="sidebarToggle"></button>
    </div>

    <img src="landing/assets/images/backend/sidebarBG.png" style="position : absolute; bottom: 0px;width: inherit">
</ul>
