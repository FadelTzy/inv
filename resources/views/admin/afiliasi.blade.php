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
    Data Investasi
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Investasi User
            </h1>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="float-left">
                                <h4>Data Afiliasi User</h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">

                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">No</th>
                                            <th>Nama</th>
                                            <th>Jumlah Afiliasi</th>
                                            <th>Bonus Referal</th>
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
        var url = window.location.origin;
        jQuery(document).ready(function() {

            tabel = $("#dt").DataTable({
                "drawCallback": function(settings) {
                    var api = this.api();

                    $(".lihatpertama").trigger('click')
                    $(".lihatakunkedua").trigger('click')
                    $(".lihatakunketiga").trigger('click')
             
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


                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('afiliasi') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'nama',
                        data: 'nama'
                    },
                    {
                        nama: 'jumlahnya',
                        data: 'jumlahnya'
                    },
                    {
                        nama: 'bonusnya',
                        data: 'bonusnya'
                    },

                    {
                        name: 'aksi',
                        data: 'aksi',
                    }
                ],

            });
            $('#dt tbody').on('click', '.lihatpertama', function() {
                var tr = $(this).closest('tr');
                var row = tabel.row(tr);
                if ($(tr).hasClass('ada')) {
                    $(tr).removeClass('ada');
                    console.log($(tr), 'tutup');
                    $(tr.nextUntil('[role="row"]')).remove();
                } else {
                    $(tr).addClass('ada');

                    $(tr).after(format(row.data()));
                    console.log($(tr.next()), 'next');
                }
            });
            $('#dt tbody').on('click', '.lihatakunkedua', function() {
                var tr = $(this).closest('tr');
                var row = tabel.row(tr);
                var datajson = tr[0]['attributes']['data-bab']['value']
                var datalast = tr[0]['attributes']['data-last']['value']
                var datapos = tr[0]['attributes']['data-pos']['value']
                // console.log(datapos, 'datapos');
                var jsonData = JSON.parse(datajson);
                if ($(tr).hasClass('ada')) {
                    $(tr).removeClass('ada');
                    var jsonId = 'dataro-' + (parseInt(datapos) + 1);
                    var lengthD = jsonData['akun_kedua'].length;
                    console.log(lengthD, 'panjang');
                    if (lengthD == 0) {
                        console.log(1)
                        $(tr.next()).remove();
                    } else {
                        if (datalast == 1) {
                            console.log(2)
                            // $(tr.nextUntil('[id="dataro- ' + 2 +'"]')).remove();
                            $(tr.nextUntil('[role="row"]')).remove();

                        } else {
                            console.log(3)
                            $(tr.nextUntil('[id="' + jsonId + '"]')).remove();
                        }


                    }

                } else {
                    $(tr).addClass('ada');

                    $(tr).after(formatsubdetail(jsonData));
                }
            });
            $('#dt tbody').on('click', '.lihatakunketiga', function() {
                var tr = $(this).closest('tr');
                var row = tabel.row(tr);
                var datajson = tr[0]['attributes']['data-bab']['value']
                var datalast = tr[0]['attributes']['data-last']['value']
                var datapos = tr[0]['attributes']['data-pos']['value']
                // console.log(datapos, 'datapos');
                var jsonData = JSON.parse(datajson);
                if ($(tr).hasClass('ada')) {
                    $(tr).removeClass('ada');
                    var jsonId = 'datarol-' + (parseInt(datapos) + 1);
                    var lengthD = jsonData['akun_ketiga'].length;
                    console.log(lengthD, 'panjang');
                    if (lengthD == 0) {
                        console.log(1)
                        $(tr.next()).remove();
                    } else {
                        if (datalast == 1) {
                            console.log(2)
                            // $(tr.nextUntil('[id="dataro- ' + 2 +'"]')).remove();
                            $(tr.nextUntil('[role="row"]')).remove();

                        } else {
                            console.log(3)
                            $(tr.nextUntil('[id="' + jsonId + '"]')).remove();
                        }


                    }

                } else {
                    $(tr).addClass('ada');

                    $(tr).after(formatsubsubdetail(jsonData));
                }
            });

        });
        //lihat pertama


        function format(d) {
            // `d` is the original data object for the row
            var datarow = '';
            console.log(d['akun_pertama']);
            var nokro = 1;
            console.log(d, 'disinidulu')
            var bd = 0;
            harganya = 0;

            d['akun_pertama'].forEach((id, key) => {
                var datarr = id;
                datarow += `<tr data-pos='${nokro}' id='dataro-${nokro}' data-last='${((d['akun_pertama'].length - 1) == key  ) ? "1" : "0"}' data-bab='${JSON.stringify(id)}' class='table-info table-sm' > 
                    <td class='pt-1 pb-1' colspan='1'> I </td>

                    <td class='pt-1 pb-1' colspan='1'>&nbsp&nbsp${id['nama_user']} </td>
                    <td class='pt-1 pb-1' colspan='1'><badge class='badge badge-warning'> ${id['akun_kedua'].length} </badge> </td>

                    <td class='pt-1 pb-1' colspan='1'> ${idr(id['harga'])} </td>

                    <td class='pt-1 pb-1'>   <ul class='list-inline mb-0'>
                 
              
                    <li class='list-inline-item'>
                        <button class='btn btn-sm btn-success   lihatakunkedua'> <i class='fa fa-arrow-down'>  </i> </button>
                    </li>
             
               
                </ul> </td>
                </tr>`;
                nokro++;
            });


            return datarow;
        }

        function formatsubdetail(d) {
            // console.log(d, 'formatsub');
            // `d` is the original data object for the row
            var datarow = '';
            var b = 0;
            var nokom = 1;
            console.log(d['akun_kedua'].length, 'Panjang');
            d['akun_kedua'].forEach((id, key) => {
                var datarr = id;
                datarow += `<tr data-pos='${nokom}' id='datarol-${nokom}' data-last='${((d['akun_kedua'].length - 1) == key  ) ? "1" : "0"}' data-bab='${JSON.stringify(id)}' class='table-warning table-sm' > 
                    <td class='pt-1 pb-1' colspan='1'> II  </td>

                    <td class='pt-1 pb-1' colspan='1'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp${id['nama_user']} </td>
                    <td class='pt-1 pb-1' colspan='1'><badge class='badge badge-info'> ${id['akun_ketiga'].length} </badge> </td>

                    <td class='pt-1 pb-1' colspan='1'> ${idr((id['harga'] / '{{0.01 * $set->level1}}') * 0.01 * '{{$set->level2}}' )} </td>

                    <td class='pt-1 pb-1'>   <ul class='list-inline mb-0'>
                 
              
                    <li class='list-inline-item'>
                        <button class='btn btn-sm btn-success   lihatakunketiga'> <i class='fa fa-arrow-down'>  </i> </button>
                    </li>
             
               
                </ul> </td>
                </tr>`;
                nokom++;
            });
            // $("#"+d['id_rab_akun']+'akun').html(idr(harganya))

            // console.log(harganya,'hargaaaa');

            return datarow;
        }
        function formatsubsubdetail(d) {
            // console.log(d, 'formatsub');
            // `d` is the original data object for the row
            var datarow = '';
            var b = 0;
            var nokom = 1;
            console.log(d['akun_ketiga'].length, 'Panjang');
            d['akun_ketiga'].forEach((id, key) => {
                var datarr = id;
                datarow += `<tr ' id='datarok-${nokom}' class='table-danger table-sm' > 
                    <td class='pt-1 pb-1' colspan='1'> III  </td>

                    <td class='pt-1 pb-1' colspan='1'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp${id['nama_user']} </td>
                    <td class='pt-1 pb-1' colspan='1'> </td>

                    <td class='pt-1 pb-1' colspan='1'> ${idr((id['harga'] / '{{0.01 * $set->level1}}') * 0.01 * '{{$set->level3}}' )} </td>

                    <td class='pt-1 pb-1'>   <ul class='list-inline mb-0'>
                 
              
                    <li class='list-inline-item'>
                        <button class='btn btn-sm btn-success  '> <i class='fa fa-arrow-down'>  </i> </button>
                    </li>
             
               
                </ul> </td>
                </tr>`;
                nokom++;
            });
            // $("#"+d['id_rab_akun']+'akun').html(idr(harganya))

            // console.log(harganya,'hargaaaa');

            return datarow;
        }
        $("#datasubmit").on('click', function() {
            $("#dataadmin").trigger('submit');
        });
        $("#datasubmitu").on('click', function() {
            $("#dataadminu").trigger('submit');
        });
        $("#dataadmin").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('admin.store') }}',
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
                        $("#dataadmin").trigger('reset')
                        iziToast.success({
                            title: 'Succes!',
                            message: 'Data tersimpan',
                            position: 'topRight'
                        });
                        $("#exampleModal").modal('hide');
                        tabel.ajax.reload();

                    }
                }
            })


        });
        $("#dataadminu").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('admin.update') }}',
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
                    url: url + '/admin/data-admin/' + id,
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

        function idr(uang) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(uang);
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

        function staffupd(id) {
            $('#up').modal('show');

            $("#namau").val(id.name);
            $("#alamatu").val(id.alamat);
            $("#emailu").val(id.email);
            $("#nipu").val(id.kode);
            $("#nomoru").val(id.no);

            $("#idu").val(id.id);



        }
        var eye = 1;
        $("#passeye").on('click', function() {
            if (eye == 1) {
                $("#passfield").attr('type', 'text');
                eye = 0;
            } else {
                $("#passfield").attr('type', 'password');
                eye = 1;
            }
        })
    </script>
@endpush
