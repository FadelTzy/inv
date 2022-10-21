@extends('ab')

@section('css')
    <!-- CSS Libraries -->
    <!-- CSS Libraries -->
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/izitoast/css/iziToast.min.css') }}">

    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/prism/prism.css') }}">
@endsection

@section('title')
    Data Admin
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Saldo User - Data Investasi
            </h1>
        </div>
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Pengajuan Investasi</div>
                                    <div class="profile-widget-item-value" id="pengajuannya">.</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Total Saldo</div>
                                    <div class="profile-widget-item-value" id="totaldeposit">@money($user->oDatasaldo->saldo_active, 'IDR', true)</div>
                                    <div class="profile-widget-item-value d-none" id="totaldeposit2">
                                        {{ $user->oDatasaldo->saldo_active }}</div>

                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Total Investasi</div>
                                    <div class="profile-widget-item-value" id="totalinvestasi"></div>
                                </div>

                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ $user->nama }} <div
                                    class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div>
                                    @if ($user->role == 3)
                                        Investor
                                    @else
                                        Peminjam
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-left">
                                <h4>Pengajuan Investasi </h4>
                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <a type="button" href="{{ url('saldo-user/' . Request::segment(2) . '/export') }}"
                                        class="btn btn-success">Export Data</a>
                                    <a type="button" href="{{ url('saldo-user') }}" class="btn btn-secondary">Kembali</a>
                                    <button data-toggle="modal" data-target="#exampleModal" href="features-post-create.html"
                                        class="btn btn-primary">Pengajuan</button>
                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">No</th>
                                            <th>Jumlah Investasi</th>
                                            <th>Paket</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Investasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="datapengajuan" method="POST">

                        @csrf
                        <input type="hidden" name="id" value="{{ Request::segment(2) }}">
                        <div class="form-group">
                            <div class="control-label">Pembayaran</div>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" id="changejenis" name="jenis" checked value="1"
                                    class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description" id="labeljenis"> Saldo Dompet</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="Nama">Jumlah Saldo</label>
                            <div class="input-group">
                                <input type="hidden" id="jd" name="jd"
                                    value="{{ $user->oDatasaldo->saldo_active }}" readonly placeholder="Input Investasi"
                                    class="form-control">
                                <input type="text" value="@money($user->oDatasaldo->saldo_active, 'IDR', 'false')" readonly placeholder="Input Investasi"
                                    class="form-control">
                            </div>
                            <br>
                            <label for="Nama">Jenis Investasi</label>
                            <div class="input-group">
                                <select class="form-control" required name="tipe" id="tipeinvests">
                                    <option selected disabled>Pilih Jenis Investasi</option>
                                    @foreach ($tipe as $item)
                                        <option data-i="{{ $item }}" value="{{ $item->id }}">
                                            {{ $item->paket }} - Investasi :@money($item->investasi, 'IDR', 'false'), Bunga
                                            :{{ $item->persenanhari }} % / Hari, Jangka Waktu : {{ $item->lamapenarikan }}
                                            hari </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <label for="Nama">Jumlah Investasi</label>
                            <div class="input-group">
                                <input type="text" id="jumlahinvestasi" name="investasi" readonly
                                    placeholder="Input Investasi" class="form-control">
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Nama">Bunga / Hari (%)</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="bungaperhari" name="bungaperhari" required
                                                placeholder="Input Investasi" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Nama">Rupiah Bunga / Hari</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="rupiahbunga" name="rupiahbunga" required
                                                placeholder="Pilih Jenis Investasi" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Nama">Jangka Waktu Penarikan Bunga</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="jwpb" name="jwpb" required
                                                placeholder="Input Investasi" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Nama">Jangka Waktu Investasi</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="jwi" name="jwi" required
                                                placeholder="Pilih Jenis Investasi" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="Nama">Total Keuntungan</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="tk" name="tk" required
                                                placeholder="Pilih Jenis Investasi" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <label for="Nama">Total Pembayaran</label>
                            <div class="input-group">
                                <input type="hidden" name="tp2" id="tp2">
                                <input type="text" readonly id="tp" name="tp" required
                                    placeholder="Pilih Jenis Investasi" class="form-control">
                            </div>

                        </div>



                        {{-- <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right "></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button id="datasubmit" type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="up">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="datapengajuanu" method="POST">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" name="id" id="idu">
                            <div class="form-group">
                                <label for="Nama">Jumlah Investasi</label>
                                <div class="input-group">

                                    <input type="number" id="investasiu" name="investasi" required
                                        placeholder="Input Investasi" class="form-control">
                                </div>


                                <br>
                                <label for="Nama">Jenis Investasi</label>

                                <div class="input-group">
                                    <select class="form-control" required name="tipe" id="tipeu">
                                        <option selected disabled>Pilih Jenis Investasi</option>
                                        @foreach ($tipe as $item)
                                            <option value="{{ $item->id }}">{{ $item->periodik }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>

                            </div>


                            {{-- <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right "></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div> --}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="datasubmitu" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-4" style="z-index: 999999" role="dialog" id="modalTagihan">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formtagihan" method="POST">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" id="id_pengajuan" name="id_pengajuan">
                            <label for="Nama">Tagihan</label>
                            <div class="input-group">
                                <input type="text" readonly name="tagihan" id="tagihan" required
                                    placeholder="Input " class="form-control">
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Rekening Pengirim</label>
                                        <div class="input-group">
                                            <input type="number" value="{{ $user->oKtp->rekening }}" required
                                                id="rekeningpengirim" name="rekeningpengirim" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Bank Pengirim</label>
                                        <div class="input-group">
                                            <input type="text" required value="{{ $user->oKtp->bank }}"
                                                id="bankpengirim" name="bankpengirim" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label for="Nama">Pilihan Rekening Penerima</label>
                            <div class="input-group">
                                <select name="rekpe" class="form-control" id="rekeningpenerima">
                                    <option disabled selected>Pilih Rekening</option>
                                    @foreach ($bp as $item)
                                        <option data-p="{{ $item }}" value="{{ $item->id }}">
                                            {{ $item->nama }} - {{ $item->bank }} - {{ $item->rekening }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Rekening Penerima</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="rekeningp" placeholder="Input Deposit"
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Bank Penerima</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="bankp" placeholder="Input Deposit"
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label for="Nama">Bukti Transfer</label>
                            <div class="input-group">
                                <input type="file" readonly name="file" required placeholder="Input "
                                    class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                    <button id="btntagihan" type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-4" style="z-index: 999999" role="dialog" id="modalBukti">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="" method="POST">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" id="bukti_id_pengajuan" name="id_pengajuan">
                            <label for="Nama">Tagihan</label>
                            <div class="input-group">
                                <input type="text" readonly name="tagihan" id="bukti" required
                                    placeholder="Input " class="form-control">
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Rekening Pengirim</label>
                                        <div class="input-group">
                                            <input type="number" value="{{ $user->oKtp->rekening }}" required
                                                id="rekeningpengirim" name="rekeningpengirim" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Bank Pengirim</label>
                                        <div class="input-group">
                                            <input type="text" required value="{{ $user->oKtp->bank }}"
                                                id="bankpengirim" name="bankpengirim" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="depos">Nama Penerima</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="buktinamap" placeholder="Input Deposit"
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="depos">Rekening Penerima</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="buktirekeningp"
                                                placeholder="Input Deposit" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="depos">Bank Penerima</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="buktibankp" placeholder="Input Deposit"
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group" id="btnbuktitf">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Tanggal Pembayaran</label>
                                        <div class="input-group">
                                            <input type="text" id="tanggalbayar" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br" id="btnverif">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-4" style="z-index: 999999" role="dialog" id="modalDepo">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="datadeposit" method="POST">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" name="status" id="statusu" value="1">
                            <input type="hidden" id="sisanya">
                            <input type="hidden" name="id_user" id="id_useru">
                            <input type="hidden" name="id_investasi" id="id_investasiu">
                            <input type="hidden" name="sisasaldo" value="{{ $user->oDatasaldo->saldo_active }}"
                                id="sisasaldo">
                            <label for="Nama">Saldo</label>
                            <div class="input-group">
                                <input type="text" name="saldo" id="sisasaldoo" value="@money($user->oDatasaldo->saldo_active, 'IDR', true)" required
                                    placeholder="Input " class="form-control">
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="depos">Jumlah Deposit</label>
                                <div class="input-group">
                                    <input type="number" required id="depos" name="deposit"
                                        placeholder="Input Deposit" class="form-control ">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                    <button id="submitdepo" type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" style="z-index: 9999" role="dialog" id="modalRiwayat">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Riwayat Penarikan Bunga Perhari</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="float-left">
                        <h4>Riwayat Penarikan Bunga Perhari </h4>

                    </div>
                    <div class="float-right">
                        <div class="section-header-button">
                            <button data-toggle="modal" data-target="#modalDepo" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                    <div class="clearfix mb-3"></div>

                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-striped" id="tabelRiwayat">
                            <thead>
                                <tr>
                                    <th class="text-center pt-2">No</th>
                                    <th>Jumlah Deposit</th>
                                    <th>Tanggal Deposit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" style="z-index: 9999" role="dialog" id="modalRiwayatpenarikan">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Riwayat Penarikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="float-left">
                        <h4>Riwayat Penarikan Bunga Perhari </h4>

                    </div>
                    <div class="float-right">
                        <div class="section-header-button">
                            <button data-toggle="modal" data-target="#modalDepo" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                    <div class="clearfix mb-3"></div>

                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-striped" id="tabelRiwayatpenarikan">
                            <thead>
                                <tr>
                                    <th class="text-center pt-2">No</th>
                                    <th>Jumlah Penarikan</th>
                                    <th>Tanggal Penarikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <!-- JS Libraies -->
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js ">
    </script>
    <script src="{{ asset('stisla/assets/modules/prism/prism.js') }}"></script>
    <!-- Page Specific JS File -->
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('stisla/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/izitoast/js/iziToast.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var tabel;
        var tabelriwayat;
        var url = window.location.origin;
        $("#changejenis").on('change', function(id) {
            let data = $(this).val();
            if ($(this).is(':checked')) {
                $("#labeljenis").html('Saldo Dompet')
            } else {
                $("#labeljenis").html('Transfer')

            }
        })
        jQuery(document).ready(function() {
            tabel = $("#dt").DataTable({
                "drawCallback": function(settings) {
                    var api = this.api();
                    console.log(api.rows()[0].length)
                    $("#pengajuannya").html(api.rows()[0].length)
                    // api.column( 4, {page:'current'} ).data().sum();
                    var n = api
                        .column(6)
                        .data()
                        .reduce(function(a, b) {
                            return parseInt(a) + parseInt(b);
                        }, 0);
                    var d = api
                        .column(7)
                        .data()
                        .reduce(function(a, b) {
                            return parseInt(a) + parseInt(b);
                        }, 0);
                    var ti = new Intl.NumberFormat('en-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(n);
                    var td = new Intl.NumberFormat('en-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(d);
                    $("#totalinvestasi").html(ti);
                    // $("#totaldeposit").html(td);

                    console.log(n)
                },
                columnDefs: [{
                        targets: 0,
                        width: "1%",
                    },
                    {
                        targets: 1,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        targets: 2,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 3,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 4,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 5,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        visible: false,
                        targets: 6,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        visible: false,
                        targets: 7,
                        width: "20%",

                    },

                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: url + '/saldo-user/' + '{{ Request::segment(2) }}',
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'investnya',
                        data: 'investnya'
                    },
                    {
                        nama: 'namanya',
                        data: 'namanya'
                    },
                    {
                        nama: 'tanggalnya',
                        data: 'tanggalnya'
                    },
                    {
                        nama: 'statusnya',
                        data: 'statusnya'
                    },

                    {
                        name: 'aksi',
                        data: 'aksi',
                    },

                    {
                        name: 'datainves',
                        data: 'datainves',
                    },

                    {
                        name: 'datadepo',
                        data: 'datadepo',
                    }
                ],

            });



        });
        $("#btntagihan").on('click', function() {
            $("#btntagihan").prop('disabled', true);
            $("#formtagihan").trigger('submit');
        });
        $("#formtagihan").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('pengajuan.tagihan') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");
                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div><ul>';
                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        iziToast.error({
                            title: 'Error',
                            message: elem,
                            position: 'topRight'
                        });

                    } else {
                        $("#datapengajuan").trigger('reset')
                        iziToast.success({
                            title: 'Succes!',
                            message: 'Data tersimpan',
                            position: 'topRight'
                        });
                        $("#modalTagihan").modal('hide');
                        tabel.ajax.reload();

                    }
                    $('#btntagihan').prop('disabled', false);
                }
            })


        });
        $("#datasubmit").on('click', function() {
            $("#datapengajuan").trigger('submit');
        });
        $("#datasubmitu").on('click', function() {
            $("#datapengajuanu").trigger('submit');
        });
        $("#submitdepo").on('click', function() {
            $("#datadeposit").trigger('submit');
        });
        $("#datapengajuan").on('submit', function(id) {
            var c = $("#totaldeposit2").html();
            var invest = $("#tp2").val();
            console.log(c, invest);
            if (parseInt(c) > parseInt(invest)) {

                id.preventDefault();
                var data = $(this).serialize();
                $.LoadingOverlay("show");
                $.ajax({
                    url: '{{ route('pengajuan.store') }}',
                    data: new FormData(this),
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function(id) {
                        console.log(id);
                        $.LoadingOverlay("hide");
                        if (id.status == 'error') {
                            var data = id.data;
                            var elem;
                            var result = Object.keys(data).map((key) => [data[key]]);
                            elem =
                                '<div><ul>';
                            result.forEach(function(data) {
                                elem += '<li>' + data[0][0] + '</li>';
                            });
                            elem += '</ul></div>';
                            iziToast.error({
                                title: 'Error',
                                message: elem,
                                position: 'topRight'
                            });

                        }
                        if (id.status == 'success') {
                            $("#datapengajuan").trigger('reset')
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            $("#exampleModal").modal('hide');
                            tabel.ajax.reload();
                            location.reload();

                        }
                        if (id.status == 'galat') {
                            $("#datapengajuan").trigger('reset')
                            iziToast.warning({
                                title: 'Warning!',
                                message: 'Melebihi batas pembelian saham',
                                position: 'topRight'
                            });
                            $("#exampleModal").modal('hide');
                        }
                        if (id.status == 'limit') {
                            $("#datapengajuan").trigger('reset')
                            iziToast.info({
                                title: 'info!',
                                message: 'Saham Telah Habis',
                                position: 'topRight'
                            });
                            $("#exampleModal").modal('hide');
                        }
                    }
                })
            } else {
                alert('Saldo Tidak Cukup');
                return false;
            }




        });
        $("#datapengajuanu").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('pengajuan.edit') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");
                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div><ul>';

                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        iziToast.error({
                            title: 'Error',
                            message: elem,
                            position: 'topRight'
                        });

                    } else {
                        iziToast.success({
                            title: 'Succes!',
                            message: 'Data tersimpan',
                            position: 'topRight'
                        });
                        $("#up").modal('hide');
                        tabel.ajax.reload();

                    }
                }
            })


        });
        $("#datadeposit").on('submit', function(id) {
            var sisa = parseInt($("#sisasaldo").val());
            var aju = parseInt($("#depos").val());
            if (sisa < aju) {
                iziToast.error({
                    title: 'Gagal Depo!',
                    message: 'Melebihi Sisa Saldo',
                    position: 'topRight'
                });
                return false;
            } else {
                id.preventDefault();
                var data = $(this).serialize();
                $.LoadingOverlay("show");
                $.ajax({
                    url: '{{ route('depo.store') }}',
                    data: new FormData(this),
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function(id) {
                        $.LoadingOverlay("hide");
                        if (id.status == 'error') {
                            var data = id.data;
                            var elem;
                            var result = Object.keys(data).map((key) => [data[key]]);
                            elem =
                                '<div><ul>';

                            result.forEach(function(data) {
                                elem += '<li>' + data[0][0] + '</li>';
                            });
                            elem += '</ul></div>';
                            iziToast.error({
                                title: 'Error',
                                message: elem,
                                position: 'topRight'
                            });

                        } else {
                            $("#datadeposit").trigger('reset')
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            $("#modalDepo").modal('hide');
                            var saldo = id.data.saldo_active;
                            $("#totaldeposit").html(idr(saldo));
                            $("#totaldeposit2").html(saldo);

                            $("#sisasaldo").val(saldo)
                            $("#sisasaldoo").val(idr(saldo))
                            console.log(saldo, 'ini');
                        }
                        tabel.ajax.reload();
                        tabelriwayat.ajax.reload();
                    }
                })
            }

        });

        function resetInvestasi(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");
                $.ajax({
                    url: url + '/saldo-user/pengajuan-investasi/' + id,
                    type: "delete",
                    success: function(e) {
                        $.LoadingOverlay("hide");
                        if (e == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            tabel.ajax.reload();

                        } else {
                            iziToast.warning({
                                title: 'Tidak bisa mereset!',
                                message: 'Status Investasi telah selesai',
                                position: 'topRight'
                            });
                            tabel.ajax.reload();
                        }
                    }
                })

            }
        }

        function deleteInvestasi(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");
                $.ajax({
                    url: url + '/saldo-user/pengajuan-investasi/delete/' + id,
                    type: "delete",
                    success: function(e) {
                        $.LoadingOverlay("hide");
                        if (e == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            tabel.ajax.reload();

                        }
                    }
                })

            }
        }

        function staffaktif(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/admin/periode/' + id + '/aktif',
                    type: "post",
                    success: function(e) {
                        $.LoadingOverlay("hide");
                        if (e == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            tabel.ajax.reload();

                        }
                    }
                })

            }
        }

        function editInvestasi(id) {
            $('#up').modal('show');

            $("#tipeu").val(id.tipe_investasi);
            $("#investasiu").val(id.jumlah_investasi);
            $("#idu").val(id.id);
        }

        function depo(id, sisa) {
            $("#sisanya").val(sisa);
            $('#modalDepo').modal('show');
            $("#id_investasiu").val(id.id);
            $("#id_useru").val(id.id_user);
        }

        function tagihan(id) {
            $('#modalTagihan').modal('show');
            let tagihan = parseInt(id.biayaadmin) + parseInt(id.investasi);
            $("#tagihan").val(idr(tagihan));
            $("#id_pengajuan").val(id.id);
            console.log(id);
        }

        function verifikasi(id, kode) {

            console.log(id, kode);
            data = confirm("Approve Pengajuan Dengan Kode : " + kode);
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/saldo-user/verifikasi',
                    type: "post",
                    data: {
                        id: id,
                        kode: kode
                    },
                    success: function(e) {
                        console.log(e);
                        $("#modalBukti").modal('hide');
                        $.LoadingOverlay("hide");
                        if (e == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            tabel.ajax.reload();
                        }
                    }
                })

            }
        }

        function butkitf(id) {
            $('#modalBukti').modal('show');
            let tagihan = parseInt(id.biayaadmin) + parseInt(id.investasi);
            $("#bukti").val(idr(tagihan));
            $("#id_pengajuan").val(id.id);
            console.log(id);
            $("#buktirekeningp").val(id.o_penerima.rekening);
            $("#buktibankp").val(id.o_penerima.bank);
            $("#buktinamap").val(id.o_penerima.bank);
            $("#tanggalbayar").val(id.updated_at);
            let btn =
                `<a target='_blank' href='${url + '/img/bukti/' + id.buktitransfer }' class="btn btn-info btn-sm"> Bukti Pembayaran </a>`;

            let verif = `<button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>`;
            verif += `<button onclick='verifikasi("${id.id}","${id.kode}")' class="btn btn-dart">Approve</button>`;
            $("#btnverif").html(verif);
            $("#btnbuktitf").html(btn);
        }

        function riwayatpenarikan(id) {


            console.log(id);
            if ($.fn.DataTable.isDataTable("#tabelRiwayatpenarikan")) {
                $('#tabelRiwayatpenarikan').DataTable().clear().destroy();
            }

            $("#modalRiwayatpenarikan").modal('show')
            tabelriwayatpenarikan = $("#tabelRiwayatpenarikan").DataTable({

                columnDefs: [{
                        targets: 0,
                        width: "1%",
                    },
                    {
                        targets: 1,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        targets: 2,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 3,
                        width: "20%",

                    },



                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: url + '/riwayat-penarikan/' + id['id'],
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'deponya',
                        data: 'deponya'
                    },
                    {
                        nama: 'createdatnya',
                        data: 'createdatnya'
                    },

                    {
                        name: 'aksi',
                        data: 'aksi',
                    },


                ],

            });
        }

        function riwayat(id) {
            $("#id_useru").val(id.id_user);
            $("#id_investasiu").val(id.id);
            $("#statusu").val(2);
            $("#sisanya").val(parseInt(id.jumlah_investasi) - parseInt(id.total_depo));

            console.log(id);
            if ($.fn.DataTable.isDataTable("#tabelRiwayat")) {
                $('#tabelRiwayat').DataTable().clear().destroy();
            }

            $("#modalRiwayat").modal('show')
            tabelriwayat = $("#tabelRiwayat").DataTable({

                columnDefs: [{
                        targets: 0,
                        width: "1%",
                    },
                    {
                        targets: 1,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        targets: 2,
                        width: "20%",

                    },
                    {
                        orderable: false,

                        targets: 3,
                        width: "20%",

                    },



                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: url + '/riwayat-depo/' + id['id'],
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'deponya',
                        data: 'deponya'
                    },
                    {
                        nama: 'createdatnya',
                        data: 'createdatnya'
                    },



                    {
                        name: 'aksi',
                        data: 'aksi',
                    },


                ],

            });
        }

        function hapusDepo(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/riwayat-depo/' + id,
                    type: "delete",
                    success: function(e) {
                        console.log(e);
                        $.LoadingOverlay("hide");
                        if (e == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            tabel.ajax.reload();
                            tabelriwayat.ajax.reload();
                        }
                    }
                })

            }
        }

        function verifDepo(id) {
            data = confirm("Klik Ok Untuk Melanjutkan");
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/riwayat-depo/verif/' + id,
                    type: "post",
                    success: function(e) {
                        console.log(e.data);
                        $.LoadingOverlay("hide");
                        if (e.status == 'success') {
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            var saldo = e.data.saldo_active;
                            $("#totaldeposit").html(idr(saldo));
                            $("#totaldeposit2").html(saldo);

                            $("#sisasaldo").val(saldo)
                            $("#sisasaldoo").val(idr(saldo))
                            tabel.ajax.reload();
                            tabelriwayat.ajax.reload();
                        }
                    }
                })

            }
        }

        function idr(uang) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(uang);
        }

        function getrand() {
            return Math.floor(Math.random() * 90 + 10)
        }
        $("#tipeinvests").on('change', function(id) {
            var data = $(this).find(':selected').data('i')
            $("#bungaperhari").val(data.persenanhari + ' %')
            $("#rupiahbunga").val(idr(data.bungaperhari))
            $("#jwpb").val(data.lamapenarikanbunga + ' Hari')
            $("#jwi").val(data.lamapenarikan + ' Hari')
            $("#tk").val(idr(data.lamapenarikan * data.bungaperhari));
            let biayaadmin = parseInt(data.biayaadmin);
            $("#bar").val(data.persenadmin + ' % > ' + idr(biayaadmin))
            $("#hiddenadmin").val(biayaadmin);
            $("#tp").val(idr(parseInt(data.investasi)))
            $("#tp2").val(parseInt(data.investasi));

            $("#jumlahinvestasi").val(idr(data.investasi))


            console.log(data);

        })
        $("#rekeningpenerima").on('change', function(id) {
            var data = $(this).find(':selected').data('p')
            $("#rekeningp").val(data.rekening);
            $("#bankp").val(data.bank);
            console.log(data);
        })
    </script>
@endpush
