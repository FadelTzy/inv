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
    Notif
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Notifikasi 
            </h1>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="float-left">
                                <h4>Notifikasi</h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <a  href="{{route('riwayatnotif.index')}}"
                                    class="btn btn-primary">Riwayat Notifikasi</a>
                                </div>
                            </div>
                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">no </th>
                                            <th>Pesan Notifikasi</th>
                                            <th>Jenis Notif</th>
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
        <div class="modal-dialog  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Investor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="datainvestor" method="POST">
                        <div class="row">
                            @csrf

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Nama">Nama</label>
                                    <div class="input-group">

                                        <input type="text" name="nama" required placeholder="Input Nama"
                                            class="form-control">
                                    </div>

                                    <br>
                                    <label for="Nama">Email</label>

                                    <div class="input-group">

                                        <input type="text" name="email" required placeholder="Input Email"
                                            class="form-control">
                                    </div>
                                    <br>
                                    <label for="Nama">Username</label>

                                    <div class="input-group">
                                        <input type="text" name="username" required placeholder="Input Username"
                                            class="form-control ">
                                    </div>
                                    <br>
                                    <label for="Nama">Nomor HP</label>

                                    <div class="input-group">
                                        <input type="text" name="nomor" required placeholder="Input Nomor"
                                            class="form-control ">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="input-group">

                                            <input type="password" required name="password" id="passfield"
                                                class="form-control">
                                            <div style="cursor: pointer" id="passeye" class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    <form id="datainvestoru" method="POST">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" name="id" id="k">
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <div class="input-group">

                                    <input type="text" id="namau" name="nama" placeholder="Input Nama"
                                        class="form-control phone-number">
                                </div>

                                <br>
                                <label for="Nama">Alamat</label>

                                <div class="input-group">

                                    <input type="text" id="alamatu" name="alamat" placeholder="Input Alamat"
                                        class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">Email</label>

                                <div class="input-group">

                                    <input type="text" id="emailu" name="email" placeholder="Input Email"
                                        class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">Nomor</label>

                                <div class="input-group">

                                    <input type="text" id="nomoru" name="nomor" placeholder="Input No"
                                        class="form-control phone-number">
                                </div>
                                <br>
                                <label for="Nama">Password</label>

                                <div class="input-group">

                                    <input type="text" name="password" placeholder="Set Password Baru"
                                        class="form-control phone-number">
                                </div>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="dataktp">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Data Investor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dataktpinvestor" method="POST">
                        <div class="row">
                            @csrf
                            <input type="hidden" name="id" id="idku">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="niku">NIK</label>
                                    <div class="input-group">

                                        <input type="text" name="nik" id="niku" required
                                            placeholder="Input NIK" class="form-control">
                                    </div>

                                    <br>
                                    <label for="Nama">Nama</label>
                                    <div class="input-group">

                                        <input type="text" name="nama" id="namaku" placeholder="Input Nama"
                                            class="form-control">
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="tempat">Tempat Lahir</label>

                                            <div class="input-group">

                                                <input type="text" name="tempatlahir" id="tempatlahiru"
                                                    placeholder="Input Tempat Lahir" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="tempat">Tanggal Lahir</label>

                                            <div class="input-group">

                                                <input type="text" name="tanggallahir" id="tanggallahiru"
                                                    placeholder="Input Tanggal Lahir" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <label for="jku">Jenis Kelamin</label>

                                    <div class="input-group">
                                        <select class="form-control" name="jk" id="jku">
                                            <option value="1">Laki - Laki</option>
                                            <option value="0">Perempuan</option>
                                        </select>

                                    </div>
                                    <br>
                                    <label for="alamatu">Alamat</label>

                                    <div class="input-group">
                                        <input type="text" id="alamatu" name="alamat" required
                                            placeholder="Input Alamat" class="form-control ">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="tempat">RT</label>

                                            <div class="input-group">

                                                <input type="text" name="rt" id="rtu"
                                                    placeholder="Input RT" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="tempat">RW</label>
                                            <div class="input-group">
                                                <input type="text" name="rw" id="rwu"
                                                    placeholder="Input RW" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="keldesu">Kel/Desa</label>

                                            <div class="input-group">

                                                <input type="text" name="keldes" id="keldesu"
                                                    placeholder="Input Kelurahan / Desa" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="kecamatanu">Kecamatan</label>

                                            <div class="input-group">

                                                <input type="text" name="kecamatan" id="kecamatanu"
                                                    placeholder="Input Kecamatan" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <label for="agamau">Agama</label>
                                    <div class="input-group">
                                        <select name="agama" class="form-control" id="agamau">
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                            <option value="Khatolik">Khatolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>

                                    <br>
                                    <label for="statuspu">Status Perkawinan</label>
                                    <div class="input-group">
                                        <select name="statusp" class="form-control" id="statuspu">
                                            <option value="Belum Kawin">Belum Kawin</option>
                                            <option value="Kawin">Kawin</option>
                                            <option value="Cerai Hkp">Cerai Hkp</option>
                                            <option value="Cerai Mati">Cerai Mati</option>

                                        </select>
                                    </div>

                                    <br>
                                    <label for="pekerjaanu">Pekerjaan</label>

                                    <div class="input-group">
                                        <input type="text" id="pekerjaanu" name="pekerjaan"
                                            placeholder="Input Pekerjaan" class="form-control ">
                                    </div>
                                    <br>
                                    <label for="kewarganegaraanu">Kewarganegaraan</label>

                                    <div class="input-group">
                                        <input type="text" id="kewarganegaraanu" name="kewarganegaraan"
                                            placeholder="Input Pekerjaan" class="form-control ">
                                    </div>

                                    <br>
                                    <label for="foto">Foto</label>

                                    <div class="input-group">
                                        <input type="file" id="foto" name="foto"
                                            placeholder="Input Pekerjaan" class="form-control ">
                                    </div>


                                </div>
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
                    <button id="datasubmitktp" type="button" class="btn btn-primary">Simpan</button>
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
                        width: "10%",

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
                    url: "{{ route('notif.index') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'pesan',
                        data: 'pesan'
                    },
                    {
                        nama: 'rolenya',
                        data: 'rolenya'
                    },
                    {
                        name: 'aksi',
                        data: 'aksi',
                    }
                ],

            });



        });
        $("#datasubmit").on('click', function() {
            $("#datainvestor").trigger('submit');
        });
        $("#datasubmitktp").on('click', function() {
            $("#dataktpinvestor").trigger('submit');
        });
        $("#datasubmitu").on('click', function() {
            $("#datainvestoru").trigger('submit');
        });
        $("#dataktpinvestor").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('investorktp.store') }}',
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
                        $("#dataktpinvestor").trigger('reset')
                        iziToast.success({
                            title: 'Succes!',
                            message: 'Data tersimpan',
                            position: 'topRight'
                        });
                        $("#dataktp").modal('hide');
                        tabel.ajax.reload();

                    }
                }
            })


        });
        $("#datainvestor").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('investor.store') }}',
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
                        $("#datainvestor").trigger('reset')
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
        $("#datainvestoru").on('submit', function(id) {
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
                    url: url + '/data-investor/' + id,
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

        function aktif(id) {
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
                    url: url + '/data-investor/' + id + '/aktif',
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
            $("#emailu").val(id.email);
            $("#nipu").val(id.kode);
            $("#nomoru").val(id.no);

            $("#k").val(id.id);



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

        function stafdata(data) {
            console.log(data);
            $('#dataktp').modal('show');
            $("#idku").val(data.id)
            if (data.o_ktp) {
                $("#niku").val(data.o_ktp.nik ?? null) 
                $("#namaku").val(data.o_ktp.nama ?? null)
                $("#tempatlahiru").val(data.o_ktp.tempat_lahir ?? null)
                $("#tanggallahiru").val(data.o_ktp.tanggal_lahir ?? null)
                $("#jku").val(data.o_ktp.jk ?? null)
                $("#alamatu").val(data.o_ktp.alamat ?? null)
                $("#rtu").val(data.o_ktp.rt ?? null)
                $("#rwu").val(data.o_ktp.rw ?? null)

                $("#agamau").val(data.o_ktp.agama ?? null)
                $("#kecamatanu").val(data.o_ktp.kecamatan ?? null)
                $("#keldesu").val(data.o_ktp.kel_des ?? null)
                $("#statuspu").val(data.o_ktp.status_kawin ?? null)
                $("#pekerjaanu").val(data.o_ktp.pekerjaan ?? null)
                $("#kewarganegaraanu").val(data.o_ktp.warganegara ?? null)
            }


        }
    </script>
@endpush
