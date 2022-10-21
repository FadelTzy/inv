<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
        name="viewport">
    <meta name="description"
        content="Fortuna App">
    <meta name="keywords"
        content="Fortuna App">
    <meta name="author" content="Muhamad Nauval Azhar">

    <meta property="og:title" content="Fortuna App">
    <meta property="og:description" content="Fortuna App.">
    <meta property="og:image" content="https://getstisla.com/landing/stisla-share.png?v=1663311697">
    <meta property="og:url" content="https://getstisla.com">

    <meta name="twitter:title" content="Fortuna App WEB">
    <meta name="twitter:description"
        content="Stisla is a clean &amp; modern HTML5 admin template based on Bootstrap 4.">
    <meta name="twitter:image" content="https://getstisla.com/landing/stisla-share.png">
    <meta name="twitter:card" content="summary_large_image">
    <title>Fortuna App WEB</title>
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


</head>

<body class="">
    @php
    $data = DB::table('pengaturans')->first();
    $tipc = DB::table('tipe_invests')->count();

    $cek = $data->groupwa;
    $telegram = $data->persenan;

     @endphp
    <nav class="navbar navbar-reverse bg-secondary navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand smooth" href="#">Fortuna App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ml-lg-3 align-items-lg-center">
         
                    <li class="nav-item"><a href="#dashboard" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="#design" class="nav-link">Faq</a></li>
                    <li class="nav-item"><a href="#components" class="nav-link">Kontak</a></li>
                    <li class="nav-item"><a href="{{url('registrasi')}}" class="nav-link">Daftar</a></li>

                </ul>
                <ul class="navbar-nav ml-auto align-items-lg-center d-none d-lg-block">
                    <li class="ml-lg-3 nav-item">
                        <a href="#" class="btn btn-round smooth btn-icon icon-left"
                            target="_blank">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="hero-wrapper pt-0 bg-secondary" id="top">
        <div class="hero  ">
            <div class="pt-0  container">
                <div class="text pt-0 text-center text-lg-left">
                    <a href="#" class="">
                        <img style="width: 75%" src="{{ asset('file/logotransparan.png') }}" alt="">
                    </a>
                    {{-- <h1> <i> more investment more earnings</i></h1> --}}
                    <p >
                        Kami hadir sebagai platform investasi online yang aman, menguntungkan, dan dijamin jangka panjang
                    </p>
                    <div class="cta">
                        <a class="btn btn-lg btn-danger btn-icon icon-right"
                            href="#">Download <i
                                class="fas fa-chevron-right"></i></a> &nbsp;
                     
                    </div>
                </div>
                <div class="image d-none d-lg-block">
                    <img src="{{ asset('stisla/landing/ill.svg') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
    <div class="callout container">
        <div class="row">
            <div class="col-md-4 col-12 mb-4 mb-lg-0">
                <div class="text-job text-muted text-14">Gabung bersama kami</div>
                <div class="h1 mb-0 font-weight-bold"><span class="font-weight-500"> Lebih Dari </span></div>
            </div>
            <div class="col-md-2 col-sm-12 mb-3 text-center">
                <div class="h2 font-weight-bold">{{$data->investor}}+</div>
                <div class="text-uppercase font-weight-bold ls-2 text-danger">Investor</div>
            </div>
            <div class="col-md-2 col-sm-12 mb-3 text-center">
                <div class="h2 font-weight-bold">{{$tipc}}+</div>
                <div class="text-uppercase font-weight-bold ls-2 text-danger">Paket Pasar</div>
            </div>
            <div class="col-md-3 col-sm-12 mb-3 text-center">
                <div class="h2 font-weight-bold">@money($data->bonusperhari,'IDR','false')+</div>
                <div class="text-uppercase font-weight-bold ls-2 text-danger">Bonus per Hari</div>
            </div>
        </div>
    </div>
   
    <section id="dashboard" class="section-skew">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col-lg-10 offset-lg-1">
                    <h2>FORTUNA APP <span class="text-primary"></span></h2>
                    <p >Di era digitalisasi seperti sekarang ini, bisnis/investasi online adalah salah satu solusi keuangan anda!</p>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6 mx-auto">
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/6uVUv8gZHBE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <section id="design" class="section-design">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block">
                    <img height="100%" src="{{asset('img/startup1.jpg')}}" alt="user flow"
                        class="img-fluid">
                </div>
                <div class="col-lg-7 pl-lg-5 col-md-12">
                    <div class="badge badge-danger mb-3">FAQ</div>
                    <h3>Dari mana<span class="text-danger"> Keuntungan</span>, anda dan kami ? </h3>
                    <p >Kami akan mengelola dana anda di Bursa Indeks Hangseng yang dijamin sangat menguntungkan</p>
                    <hr>
                    <h3>Apakah platform investasi ini<span class="text-danger"> Jangka Panjang</span> ? </h3>
                    <p >iya kami akan menjamin keamanan dalam jangka panjang</p>
                    <hr>
                    <h3>Apakah platform ini<span class="text-danger"> Aman</span> ? </h3>
                    <p >Iya kami akan mengelola keuangan anda dengan sebaik-baiknya</p>
                </div>
            </div>
        </div>
    </section>
   
   

    <section id="components" class="section-design section-design-right">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 pr-lg-5 pr-0">
                    <div class="badge badge-danger mb-3">Hubungi Kami</div>
                    <h2>Kantor Pusat Kami Berada di <span class="text-danger">Jakarta</span>, Dan Menjalankan Trading Dengan <span
                            class="text-danger">Broker Handal</span> Dan Berpengalaman lebih dari  <span class="text-danger">10 Tahun</span>
                    </h2>
                    <ul class="list-icons">
                        <li>
                            <span class="card-icon bg-danger text-white">
                                <i class="fas fa-phone"></i>
                            </span>
                            <span>Kontak CS: <b>{{$data->nomor}}</b></span>
                        </li>
                        <li>
                            <span class="card-icon bg-danger text-white">
                                <i class="fab fa-instagram"></i>
                                                        </span>
                            <span>Instagram: <b>@afortuna_inv22</b></span>
                        </li>
                        <li>
                            <span class="card-icon bg-danger text-white">
                                <i class="fa fa-globe"></i>
                                                        </span>
                            <span>Website: <b>Fortuna-inv.id</b></span>
                        </li>
                        <li>
                            <span class="card-icon bg-danger text-white">
                                <i class="fa fa-map-marker-alt"></i>
                                                        </span>
                            <span>Alamat: <b>Belezza Shoping Arcade Kebayoran Lama. Jakarta Selatan</b></span>
                        </li>
             
                    </ul>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="abs-images">
                        <img src="{{asset('img/locati.jpeg')}}" alt="user flow"
                        class="img-fluid rounded dark-shadow">
                        <img src="{{asset('img/belajar-trading-saham.jpg')}}" alt="user flow"
                        class="img-fluid rounded dark-shadow">
                      
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section id="try" class="section-dark p-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h2>Daftar Sekarang</h2>
                    <img style="width: 55%" src="{{ asset('file/logotransparan.png') }}" alt="">
                   
                    <div class="mt-4">
                        <a href="{{url('registrasi')}}" class="btn btn-sm btn-secondary">Daftar</a>
                        <a href="{{$cek}}" class="btn btn-sm btn-success">Gabung WA Group</a>
                        <a href="{{$telegram}}" class="btn btn-sm btn-danger">Gabung Telegram</a>

                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <footer class="">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 mx-auto">
                    <h3 class="text-capitalize">Fortuna APP</h3>
                    <div class="pr-lg-5">
                        <p>Fortuna merupakan aplikasi keuangan terbaik
                            to help developers create their own UI designs for the dashboard. Stisla is free for anyone,
                            support us by becoming a sponsor and keeping this project alive.</p>
                        <p>&copy; Fortuna Office 2022 from Indonesia</p>
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
    <script src="{{ asset('stisla/dist/modules/tooltip.js') }}"></script>
    <script src="{{ asset('stisla/dist/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/dist/modules/prism/prism.js') }}"></script>
    <script src="{{ asset('stisla/dist/js/stisla.js') }}"></script>
    <script src="{{ asset('stisla/landing/script.js') }}"></script>


    <!--End mc_embed_signup-->

</body>

</html>
