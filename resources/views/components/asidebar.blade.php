<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Investasi</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">Admin</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Menu</li>
        <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin') }}" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>

        <li class="menu-header">Manajemen Data</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Data User</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('investor.index') }}">Data Investor </a></li>
                <li><a class="nav-link" href="{{ route('admin.index') }}">Data Admin</a></li>
            </ul>
        </li>
        <li class="nav-item {{ Request::segment(1) == 'data-notif' ? 'active' : '' }}">
            <a href=" {{ route('notif.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                <span>Notifikasi</span></a>

        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Notif</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('notif.ps') }}">Notif PS</a></li>
                <li><a class="nav-link" href="{{ route('notif.depo') }}">Notif DePo</a></li>
                <li><a class="nav-link" href="{{ route('notif.pw') }}">Notif PW</a></li>
            </ul>
        </li>
        <li class="nav-item {{ Request::segment(1) == 'data-saldo' ? 'active' : '' }}">
            <a href=" {{ route('saldouser.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                <span>Saldo User</span></a>
        </li>
        {{-- <li class="nav-item {{ Request::segment(1) == 'saldo-admin' ? 'active' : '' }}">
            <a href=" {{ route('saldoadmin.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                <span>Saldo Admin</span></a>
        </li> --}}
        <li class="nav-item {{ Request::segment(1) == 'afiliasi' ? 'active' : '' }}">
            <a href=" {{ route('afiliasi') }}" class="nav-link"><i class="fas fa-columns"></i>
                <span>Affiliasi</span></a>
        </li>
        <li class="nav-item {{ Request::segment(1) == 'saldo-user' ? 'active' : '' }}">
            <a href=" {{ route('saldo.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                <span>Investasi</span></a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Data Master</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('jenisinvest.index') }}">Data Tipe Investasi </a></li>
                <li><a class="nav-link" href="{{ route('penerima.index') }}">Data Bank Penerima </a></li>
                <li><a class="nav-link" href="{{ route('redeem.index') }}">Data Redeem Code </a></li>


            </ul>
        </li>
        <li class="menu-header">Manajemen Admin</li>
        <li class="nav-item {{ Request::segment(1) == 'pengaturan' ? 'active' : '' }}">
            <a href=" {{ route('setitng.admin') }}" class="nav-link"><i class="fas fa-cog"></i>
                <span>Pengaturan</span></a>
        </li>
        <li class="nav-item {{ Request::segment(1) == 'informasi' ? 'active' : '' }}">
            <a href=" {{ route('informasi.admin') }}" class="nav-link"><i class="fas fa-cog"></i>
                <span>Informasi</span></a>
        </li>
        <li class="{{ Request::segment(1) == 'profil' ? 'active' : '' }}"><a class="nav-link"
                href="{{ url('profil') }}"><i class="fas fa-pencil-ruler"></i>
                <span>Profil Admin</span></a></li>


    </ul>

    <div class=" mb-4 p-3 hide-sidebar-mini">
        <a href="#" id="" onclick="logsout()" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Keluar
        </a>
        <form method="POST" id="flog" class="" action="{{ route('logout') }}">
            @csrf
        </form>
    </div>
</aside>
<script>
    function logsout() {
        var x = document.getElementById('flog');
        x.submit();
    }
</script>
