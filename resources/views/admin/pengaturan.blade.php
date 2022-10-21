@extends('ab')

@section('css')
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection

@section('title')
    Profil
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Informasi Website</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manajemen Pengolahan Informasi </h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3"
                                        role="tab" aria-controls="home" aria-selected="true">Informasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                        aria-controls="profile" aria-selected="true">Kontak</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab"
                                        aria-controls="Saldo" aria-selected="true">Saldo</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                    aria-labelledby="home-tab3">
                                    <div class="card">
                                        <form id="dataprofil" method="POST" enctype="multipart/form-data">
                                            <div class="card-body">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <div class="form-group">
                                                    <label>Nama Aplikasi</label>
                                                    <input value="{{ $data->nama_app ?? '-' }}" type="text"
                                                        name="nama" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Heading</label>
                                                    <input value="{{ $data->heading ?? '-' }}" type="text" name="heading"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Sub-Heading</label>
                                                    <input value="{{ $data->subheading ?? '-' }}" type="text"
                                                        name="subheading" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Judul</label>
                                                    <input value="{{ $data->juduldesk ?? '-' }}" type="text"
                                                        name="juduldesk" class="form-control">
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Total Investor</label>
                                                            <input value="{{ $data->investor ?? '-' }}" type="text"
                                                                name="investor" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Total Bonus</label>
                                                            <input value="{{ $data->bonusperhari ?? '-' }}" type="text"
                                                                name="bonus" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi </label>
                                                    <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10">{{ $data->deksripsi ?? '-' }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Meta Deskripsi </label>
                                                    <textarea class="form-control" name="meta" id="" cols="30" rows="10">{{ $data->meta ?? '-' }}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Logo
                                                                @if ($data->logo == null)
                                                                    <span class="text-danger">* File tidak ada</span>
                                                                @else
                                                                    <span class="text-success">* File ada</span>
                                                                @endif
                                                            </label>
                                                            <input type="file" name="logo" class="form-control">
                                                            @if ($data->logo != null)
                                                                <a type="button"
                                                                    href="{{ asset('img/logo/') . '/' . $data->logo }}"
                                                                    target="_blank" class="btn btn-sm btn-primary">Cek
                                                                    Gambar</a>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Background
                                                                @if ($data->bg == null)
                                                                    <span class="text-danger">* File tidak ada</span>
                                                                @else
                                                                    <span class="text-success">* File ada</span>
                                                                @endif
                                                            </label>
                                                            <input type="file" name="bg" class="form-control">
                                                            @if ($data->bg != null)
                                                                <a type="button"
                                                                    href="{{ asset('img/bg/') . '/' . $data->bg }}"
                                                                    target="_blank" class="btn btn-sm btn-primary">Cek
                                                                    Gambar</a>
                                                            @endif

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right "></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile3" role="tabpanel"
                                    aria-labelledby="profile-tab3">
                                    <div class="card">
                                        <form id="datakontak" method="POST" enctype="multipart/form-data">
                                            <div class="card-body">

                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label>Nomor Telepon</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->nomor ?? '-' }}"
                                                                name="nomor" class="form-control phone-number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Nomor WA</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->wa ?? '-' }}"
                                                                name="wa" class="form-control phone-number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Email</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->email ?? '-' }}"
                                                                name="email" class="form-control phone-number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Alamat</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                            <input value="{{ $data->alamat ?? '-' }}" type="text"
                                                                name="alamat" class="form-control phone-number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Situs Website</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                            <input value="{{ $data->situs ?? '-' }}" type="text"
                                                                name="situs" class="form-control phone-number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Group WA</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->groupwa ?? '-' }}"
                                                                name="group" class="form-control phone-number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Group Telegram</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->persenan ?? '-' }}"
                                                                name="telegram" class="form-control phone-number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right "></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile4" role="tabpanel"
                                    aria-labelledby="profile-tab4">
                                    <div class="card">
                                        <form id="datasaldo">
                                            <div class="card-body">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label>Minimal WD</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->minimal }}"
                                                                placeholder="@money($data->minimal ?? 0, 'IDR', 'true')" name="minimal"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Biaya Admin</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->biayaadmin }}"
                                                                placeholder="@money($data->biayaadmin ?? 0, 'IDR', 'true')" name="biayaadmin"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Bonus Level 1 (%)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-cog"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->level1 }}"
                                                                name="level1" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Bonus Level 2 (%)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-cog"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->level2 }}"
                                                                name="level2" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Bonus Level 3 (%)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-cog"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" value="{{ $data->level3 }}"
                                                                name="level3" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Persenan</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                            <input value="{{ $data->persen ?? '-' }}" type="text"
                                                                name="persen" class="form-control">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right "></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@push('js')
    <!-- Page Specific JS File -->
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js ">
    </script>
    <script src="{{ asset('stisla/assets/modules/izitoast/js/iziToast.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#datasaldo").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('pengaturan.saldo') }}',
                data: data,
                type: "POST",
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

                    }
                }
            })


        });
        $("#datakontak").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('pengaturan.kontak') }}',
                data: data,
                type: "POST",
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

                    }
                }
            })


        });
        $("#dataprofil").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('store.info') }}',
                data: data,
                type: "POST",
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

                    }
                }
            })


        });
    </script>
    @if (session('message'))
        <script>
            iziToast.success({
                title: 'Succes!',
                message: 'Data tersimpan',
                position: 'topRight'
            });
        </script>
    @endif
    @if (session('status'))
        <script>
            var data = '{!! session('data') !!}';
            console.log(data)
            var parse = JSON.parse(data);
            iziToast.error({
                title: 'Error',
                message: data,
                position: 'topRight'
            });
        </script>
    @endif
@endpush
