<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
        name="viewport">
    <meta name="description"
        content="Di era digitalisasi seperti sekarang ini, bisnis/investasi online adalah salah satu solusi keuangan anda!">
    <meta name="keywords"
        content="Di era digitalisasi seperti sekarang ini, bisnis/investasi online adalah salah satu solusi keuangan anda!">
    <meta name="author" content="Muhamad Nauval Azhar">

    <meta property="og:title" content="Fortuna App">
    <meta property="og:description" content="Stisla is a clean &amp; modern HTML5 admin template based on Bootstrap 4.">
    <meta property="og:image" content="https://getstisla.com/landing/stisla-share.png?v=1663311697">
    <meta property="og:url" content="https://getstisla.com">

    <meta name="twitter:title" content="Fortuna">
    <meta name="twitter:description"
        content="Stisla is a clean &amp; modern HTML5 admin template based on Bootstrap 4.">
    <meta name="twitter:image" content="https://getstisla.com/landing/stisla-share.png">
    <meta name="twitter:card" content="summary_large_image">
    <title>Registrasi Fortuna App</title>
    <link rel="shortcut icon" href="{{ asset('stisla/landing/stisla.png') }}">
    <link rel="stylesheet" href="{{ asset('stisla/dist/modules/prism/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/dist/modules/chocolat/dist/css/chocolat.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/dist/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/landing/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/fontawesome/css/all.min.css') }}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>

    <style>
        .bg-img {
            background-image: url("img/wpx.jpg");
            background-color: #cccccc;
            background-position: center;
            background-size: contain;

        }
    </style>
</head>

<body class="">

    <nav class="navbar navbar-reverse bg-secondary navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand smooth" href="{{ url('/') }}">Fortuna App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ml-lg-3 align-items-lg-center">

                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>

                    <li class="nav-item"><a href="{{ url('registrasi') }}" class="nav-link">Daftar</a></li>

                </ul>
                <ul class="navbar-nav ml-auto align-items-lg-center d-none d-lg-block">
                    <li class="ml-lg-3 nav-item">
                        <a href="#" class="btn btn-round smooth btn-icon icon-left" target="_blank">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="hero-mini pb bg-img">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-8 offset-lg-2">
                    <h1>Daftar Baru</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="hero-mini-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Register Fortuna User</h4>
                        </div>
                        <div class="card-body">
                            <form id="submitdata" action="">
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="nomor" class="form-control phone-number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password" name="password" class="form-control pwstrength"
                                            data-indicator="pwindicator">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Password Confirm</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password" name="passwordc" class="form-control pwstrength"
                                            data-indicator="pwindicator">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Kode Referal</label>
                                    <input type="text" value="{{ request()->get('referal') }}" name="kode"
                                        class="form-control purchase-code" placeholder="123456">
                                </div>

                                <div class="form-group mx-auto">
                                    <label></label>
                                    <button type="submit" class="btn btn-sm btn-danger">Daftar</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>


    <section class="download-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h2>Start Your Awesome Project</h2>
                    <p class="lead">Start your amazing project with Stisla, don't start designing from scratch.</p>
                </div>
                <div class="col-md-5 text-right">
                    <a href="https://getstisla.com/download" class="btn btn-primary btn-lg">Download Stisla Now</a>
                </div>
            </div>
        </div>
    </section>
    <footer class="">
        <div class="container ">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <h3 class="text-capitalize">Fortuna APP</h3>
                    <div class="pr-lg-5">
                        <p>Fortuna merupakan aplikasi keuangan terbaik
                            to help developers create their own UI designs for the dashboard. Stisla is free for anyone,
                            support us by becoming a sponsor and keeping this project alive.</p>
                        <p>&copy; Fortuna. With <i class="fas fa-heart text-danger"></i> from Indonesia</p>
                        <div class="mt-1 social-links">
                            {{-- <a href="https://github.com/stisla"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com/getstisla"><i class="fab fa-whatsapp"></i></a> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>






    <script src="{{ asset('stisla/dist/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('stisla/dist/modules/popper.js') }}"></script>
    <script src="{{ asset('stisla/dist/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/dist/js/stisla.js') }}"></script>
    <script src="{{ asset('stisla/landing/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js ">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#submitdata").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");
            $.ajax({
                url: "{{ url('apipostuser') }}",
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
                        Swal.fire({
                            title: 'Error!',
                            text: elem,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                        return false;

                    } else {
                        $("#submitdata").trigger('reset')
                        Swal.fire({
                            title: 'Berhasil Registrasi',
                            text: elem,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        })
                        return false;

                    }
                }
            })

        })
    </script>

    <!--End mc_embed_signup-->

</body>

</html>
