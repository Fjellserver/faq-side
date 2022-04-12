<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>HJELP Dashboard rediger | Fjellserver.no</title>
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
        <h2 class="text-white">Hjelpeside ADMIN</h2>
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
<a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ route('dashboard')}}" role="button">Gå tilbake</a>
<h1>Rediger en artikkel:</h1>
<div class="list-group" style="margin-top: 8px; margin-bottom: 8px;">
@foreach($artikler as $key => $data)
  <a href="{{ url('/dashboard/rediger/side?artikkel=' . $data->tittel) }}" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{$data->tittel}}</h5>
    </div>
    <p class="mb-1">Kategori: {{$data->kategori}}</p>
    <p class="mb-1">Sist endret: {{$data->last_updated}}</p>
  </a>
  @endforeach
</div>
</div>

<main class="flex-fill"></main>
<footer class="footer text-center" style="padding-bottom: 0%; padding-top: 0%;">
    <section style="background-color: black;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="white" fill-opacity="1"
          d="M0,192L80,181.3C160,171,320,149,480,170.7C640,192,800,256,960,261.3C1120,267,1280,213,1360,186.7L1440,160L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
        </path>
      </svg>
      <h4 class="text-uppercase"><strong>sosialt</strong></h4>
      <ul class="list-inline">
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="Facebook" href="https://www.facebook.com/fjellserver/" target="_blank"
            rel="noopener"><i class="fab fa-facebook-f fa-fw"></i></a></li>
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="Instagram" href="https://www.instagram.com/fjellserver/"><i
              class="fab fa-instagram fa-fw"></i></a></li>
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="Discord" href="https://discord.gg/STX8gt6"><i
              class="fab fa-discord fa-fw"></i></a></li>
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="YouTube" href="https://www.youtube.com/channel/UCTLsqpKLdkaYBMEgY2Ogpzg/"><i
              class="fab fa-youtube fa-fw"></i></a></li>
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="E-post" href="mailto:kontakt@fjellserver.no"><i
              class="fas fa-envelope fa-fw"></i></a></li>
      </ul>

      <div class="row">
        <div class="col-md">
          <a class="font-weight-bold text-uppercase" style="font-size: 1.3rem; color: white;">Juridisk</a>
          <div class="col-md">
            <a href="https://fjellserver.no/retningslinjer/" style="color: white;">Retningslinjer</a>
          </div>
          <div class="col-md">
            <a href="https://fjellserver.no/salgsbetingelser/" style="color: white;">Salgsbetingelser</a>
          </div>
          <div class="col-md">
            <a href="https://account.mojang.com/documents/minecraft_eula" style="color: white;">EULA</a>
          </div>
          <div class="col-md">
            <a href="https://fjellserver.no/informasjonskapsler/" style="color: white;">Informasjonskapsler</a>
          </div>
        </div>

        <div class="col-md">
          <a class="font-weight-bold text-uppercase" style="font-size: 1.3rem; color: white;">Verktøy</a>
          <div class="col-md">
            <a href="https://status.fjellserver.no/" style="color: white;">Systemstatus</a>
          </div>
          <div class="col-md">
            <a href="https://hjelp.fjellserver.no" style="color: white;">Hjelp/FAQ</a>
          </div>
          <div class="col-md">
            <a href="https://fjellserver.no/kontakt" style="color: white;">Kontakt oss</a>
          </div>
        </div>

        <div class="col-md">
          <a class="font-weight-bold text-uppercase" style="font-size: 1.3rem; color: white;">Snarveier</a>
          <div class="col-md">
            <a href="http://kunde.fjellserver.no/" style="color: white;">Kundeportal</a>
          </div>
          <div class="col-md">
            <a href="https://panel.fjellserver.no/" style="color: white;">Kontrollpanel</a>
          </div>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#2c3e50" fill-opacity="1"
          d="M0,256L40,261.3C80,267,160,277,240,256C320,235,400,181,480,144C560,107,640,85,720,85.3C800,85,880,107,960,133.3C1040,160,1120,192,1200,218.7C1280,245,1360,267,1400,277.3L1440,288L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
      </svg>
    </section>
    <div class="copyright py-4 text-center text-white" style="background-color: #2c3e50;">
      <div class="container">
        <small id="year">Opphavsrett © Fjellserver 2019 -&nbsp;</small>
        <br>
        <small>Fjellserver.no er på ingen måte tilknyttet/levert/drevet/støttet av Mojang AB eller Microsoft.</small>
        <br>
        <small>Fjellserver.no eies av Batalden Data Org.nr 928 144 488</small>
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