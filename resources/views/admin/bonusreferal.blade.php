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
    Data Deposit
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Data Bonus Referal User
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
                                    <div class="profile-widget-item-label">Bonus Referal</div>
                                    <div class="profile-widget-item-value" id="pengajuannya">.</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Total Bonus</div>
                                    <div class="profile-widget-item-value" id="totalinvestasi"></div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Referal Terbaru</div>
                                    <div class="profile-widget-item-value" id="totaldeposit"></div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{$user->nama}} <div
                                    class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> @if ($user->role == 3)
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
                                <h4>Riwayat Referal</h4>

                            </div>
                            <div class="float-right">
                                <div class="section-header-button">
                                    <a type="button" href="{{url('data-saldo')}}"
                                    class="btn btn-secondary">Kembali</a>
                                  
                                </div>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">No</th>
                                            <th>Bonus</th>
                                            <th>Urut</th>
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
                            <label for="Nama">Nama</label>
                            <div class="input-group">

                                <input type="text" value="{{$user->nama}}" placeholder="Input Investasi"
                                    class="form-control">
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Nama">Jumlah Deposit</label>
                                        <div class="input-group">
                                            <input type="number" onkeyup="setdepo(this)" id="numberofdepo" name="depo" required placeholder="Input Deposit"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Nama">Rupiah Deposit</label>
                                        <div class="input-group">
                                            <input type="text" id="rupiahofdeposit" placeholder="0"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Nama">Nomor Rekening</label>
                                        <div class="input-group">
                                            <input type="number" value="{{$user->oKtp->rekening}}" name="norek" required placeholder="Input Nomor Rekening"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="Nama">Nama Bank</label>
                                        <div class="input-group">
                                            <input type="text" value="{{$user->oKtp->bank}}" name="namabank" placeholder="0"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label for="Nama">Pilihan Rekening Penerima</label>
                            <div class="input-group">
                              <select name="rekpe" class="form-control" id="rekeningpenerima">
                                <option disabled selected>Pilih Rekening</option>
                                @foreach ($bank as $item)
                                <option data-p="{{$item}}" value="{{$item->id}}" >{{$item->nama}} - {{$item->bank}} - {{$item->rekening}}</option>

                                @endforeach
                              </select>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Rekening Penerima</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="rekeningp"
                                                placeholder="Input Deposit" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Bank Penerima</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="bankp"
                                                placeholder="Input Deposit" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label for="Nama">Bukti Transfer</label>
                            <div class="input-group">
                                <input type="file" readonly name="file"  required
                                    placeholder="Input " class="form-control">
                            </div>

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

                                    <input type="number" id="investasiu" name="investasi" required placeholder="Input Investasi"
                                        class="form-control">
                                </div>


                                <br>
                                <label for="Nama">Jenis Investasi</label>

                      

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

    {{-- modal bukti --}}
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
                            <input type="hidden" id="id_pengajuan" name="id_pengajuan">
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
                                            <input type="number"  value="{{$user->oKtp->rekening}}" required id="rekeningpengirim" name="rekeningpengirim"
                                                 class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="depos">Bank Pengirim</label>
                                        <div class="input-group">
                                            <input type="text" required value="{{$user->oKtp->bank}}" id="bankpengirim" name="bankpengirim"
                                                 class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="depos">Nama Penerima</label>
                                        <div class="input-group">
                                            <input type="text" readonly id="buktinamap"
                                                placeholder="Input Deposit" class="form-control ">
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
                                            <input type="text" readonly id="buktibankp"
                                                placeholder="Input Deposit" class="form-control ">
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
                                            <input type="text" id="tanggalbayar"
                                                 class="form-control ">
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
                "drawCallback": function(settings) {
                    var api = this.api();
                    let c = 0;
                    let datadepo = api.columns().data()[5];
                    let datastatus = api.columns().data()[6];
                    datadepo.forEach((element,key) => {
                        if (datastatus[key] == 1) {
                            c += parseInt(element);
                        }
                    });

                    $("#pengajuannya").html(api.rows()[0].length)
                    // api.column( 4, {page:'current'} ).data().sum();
                    // dat.forEach(element => {
                    //     console.log(element)
                    // });
                    var n = api
                        .column(5)
                        .data()
                        .reduce(function(a, b) {
                            return parseInt(a) + parseInt(b);
                        }, 0);
                    var t= parseInt(api.column(5).data()[0]);
                    var ti = new Intl.NumberFormat('en-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(n);
                    var td = new Intl.NumberFormat('en-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(t);
                
                    $("#totalinvestasi").html(idr(c));
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
                        visible: false,
                        targets: 5,
                        width: "20%",

                    },
               
                    {
                        orderable: false,
                        visible: false,
                        targets: 6,
                        width: "20%",

                    },
                 
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: url + '/data-saldo/bonus-referal/' + '{{ Request::segment(3) }}',
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'jumlahnya',
                        data: 'jumlahnya'
                    },
                    {
                        nama: 'urutnya',
                        data: 'urutnya'
                    },
                    {
                        nama: 'tanggalnya',
                        data: 'tanggalnya'
                    },
                 

                    {
                        name: 'aksi',
                        data: 'aksi',
                    },

                    {
                        name: 'datadepo',
                        data: 'datadepo',
                    },
                    {
                        name: 'status',
                        data: 'status',
                    },

               
                ],

            });



        });
        function setdepo(e) {
            var c = e.value;
            console.log(idr(c));
           $("#rupiahofdeposit").val(idr(c)); 
        }
        function buktitf(id) {
            $('#modalBukti').modal('show');
            let tagihan =  parseInt(id.jumlah);
            $("#bukti").val(idr(tagihan));
            $("#id_pengajuan").val(id.id); 
            console.log(id);
            $("#buktirekeningp").val(id.o_penerima.rekening);
            $("#buktibankp").val(id.o_penerima.bank);
            $("#buktinamap").val(id.o_penerima.nama);
            $("#tanggalbayar").val(id.updated_at);
            let btn = `<a target='_blank' href='${url + '/img/buktidepo/' + id.buktitransfer }' class="btn btn-info btn-sm"> Bukti Pembayaran </a>`;
           
            let verif = `<button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>`;
            verif += `<button onclick='verifikasi("${id.id}","${id.kode}")' class="btn btn-dart">Approve</button>`;
            $("#btnverif").html(verif);
            $("#btnbuktitf").html(btn); 
        }
        function verifikasi(id,kode) {
            console.log(id,kode);
            data = confirm("Approve Pengajuan Deposit User Dengan Kode : " + kode);
            console.log(id);
            if (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.LoadingOverlay("show");

                $.ajax({
                    url: url + '/data-saldo/depo-saldo',
                    type: "post",
                    data:{
                        id:id,
                        kode:kode
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
        $("#datasubmit").on('click', function() {
            $("#datapengajuan").trigger('submit');
        });
        $("#datapengajuan").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('saldouser.store') }}',
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
                        $("#exampleModal").modal('hide');
                        tabel.ajax.reload();

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
                    url: url + '/data-saldo/riwayat-deposit/' + id,
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
