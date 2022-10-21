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
    Data Redeem Code
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Data Redeem Code
            </h1>
        </div>
        <div class="section-body">
          
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="float-left">
                                <h4>Riwayat Redeem</h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <a type="button" href="{{url('data-saldo')}}"
                                    class="btn btn-secondary">Kembali</a>
                                    <button data-toggle="modal" data-target="#exampleModal" href="features-post-create.html"
                                    class="btn btn-primary">Reedem</button>
                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">No</th>
                                            <th>Bonus</th>
                                            <th>Kode Redeem</th>
                                            <th>Tanggal</th>
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
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="datapengajuan" method="POST">

                        @csrf
                        <input type="hidden" name="id" value="{{ Request::segment(3) }}">
                        <div class="form-group">
                            <label for="Nama">Redeem Kode</label>
                            <div class="input-group">

                                <input type="text"  name="code" placeholder="Input Code"
                                    class="form-control">
                            </div>
                            <br>
                            <br>
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
        function idr(uang) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(uang);
        }
        var tabel;
        var tabelriwayat;
        var url = window.location.origin;
        jQuery(document).ready(function() {
            tabel = $("#dt").DataTable({
              
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
                   
                 
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: url + '/data-saldo/redeem-code/' + '{{ Request::segment(3) }}',
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'nominal',
                        data: function (d) {
                            return idr(d['nominal'])
                        }
                    },
                    {
                        nama: 'kode',
                        data: 'kode'
                    },
                    {
                        nama: 'created_at',
                        data: 'created_at'
                    },       
                    {
                        name: 'aksi',
                        data: 'aksi',
                    },
                 
                 
                ],

            });



        });
        function setdepo(e) {
            var c = e.value;
            console.log(idr(c));
           $("#rupiahofdeposit").val(idr(c)); 
        }
  
      
        $("#datasubmit").on('click', function() {
            $("#datapengajuan").trigger('submit');
        });
        $("#datapengajuan").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('redeemcode.store') }}',
                data: new FormData(this),
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    tabel.ajax.reload()
                    console.log(id);
                    $("#exampleModal").modal('hide');

                    $.LoadingOverlay("hide");
                    if (id.status == 'error') {
                        iziToast.error({
                            title: 'Error',
                            message: id.message,
                            position: 'topRight'
                        });
                    }
                    if (id.status == 'warning') {
                        iziToast.warning({
                            title: 'Warning',
                            message: id.message,
                            position: 'topRight'
                        });
                    }
                    if (id.status == 'success') {
                        iziToast.success({
                            title: 'Success',
                            message: id.message,
                            position: 'topRight'
                        });
                    }
                  
                }
            })


        });
        $("#datasubmitu").on('click', function() {
            $("#datapengajuanu").trigger('submit');
        });
        $("#submitdepo").on('click', function() {
            $("#datadeposit").trigger('submit');
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
            var sisa = $("#sisanya").val();
            var aju = $("#depos").val();
            if (sisa < aju) {
                iziToast.error({
                    title: 'Gagal Depo!',
                    message: 'Melebihi Sisa Investasi',
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
                      

                        }
                        tabel.ajax.reload();
                        tabelriwayat.ajax.reload();
                    }
                })
            }

        });

        function staffdel(id) {
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
                    url: url + '/data-saldo/redeem-code/' + id,
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
            $("#sisanya").val(sisa);
            $('#modalDepo').modal('show');
            $("#id_investasiu").val(id.id);
            $("#id_useru").val(id.id_user);

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
        $("#rekeningpenerima").on('change',function (id) {
            var data = $(this).find(':selected').data('p')
            $("#rekeningp").val(data.rekening);
            $("#bankp").val(data.bank);
            console.log(data);
        })  
    </script>
@endpush
