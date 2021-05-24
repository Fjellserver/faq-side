<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>Fjellserver.no | FAQ Artikkel</title>
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

<nav class="navbar navbar-light navbar-expand-lg navbar-static-top bg-secondary text-uppercase" style="padding-top: 0%; padding-bottom: 0%;" id="mainNav">
        <div class="container"><a class="navbar-brand js-scroll-trigger" href="https://fjellserver.no">FJELLSERVER&nbsp;<img id="nav-logo" alt="logo" src="https://fjellserver.no/assets/img/Fjellserver%20-logo%20icon%20transparent.svg"></a>
        </div>
</nav>

<div class="container">
<h1>Artikler:</h1>
@foreach($artikler as $key => $data)
<h5>{{$data->kategori}}:</h5>
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{$data->tittel}}</h5>
    </div>
    <p class="mb-1">{{$data->tittel}}</p>
  </a>
  @endforeach
</div>
</div>

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
<script src="https://fjellserver.no/assets/js/jquery.min.js"></script>
    <script src="https://fjellserver.no/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://fjellserver.no/assets/js/year.js"></script>
</body>
</html>