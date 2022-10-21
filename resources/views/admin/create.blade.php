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
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/summernote/summernote-bs4.css') }}">
@endsection

@section('title')
    Data Informasi
@endsection
@section('content')

<section class="section">
    <div class="section-header">
        <h1> Tambah Data 
        </h1>
    </div>
    <div class="section-body">
    
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Form Informasi</h4>
                </div>
                <div class="card-body">
                    <form id="forminfo">
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Title</label>
                    <div class="col-sm-12 col-md-12">
                      <input name="judul" type="text" class="form-control">
                    </div>
                  </div>
          
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Content</label>
                    <div class="col-sm-12 col-md-12">
                      <textarea name="konten" class="summernotee"></textarea>
                    </div>
                  </div>
                  {{-- <div class="form-group row mb-4">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Gambar</label>
                    <div class="col-sm-12 col-md-12">
                      <input type="file" name="gambar" class="form-control">
                    </div>
                  </div> --}}
             
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12"></label>
                    <div class="col-sm-12 col-md-12">
                      <button type="submit" class="btn btn-primary">Publish</button>
                    </div>
                  </div>
                </form>
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
    <!-- Page Specific JS File -->
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('stisla/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/summernote/summernote-bs4.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = window.location.origin;
        jQuery(document).ready(function() {
            $('textarea').summernote({
				height: 300,   //set editable area's height
			});


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
                 


                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('informasi.admin') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'judul',
                        data: 'judul'
                    },
                    {
                        nama: 'datenya',
                        data: 'datenya'
                    },
                  

                    {
                        name: 'aksi',
                        data: 'aksi',
                    }
                ],

            });



        });
        //depo form dan btn
   
        $("#forminfo").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: url + '/informasi',
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
                            '<br><div><ul>';

                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        iziToast.error({
                            message: elem,
                            position: 'topRight'
                        });

                    } else {
                        iziToast.success({
                            title: 'Succes!',
                            message: 'Data tersimpan',
                            position: 'topRight'
                        });
                        $("#forminfo").trigger('reset');
         
                    }
                }
            })
        });
    </script>
@endpush
