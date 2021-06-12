<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>Fjellserver.no | HJELP Dashboard</title>
    <meta property="og:type" content="website">
    <link rel="icon" type="image/png" sizes="36x36" href="https://fjellserver.no/assets/img/android-icon-36x36.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://fjellserver.no/assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="https://fjellserver.no/assets/img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="https://fjellserver.no/assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="mask-icon" href="https://fjellserver.no/assets/img/safari-pinned-tab.svg" color="#1b316b">
    <link rel="shortcut icon" href="https://fjellserver.no/assets/img/favicon.ico">
    <meta name="msapplication-config" content="https://fjellserver.no/assets/img/browserconfig.xml">
    <link rel="stylesheet" href="https://fjellserver.no/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://fjellserver.no/assets/css/logo.css">
    <link rel="stylesheet" href="https://fjellserver.no/assets/css/main.css">
</head>
<body>

<div class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-light navbar-expand-lg navbar-static-top bg-secondary text-uppercase" style="padding-top: 0%; padding-bottom: 0%;" id="mainNav">
        <div class="container"><a class="navbar-brand js-scroll-trigger" href="https://hjelp.fjellserver.no">FJELLSERVER&nbsp;<img id="nav-logo" alt="logo" src="https://fjellserver.no/assets/img/Fjellserver%20-logo%20icon%20transparent.svg"></a>
        <h2 class="text-white">Hjelpeside</h2>
        </div>
</nav>

<div class="container">
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h1>Lag en Artikkel:</h1>
<form action="{{url('dashboard/artikkel')}}" method="post">
@csrf
<div class="mb-3">
  <label for="tittel" class="form-label">Artikkel navn</label>
  <input type="text" class="form-control" id="tittel" name="tittel" placeholder="Tittel på artikkel" require>
</div>
<div class="mb-3">
  <label for="innhold" class="form-label">Artikkel Innhold</label>
  <textarea  type="text" class="form-control" id="innhold" name="innhold" row="5" placeholder="Innhold"></textarea require>
</div>
<label for="KategoriDataList" class="form-label">Velg en kategori</label>
<input class="form-control" list="datalistOptions" id="KategoriDataList" name="KategoriDataList" placeholder="Søk...">
<datalist id="datalistOptions">
@foreach($kategori as $key => $data)
  <option value="{{$data->navn}}">
  @endforeach
</datalist>
<div class="mb-3">
  <label for="video" class="form-label">Video URL</label>
  <input  type="text" class="form-control" id="video" name="video" placeholder="Innhold">
</div>
<button type="submit" class="btn btn-primary">Send</button>
</form>
</div>
<div class="container">
<h1>Lag en Kategori:</h1>
<form action="{{url('dashboard/kategori')}}" method="post">
@csrf
<div class="mb-3">
  <label for="navn" class="form-label">Kategori navn</label>
  <input type="text" class="form-control" id="navn" name="navn" placeholder="Kategori navn">
</div>
<div class="mb-3">
  <label for="undertekst" class="form-label">Kategori undertekst</label>
  <input type="text" class="form-control" id="undertekst" name="undertekst" placeholder="Hva handler kategorien om?">
</div>
<button type="submit" class="btn btn-primary">Legg til</button>
</form>

<h2>Endre en Kategori:</h2>
    <ul class="list-group list-group-flush">
    @foreach($kategori as $key => $data)
    <li class="list-group-item"><h5>{{$data->navn}}</h5><p>{{$data->undertekst}}</p></li>
    @endforeach
    </ul>
</div>

<main class="flex-fill"></main>
<footer class="footer text-center" style="background-color: #1B316B; padding-bottom: 0%; padding-top: 0%;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4"></h4>
                <p></p>
            </div>
            <div class="col-md-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase"><strong>sosialt</strong></h4>
                <ul class="list-inline">
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="Facebook" href="https://www.facebook.com/fjellserver/" target="_blank" rel="noopener"><i class="fab fa-facebook-f fa-fw"></i></a></li>
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="Instagram" href="https://www.instagram.com/fjellserver/"><i class="fab fa-instagram fa-fw"></i></a></li>
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="Discord" href="https://discord.gg/STX8gt6"><i class="fab fa-discord fa-fw"></i></a></li>
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="YouTube" href="https://www.youtube.com/channel/UCTLsqpKLdkaYBMEgY2Ogpzg/"><i class="fab fa-youtube fa-fw"></i></a></li>
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="E-post" href="mailto:kontakt@fjellserver.no"><i class="fas fa-envelope fa-fw"></i></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4 class="text-uppercase mb-4"></h4>
                <p class="lead mb-0"><span></span></p>
            </div>
        </div>
    </div>
    <div class="copyright py-4 text-center text-white" style="background-color: #2c3e50;">
        <div class="container">
        <small id="year">Opphavsrett © Fjellserver 2019 -&nbsp;</small>
        <br>
        <small>Fjellserver.no er på ingen måte tilknyttet/levert/drevet/støttet av Mojang AB eller Microsoft.</small>
        </div>
    </div>
</footer>
</div>
<script src="https://fjellserver.no/assets/js/jquery.min.js"></script>
    <script src="https://fjellserver.no/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://fjellserver.no/assets/js/year.js"></script>
</body>
</html>