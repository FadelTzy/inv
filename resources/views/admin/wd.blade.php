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
                                    <div class="profile-widget-item-label">Total Deposit</div>
                                    <div class="profile-widget-item-value" id="totaldeposit"></div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Total Withdraw</div>
                                    <div class="profile-widget-item-value" id="totalinvestasi"></div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Total Bonus</div>
                                    <div class="profile-widget-item-value" id="totalbonus"></div>
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
                                <h4>Withdraw Investasi</h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <a type="button" href="{{ url('saldo-user') }}" class="btn btn-secondary">Kembali</a>

                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">No</th>
                                            <th>Jumlah Investasi</th>
                                            <th>Deposit</th>
                                            <th>Tipe Investasi</th>
                                            <th>Estimasi Pendapatan</th>
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

    <div class="modal fade" tabindex="-4" style="z-index: 999999" role="dialog" id="modalDepo">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Withdraw</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="datadeposit" method="POST">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" id="sisanya">
                            <input type="hidden" name="id_user" id="id_useru">
                            <input type="hidden" name="id_investasi" id="id_investasiu">
                            <input type="hidden" name="jml_wd" id="jml_wd">
                            <input type="hidden" name="jml_estimasi" id="jml_estimasi">
                            <input type="hidden" name="jml_bonus" id="jml_bonus">

                            <div class="form-group">
                                <label for="invest">Jumlah Investasi</label>
                                <div class="input-group">
                                    <input type="text" disabled id="invest" placeholder="Input Deposit"
                                        class="form-control ">
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="depos">Jumlah Deposit</label>
                                        <div class="input-group">
                                            <input tmype="text" disabled id="depos" placeholder="Input Deposit"
                                                class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="depos">Jumlah WD</label>
                                        <div class="input-group">
                                            <input tmype="text" disabled id="wds" name="wd"
                                                placeholder="Input Deposit" class="form-control ">
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="depos">Bonus</label>
                                        <div class="input-group">
                                            <input tmype="text" disabled id="bonus" name="bonus"
                                                placeholder="Input Deposit" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="depos">Estimasi</label>
                                        <div class="input-group">
                                            <input tmype="text" disabled id="estimasis" name="estimasi"
                                                placeholder="Input Deposit" class="form-control ">
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <label for="jns_invest">Jenis Investasi</label>
                                <div class="input-group">
                                    <input type="text" disabled id="jns_invest" placeholder="Input Deposit"
                                        class="form-control ">
                                </div>
                                <br>
                                <div id="statusnyawd"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                    <button id="submitdepo" type="button" class="btn btn-primary">Withdraw</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" style="z-index: 9999" role="dialog" id="modalRiwayat">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Riwayat Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="float-left">
                        <h4>Pengajuan Investasi</h4>

                    </div>
                    <div class="float-right">
                        <div class="section-header-button">
                            <button data-toggle="modal" data-target="#modalDepo" class="btn btn-primary">Tambah
                                Deposit</button>
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
                                    <th>Status</th>
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
        jQuery(document).ready(function() {

            tabel = $("#dt").DataTable({
                "drawCallback": function(settings) {
                    var api = this.api();
                    console.log(api.rows()[0].length)
                    $("#pengajuannya").html(api.rows()[0].length)
                    // api.column( 4, {page:'current'} ).data().sum();
                    var n = api
                        .column(7)
                        .data()
                        .reduce(function(a, b) {
                            return parseInt(a) + parseInt(b);
                        }, 0);
                    var d = api
                        .column(8)
                        .data()
                        .reduce(function(a, b) {
                            return parseInt(a) + parseInt(b);
                        }, 0);
                    var b = api
                        .column(9)
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
                    $("#totalbonus").html(idr(b));

                    $("#totaldeposit").html(td);

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
                        targets: 6,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        visible: false,
                        targets: 7,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        visible: false,
                        targets: 8,
                        width: "20%",

                    },
                    {
                        orderable: false,
                        visible: false,
                        targets: 9,
                        width: "20%",

                    },
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: url + '/saldo-user/' + '{{ Request::segment(2) }}' + '/wd',
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'investnya',
                        data: 'investnya'
                    },
                    {
                        nama: 'deponya',
                        data: 'deponya'
                    },
                    {
                        nama: 'tipenya',
                        data: 'tipenya'
                    },
                    {
                        nama: 'estimasinya',
                        data: 'estimasinya'
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
                    },

                    {
                        name: 'databonus',
                        data: 'databonus',
                    }
                ],

            });



        });

        $("#submitdepo").on('click', function() {
            $("#datadeposit").trigger('submit');
        });


        $("#datadeposit").on('submit', function(id) {
            var sisa = $("#jml_wd").val();

            console.log(sisa, 'sisa')
            if (sisa <= 0) {
                iziToast.error({
                    message: 'Saldo deposit user masih Rp. 0',
                    position: 'topRight'
                });
                return false;
            } else {

                id.preventDefault();
                var data = $(this).serialize();
                $.LoadingOverlay("show");
                $.ajax({
                    url: '{{ route('wd.storewd') }}',
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
                            $("#datadeposit").trigger('reset')
                            iziToast.success({
                                title: 'Succes!',
                                message: 'Data tersimpan',
                                position: 'topRight'
                            });
                            $("#modalDepo").modal('hide');
                            tabel.ajax.reload();
                        }
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
            console.log(id);

            $('#modalDepo').modal('show');

            $("#invest").val(idr(id.jumlah_investasi));


            $("#depos").val(idr(id.total_depo));

            var wd = idr(id.total_depo);


            if (id.total_depo == 0 || id.total_depo == null) {
                var total_wd = idr(0);
                $("#jml_estimasi").val(0);

            } else {
                var total_wd = idr(parseInt(id.total_depo) + parseInt(id.o_tipe.persenan * 0.01 * id.total_depo));
                if (id.status == 1) {
                    $("#jml_estimasi").val(parseInt(id.total_depo));
                } else {

                    $("#jml_estimasi").val(parseInt(id.total_depo) + parseInt(id.o_tipe.persenan * 0.01 * id.total_depo));
                }
            }

            $("#jml_wd").val(id.total_depo);
            if (id.status == 1) {

                $("#wds").val(wd)
                $("#jml_bonus").val(0);
                $("#bonus").val(0)

            } else {
                $("#wds").val(total_wd)
                $("#jml_bonus").val(parseInt(id.o_tipe.persenan * 0.01 * id.total_depo));
                $("#bonus").val(parseInt(id.o_tipe.persenan * 0.01 * id.total_depo));


            }
            $("#estimasis").val(total_wd);
            $("#jns_invest").val(id.o_tipe.periodik + ' - ' + id.o_tipe.persenan + '%')
            $("#sisanya").val(sisa);
            if (id.jumlah_investasi == id.total_depo) {
                var st = `<h6 class="text-success">Investasi telah mencukupi untuk melakukan withdraw</h6>`
            } else {
                var st = `<h6 class="text-danger">Investasi belum Mencukupi untuk melakukan withdraw</h6>`
            }
            $("#statusnyawd").html(st)
            $("#id_investasiu").val(id.id);
            $("#id_useru").val(id.id_user);

        }

        function idr(id) {
            return new Intl.NumberFormat('en-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(id);
        }
    </script>
@endpush
