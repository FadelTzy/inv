<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
        </li>
    </ul>
    <div class="search-element">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        <div class="search-backdrop"></div>

    </div>
</form>
<ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
            class="nav-link notification-toggle nav-link-lg @if (count(Session::get('notifs')) == 0)
                
            @else beep @endif "><i class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Notifications {{count(Session::get('notifs'))}}
                <div class="float-right"> 
                </div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons">
                @foreach (Session::get('notifs') as $r => $item)
                    @if (substr($item['kode'], -2) == 'PW')
                        <a href="{{url('notif/pw')}}" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-primary text-white">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Pengajuan Withdraw - <b> @money($item['jumlah'], 'IDR', 'true') </b>
                                <div class="time text-primary">{{ $item['created_at'] }}</div>
                            </div>
                        </a>
                    @endif
                    @if (substr($item['kode'], -2) == 'PD')
                        <a href="{{url('notif/depo')}}" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-success text-white">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Pengajuan Deposit - <b> @money($item['jumlah'], 'IDR', 'true') </b>
                                <div class="time text-primary">{{ $item['created_at'] }}</div>
                            </div>
                        </a>
                    @endif
                    @if (substr($item['kode'], -2) == 'PI')
                        <a href="{{url('notif/ps')}}" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-warning text-white">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Pembelian Saham - <b> {{$item['nama']}} @money($item['investasi'], 'IDR', 'true') </b>
                                <div class="time text-primary">{{ $item['created_at'] }}</div>
                            </div>
                        </a>
                    @endif
                @endforeach


            </div>

        </div>
    </li>

    <li class="dropdown"><a href="#" data-toggle="dropdown"
            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->nama }}</div>
        </a>

    </li>
</ul>
