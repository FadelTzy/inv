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
            <h1> Data Bank Penerima 
            </h1>
        </div>
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="float-left">
                                <h4>Manajemen Data Penerima</h4>

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
                                            <th>Atas Nama</th>
                                            <th>Bank</th>
                                            <th>Nomor Rekening</th>
                                            <th>No HP</th>
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
                    <h5 class="modal-title">Tambah Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="datatipe" method="POST">

                        @csrf
                        <div class="form-group">
                            <label for="Nama">Atas Nama</label>
                            <div class="input-group">

                                <input type="text" name="nama" required placeholder="Input Nama" class="form-control">
                            </div>

                            <br>
                            <label for="Nama">Nomor Rekening</label>

                            <div class="input-group">
                                <input type="number"  name="norek" required
                                    placeholder="Input Norek " class="form-control">
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Nama">Nama Bank</label>

                                        <div class="input-group">
                                            <input type="text"  name="namabank" required
                                                placeholder="Input Nama Bank" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">

                                        <label for="Nama">Nomor HP</label>
                                        <div class="input-group">
                                            <input type="number"  name="nohape"
                                                required class="form-control ">
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
                    <h5 class="modal-title">Edit Data</h5>
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
                                <label for="Nama">Atas Nama</label>
                                <div class="input-group">
    
                                    <input type="text" id="namau" name="nama" required placeholder="Input Nama" class="form-control">
                                </div>
    
                                <br>
                                <label for="Nama">Nomor Rekening</label>
    
                                <div class="input-group">
                                    <input type="number" id="noreku" name="norek" required
                                        placeholder="Input Norek " class="form-control">
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Nama">Nama Bank</label>
    
                                            <div class="input-group">
                                                <input type="text" id="namabanku" name="namabank" required
                                                    placeholder="Input Nama Bank" class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
    
                                            <label for="Nama">Nomor HP</label>
                                            <div class="input-group">
                                                <input type="number" id="nohapeu" name="nohape"
                                                    required class="form-control ">
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
        function biayaadminnya(e) {
            var c = e.value;
            let kuan = $("#jumlahinvestasi").val();
            if (kuan) {
                $("#rupiahbiayaadmin").val(idr(c * kuan * 0.01 ));
                $("#biayarupiahadmin").val(c * kuan * 0.01);

            } else {
                e.value = '';
                iziToast.warning({
                    title: 'Jumlah Investasi Belum Terisi',
                    message: '!',
                    position: 'topRight'
                });
            }

        }
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

                    }, 


                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('penerima.index') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'nama',
                        data: 'nama'
                    },
                    {
                        nama: 'bank',
                        data: 'bank'
                    },
                    {
                        nama: 'rekening',
                        data: 'rekening'
                    },
                    {
                        nama: 'nohape',
                        data: 'nohape'
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
                url: '{{ route('penerima.store') }}',
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
                url: '{{ route('penerima.update') }}',
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
                    url: url + '/data-master/penerima/' + id,
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
            $('#up').modal('show');



            $("#idu").val(id.id);
            $("#namau").val(id.nama);
            $("#noreku").val(id.rekening);
            $("#nohapeu").val(id.nohape);
            $("#namabanku").val(id.bank);


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
