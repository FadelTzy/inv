@extends('ab')

@section('css')
@endsection

@section('title')
    Dashboard
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Dashboard
            </h1>
        </div>
        <div class="section-body">
            <div class="alert alert-info alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>

                <div class="alert-body">
                    <div class="alert-title">Selamat Datang Di Dashboard Admin </div>
                </div>


            </div>
        </div>
        <div class="section-body">
            <div class="alert alert-primary  alert-has-icon">
                <div class="alert-icon beep"><i class="fa fa-bullhorn"></i></div>
                @php
                    $text = '';
                @endphp
                @foreach (Session::get('notifs') as $r => $item)
                    @if (substr($item['kode'], -2) == 'PW')
                        @php
                            $text .= ' | ';
                            $text .= "<a href='" . url('notif/pw') . "'> <b> Pengajuan Withdraw : " . @money($item['jumlah'], 'IDR', 'true') . ' Oleh ' . $item['o_user']['nama'] . '</b> </a>';
                        @endphp
                    @endif
                    @if (substr($item['kode'], -2) == 'PD')
                        @php
                            $text .= ' | ';
                            $text .= "<a href='" . url('notif/depo') . "'> <b> Pengajuan Deposit : " . @money($item['jumlah'], 'IDR', 'true') . ' Oleh ' . $item['o_user']['nama'] . '</b> </a>';
                        @endphp
                        {{-- <a href="{{ url('notif/depo') }}" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-success text-white">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Pengajuan Deposit - <b> @money($item['jumlah'], 'IDR', 'true') </b>
                                <div class="time text-primary">{{ $item['created_at'] }}</div>
                            </div>
                        </a> --}}
                    @endif
                    @if (substr($item['kode'], -2) == 'PI')
                        @php
                            $text .= ' | ';
                            $text .= "<a href='" . url('notif/ps') . "'> <b> Pembelian Saham : " . @money($item['investasi'], 'IDR', 'true') . ' Paket : ' . $item['nama'] . '</b> </a>';
                            
                        @endphp
                        {{-- <a href="{{ url('notif/ps') }}" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-warning text-white">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Pembelian Saham - <b> {{ $item['nama'] }} @money($item['investasi'], 'IDR', 'true') </b>
                                <div class="time text-primary">{{ $item['created_at'] }}</div>
                            </div>
                        </a> --}}
                    @endif
                @endforeach
                <div class="alert-body">
                    <div class="alert-title">
                        <marquee behavior="scroll" direction="left" scrollamount="12">{!! $text !!} </marquee>
                    </div>
                </div>


            </div>
        </div>
        <section class="section">

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Investor</h4>
                            </div>
                            <div class="card-body">
                                {{ $investor }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4> Total Deposit</h4>
                            </div>
                            <div class="card-body">
                                @money($saldo, 'IDR', true)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Produk Investasi</h4>
                            </div>
                            <div class="card-body">
                                {{ $tipe }}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>User Admin</h4>
                            </div>
                            <div class="card-body">
                                {{ $admin }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
            <br>

        </section>
    </section>
@endsection


@push('js')
    <!-- Page Specific JS File -->
@endpush
