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
            <h1> Data Tipe Investasi
            </h1>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="float-left">
                                <h4>Manajemen Data Tipe Investasi</h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <button data-toggle="modal" data-target="#exampleModal" href="features-post-create.html"
                                        class="btn btn-primary">Add New</button>
                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">no</th>
                                            <th>Paket Investasi</th>
                                            <th>Jumlah Investasi</th>
                                            <th>Lama Penarikan (Hari)</th>
                                            <th>Keuntungan / (Hari)</th>
                                            <th>Pendapatan</th>
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
                    <h5 class="modal-title">Tambah Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="datatipe" method="POST">

                        @csrf
                        <div class="form-group">
                            <label for="Nama">Nama Paket</label>
                            <div class="input-group">

                                <input type="text" name="paket" required placeholder="Input Nama" class="form-control">
                            </div>

                            <br>
                            <label for="Nama">Jumlah Investasi (Rupiah)</label>

                            <div class="input-group">

                                <input type="text" onkeyup="setmodal(this)" id="jumlahinvestasi" name="investasi"
                                    required placeholder="Input Investasi " class="form-control">
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Nama">Bunga / Hari (%)</label>

                                        <div class="input-group">
                                            <input type="number" onkeyup="bunga(this)" name="bungaperhari" required
                                                placeholder="Input Bunga (%)" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">

                                        <label for="Nama">Rupiah Bunga / Hari</label>
                                        <input type="hidden" id="hrbp" name="hrbp">
                                        <div class="input-group">
                                            <input type="text" readonly id="rupiahbungaperhari" name="rupiahbungaperhari"
                                                required class="form-control ">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Nama">Periode Penarikan Bunga (Hari)</label>

                                        <div class="input-group">
                                            <input type="number" name="periodepenarikanbunga" required
                                                placeholder="Input Periode (Hari)" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">

                                        <label for="Nama">Lama Investasi (Hari)</label>

                                        <div class="input-group">
                                            <input type="number" id="lamainvestasi" onkeyup="lamainvestasia(this)"
                                                name="lamainvestasi" placeholder="Input Periode Investasi (Hari)" required
                                                class="form-control ">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Nama">Modal (Rp)</label>

                                        <div class="input-group">
                                            <input type="text" name="modal" id="modal" required readonly
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Nama">Total Keuntungan (Rp)</label>

                                        <div class="input-group">
                                            <input type="text" name="untung" id="untung" readonly
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>


                            </div>

                            {{-- <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Nama">Biaya Admin (%) -> Modal</label>

                                        <div class="input-group">
                                            <input type="text" onkeyup="biayaadminnya(this)" name="biayaadmin"
                                                required placeholder="Input Persen Biaya Admin" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">

                                        <label for="Nama">Rupiah Biaya Admin</label>
                                        <input type="hidden" id="biayarupiahadmin" name="biayarupiahadmin">
                                        <div class="input-group">
                                            <input type="text" readonly id="rupiahbiayaadmin" class="form-control ">
                                        </div>
                                    </div>

                                </div>
                            </div> --}}


                            
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="Nama">File Gambar </label>
                                        <div class="input-group">
                                            <input type="file" name="gambar" required placeholder="Input biaya WD"
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="Nama">Status Tipe Investasi </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1"
                                                id="status1">
                                            <label class="form-check-label" for="status1">
                                                Limited
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="2"
                                                id="status2" checked>
                                            <label class="form-check-label" for="status2">
                                                Unlimited
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">

                                        <label for="Nama">Limit</label>
                                        <div class="input-group">
                                            <input type="text" disabled id="limit" name="limit"
                                                class="form-control ">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="Nama">Status Tipe Investasi User </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="statususer" value="1"
                                                id="statususer1">
                                            <label class="form-check-label" for="statususer1">
                                                Limited
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="statususer" value="2"
                                                id="statususer2" checked>
                                            <label class="form-check-label" for="statususer2">
                                                Unlimited
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">

                                        <label for="Nama">Limit User</label>
                                        <div class="input-group">
                                            <input type="text" disabled id="limituser" name="limituser"
                                                class="form-control ">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jenis Investasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="datatipeu" method="POST">
                        <div class="card-body">

                            @csrf
                            <input type="hidden" name="id" id="idu">
                            <div class="form-group">
                                <label for="Nama">Nama Paket</label>
                                <div class="input-group">

                                    <input type="text" name="paket" id="paketu" required
                                        placeholder="Input Nama" class="form-control">
                                </div>

                                <br>
                                <label for="Nama">Jumlah Investasi (Rupiah)</label>

                                <div class="input-group">

                                    <input type="text" onkeyup="setmodalu(this)" id="jumlahinvestasiu"
                                        name="investasi" required placeholder="Input Investasi " class="form-control">
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Nama">Bunga / Hari (%)</label>

                                            <div class="input-group">
                                                <input type="number" onkeyup="bungau(this)" id="bungaperhariu"
                                                    name="bungaperhari" required placeholder="Input Bunga (%)"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">

                                            <label for="Nama">Rupiah Bunga / Hari</label>
                                            <input type="hidden" id="hrbpu" name="hrbp">
                                            <div class="input-group">
                                                <input type="text" readonly id="rupiahbungaperhariu"
                                                    name="rupiahbungaperhari" required class="form-control ">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Nama">Periode Penarikan Bunga (Hari)</label>

                                            <div class="input-group">
                                                <input type="number" id="periodepenarikanbungau"
                                                    name="periodepenarikanbunga" required
                                                    placeholder="Input Periode (Hari)" class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">

                                            <label for="Nama">Lama Investasi (Hari)</label>

                                            <div class="input-group">
                                                <input type="number" id="lamainvestasiu" onkeyup="lamainvestasiau(this)"
                                                    name="lamainvestasi" placeholder="Input Periode Investasi (Hari)"
                                                    required class="form-control ">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Nama">Modal (Rp)</label>

                                            <div class="input-group">
                                                <input type="text" name="modal" id="modalu" required readonly
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Nama">Total Keuntungan (Rp)</label>

                                            <div class="input-group">
                                                <input type="text" name="untung" id="untungu" readonly
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                {{-- <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Nama">Biaya Admin (%) -> Modal</label>

                                            <div class="input-group">
                                                <input type="text" onkeyup="biayaadminnyau(this)" id="biayaadminu"
                                                    name="biayaadmin" required placeholder="Input Persen Biaya Admin"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">

                                            <label for="Nama">Rupiah Biaya Admin</label>
                                            <input type="hidden" id="biayarupiahadmin" id="biayarupiahadminu"
                                                name="biayarupiahadmin">
                                            <div class="input-group">
                                                <input type="text" readonly id="rupiahbiayaadminu"
                                                    class="form-control ">
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}


                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label for="Nama">File Gambar </label>
                                            <div class="input-group">
                                                <input type="file" name="gambar" required
                                                    placeholder="Input biaya WD" class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label for="Nama">Status Tipe Investasi </label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="statusu"
                                                    value="1" id="statusu1">
                                                <label class="form-check-label" for="status1">
                                                    Limited
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="statusu"
                                                    value="2" id="statusu2" checked>
                                                <label class="form-check-label" for="status2">
                                                    Unlimited
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">

                                            <label for="Nama">Limit</label>
                                            <div class="input-group">
                                                <input type="text" disabled id="limitu" name="limit"
                                                    class="form-control ">
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

        function setmodal(e) {
            var c = e.value;
            $("#modal").val(idr(c));
        }

        function setmodalu(e) {
            var c = e.value;
            $("#modalu").val(idr(c));
        }

        // function biayaadminnya(e) {
        //     var c = e.value;
        //     let kuan = $("#jumlahinvestasi").val();
        //     if (kuan) {
        //         $("#rupiahbiayaadmin").val(idr(c * kuan * 0.01));
        //         $("#biayarupiahadmin").val(c * kuan * 0.01);

        //     } else {
        //         e.value = '';
        //         iziToast.warning({
        //             title: 'Jumlah Investasi Belum Terisi',
        //             message: '!',
        //             position: 'topRight'
        //         });
        //     }

        // }

        // function biayaadminnyau(e) {
        //     var c = e.value;
        //     let kuan = $("#jumlahinvestasiu").val();
        //     if (kuan) {
        //         $("#rupiahbiayaadminu").val(idr(c * kuan * 0.01));
        //         $("#biayarupiahadminu").val(c * kuan * 0.01);

        //     } else {
        //         e.value = '';
        //         iziToast.warning({
        //             title: 'Jumlah Investasi Belum Terisi',
        //             message: '!',
        //             position: 'topRight'
        //         });
        //     }

        // }

        function bunga(e) {
            var c = e.value;
            let kuan = $("#jumlahinvestasi").val();
            let hari = $("#lamainvestasi").val();
            if (kuan) {
                let h = idr(c * kuan * 0.01);
                console.log(c);
                $("#rupiahbungaperhari").val(h)
                $("#hrbp").val(c * kuan * 0.01);
                $("#untung").val(idr(hari * c * kuan * 0.01))

            } else {
                e.value = '';
                iziToast.warning({
                    title: 'Jumlah Investasi Belum Terisi',
                    message: '!',
                    position: 'topRight'
                });
            }
        }
            function bungau(e) {
                var c = e.value;
                let kuan = $("#jumlahinvestasiu").val();
                let hari = $("#lamainvestasiu").val();
                if (kuan) {
                    let h = idr(c * kuan * 0.01);
                    console.log(c);
                    $("#rupiahbungaperhariu").val(h)
                    $("#hrbpu").val(c * kuan * 0.01);
                    $("#untungu").val(idr(hari * c * kuan * 0.01))

                } else {
                    e.value = '';
                    iziToast.warning({
                        title: 'Jumlah Investasi Belum Terisi',
                        message: '!',
                        position: 'topRight'
                    });
                }

            }
            $('input[type=radio][name=status]').change(function() {
                console.log('s');
                if (this.value == '1') {
                    $("#limit").removeAttr('disabled');
                } else if (this.value == '2') {
                    $("#limit").attr('disabled', 'disabled');
                    $("#limit").val(null);

                }
            });
            $('input[type=radio][name=statususer]').change(function() {
                console.log('s');
                if (this.value == '1') {
                    $("#limituser").removeAttr('disabled');
                } else if (this.value == '2') {
                    $("#limituser").attr('disabled', 'disabled');
                    $("#limituser").val(null);

                }
            });
            $('input[type=radio][name=statusu]').change(function() {
                console.log('s');
                if (this.value == '1') {
                    $("#limitu").removeAttr('disabled');
                } else if (this.value == '2') {
                    $("#limitu").attr('disabled', 'disabled');
                    $("#limitu").val(null);

                }
            });

            function lamainvestasia(e) {
                var c = e.value;
                let kuan = $("#jumlahinvestasi").val();
                let harga = $("#hrbp").val();
                if (kuan) {
                    let h = idr(harga * c);
                    console.log(c);
                    $("#untung").val(h)
                } else {
                    e.value = '';
                    iziToast.warning({
                        title: 'Jumlah Investasi Belum Terisi',
                        message: '!',
                        position: 'topRight'
                    });
                }
            }
            function lamainvestasiau(e) {
                var c = e.value;
                let kuan = $("#jumlahinvestasiu").val();
                let harga = $("#hrbpu").val();
                if (kuan) {
                    let h = idr(harga * c);
                    console.log(c);
                    $("#untungu").val(h)
                } else {
                    e.value = '';
                    iziToast.warning({
                        title: 'Jumlah Investasi Belum Terisi',
                        message: '!',
                        position: 'topRight'
                    });
                }
            }
            jQuery(document).ready(function() {

                tabel = $("#dt").DataTable({
                    columnDefs: [{
                            targets: 0,
                            width: "1%",
                        },
                        {
                            targets: 1,
                            width: "15%",

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
                            width: "25%",

                        }, {
                            orderable: false,

                            targets: 6,
                            width: "20%",

                        },


                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('jenisinvest.index') }}",
                    },
                    columns: [{
                            nama: 'DT_RowIndex',
                            data: 'DT_RowIndex'
                        }, {
                            nama: 'paket',
                            data: 'paket'
                        },
                        {
                            nama: 'investasi',
                            data: function(d) {
                                return idr(d['investasi'])
                            }
                        },
                        {
                            nama: 'hari',
                            data: function(d) {
                                return d['lamapenarikan'] + ' Hari' + ' <br> * WD per ' + d[
                                    'lamapenarikanbunga'] + ' Hari'
                            }
                        },
                        {
                            nama: 'harian',
                            data: function(d) {
                                return idr(d['bungaperhari']) + '/ Hari' + '<br> * ' + d[
                                    'lamapenarikan'] + ' = ' + idr(d['bungaperhari'] * d[
                                    'lamapenarikan'])
                            }
                        },
                        {
                            nama: 'persenadmin',
                            data: function(d) {
                                return idr(parseInt(d['investasi']) + (d['bungaperhari'] * d[
                                    'lamapenarikan']) ) 

                            }
                        },

                        {
                            name: 'aksi',
                            data: 'aksi',
                        }
                    ],

                });



            });
            $("#datasubmit").on('click', function() {
                $("#datatipe").trigger('submit');
            });
            $("#datasubmitu").on('click', function() {
                $("#datatipeu").trigger('submit');
            });
            $("#datatipe").on('submit', function(id) {
                id.preventDefault();
                var data = $(this).serialize();
                $.LoadingOverlay("show");
                $.ajax({
                    url: '{{ route('jenisinvest.store') }}',
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
                            $("#datatipe").trigger('reset')
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
            $("#datatipeu").on('submit', function(id) {
                id.preventDefault();
                var data = $(this).serialize();
                $.LoadingOverlay("show");
                $.ajax({
                    url: '{{ route('jenisinvest.update') }}',
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
                        $('#modalEdit').modal('hide');

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
                        url: url + '/data-master/jenis-investasi/' + id,
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

            function idr(id) {
                var sisa = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(id);
                return sisa;
            }

            function staffupd(id) {
                console.log(id);
                $('#modalEdit').modal('show');
                $("#paketu").val(id.paket);
                $("#jumlahinvestasiu").val(id.investasi);
                $("#bungaperhariu").val(id.persenanhari)
                $("#rupiahbungaperhariu").val(idr(id.persenanhari * 0.01 * id.investasi));
                $("#modalu").val(idr(id.investasi));
                $("#periodepenarikanbungau").val(id.lamapenarikanbunga);
                $("#lamainvestasiu").val(id.lamapenarikan);
                $("#untungu").val(idr(id.persenanhari * 0.01 * id.investasi * id.lamapenarikan));
                // $("#biayaadminu").val(id.persenadmin)
                // $("#rupiahbiayaadminu").val(idr(id.investasi * id.persenadmin * 0.01))
                $("#biayarupiahadminu").val(id.investasi * id.persenadmin * 0.01)
                $("#hrbpu").val(id.bungaperhari);
                if (id.status == 1) {
                    $("#limitu").removeAttr('disabled');
                    $("#limitu").val(id.limit);
                    $("input[name=statusu][value=" + id.status + "]").attr('checked', 'checked');
                }else{
                    $("input[name=statusu][value=" + id.status + "]").attr('checked', 'checked');
                    $("#limitu").attr('disabled','disabled');
                }




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
