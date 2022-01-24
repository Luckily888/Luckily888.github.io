<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-@lang('menu.flag')"> </span> @lang('menu.lang-switch')</a>
            <div class="dropdown-menu" aria-labelledby="dropdown09" style="background-color: gray;">
                @foreach(array_diff_key(config('app.locales'),[ App::getLocale()=>1 ]) as $key=>$name)
                    <a class="dropdown-item lang-select" href="javascript:;" data-lang="{{$key}}">
                        <span class="flag-icon flag-icon-{{ config('app.flags')[$key] }}"> </span>
                        {{$name}}
                    </a>
                @endforeach
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" onclick="updateNotification()" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" id="notification_number">{{ ($notification_num > 0) ? $notification_num.'+' : '' }}</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    FROM SYSTEM
                </h6>
                @if(sizeof($notifications) > 0)
                    @if($notification_num == 1)
                        <script>alertify.success('You have 1 new message.');</script>
                    @elseif($notification_num > 1)
                        <script>
                            alertify.success('You have {{ $notification_num }} new messages.');
                        </script>
                    @endif
                    @foreach($notifications as $notification)
                        <a href="{{ $notification->link }}" class="dropdown-item d-flex align-items-center" {{ ($notification->readed == 0) ? 'style=background-color:#ddeff9;':'' }}>
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{ $notification->created_at }}</div>
                                <span class="font-weight-bold">{{ $notification->detail }}</span>
                            </div>
                        </a>
                    @endforeach
                        <a class="dropdown-item text-center small text-gray-500">Show all.</a>
                @else
                    <p class="dropdown-item text-center small text-gray-500">Empty</p>
                @endif
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 text-gray-600 small">{{ Auth::user()->name }}</span>
{{--                <img class="img-profile rounded-circle" src="{{ Auth::user()->avatar }}">--}}
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{action('Backend\ProfileController@index')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    @lang('menu.profile')
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    @lang('menu.settings')
                </a>
                <a class="dropdown-item" href="#" onclick="setDarkMode();alertify.success('Change mode completed.');">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    @lang('menu.dark-mode')
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    @lang('menu.logout')
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>
