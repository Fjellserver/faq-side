<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b">
    <link rel="icon" type="image/png" sizes="36x36" href="{{url('/img/android-icon-36x36.png')}}">
    <title>Fjellserver.no | FAQ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{url('/css/style.css')}}">
</head>
<body>

<section class="bannerarea">
  <div class="container">
      <div class="row">
        <div class="d-flex flex-row">
            <h1 class="text-white p-2">Fjellserver.no</h1>
            <img class="p-2" src="{{url('/img/Fjellserver-logo-icon-transparent.svg')}}" alt="Fjellserver logo" width="60" height="60">
       </div>
  </div>
</section>

<div class="container">
<h1>Kategorier:</h1>
<div class="list-group">
@foreach($kategori as $key => $data)
  <a href="#" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{$data->navn}}</h5>
      <span class="badge bg-primary rounded-pill d-flex justify-content-between align-items-center text-white">14</span>
    </div>
    <p class="mb-1">{{$data->undertekst}}</p>
  </a>
  @endforeach
</div>
</div>

<div class="container">
<h1>Artikler:</h1>
<h5>Generelt</h5>
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Hvordan..</h5>
    </div>
    <p class="mb-1">Some placeholder content in a paragraph.</p>
  </a>
  <a href="#" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Kan jeg..?</h5>
    </div>
    <p class="mb-1">Some placeholder content in a paragraph.</p>
  </a>
  <a href="#" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Slik får du..?</h5>
    </div>
    <p class="mb-1">Some placeholder content in a paragraph.</p>
  </a>
</div>
</div>

</body>
</html>