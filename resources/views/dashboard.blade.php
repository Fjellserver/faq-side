<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b">
    <link rel="icon" type="image/png" sizes="36x36" href="{{url('/img/android-icon-36x36.png')}}">
    <title>Fjellserver.no | FAQ Dashboard</title>
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
<h1>Lag en Artikkel:</h1>
<form action="" method="post">
@csrf
<div class="mb-3">
  <label for="tittel" class="form-label">Artikkel navn</label>
  <input type="text" class="form-control" id="tittel" placeholder="Tittel på artikkel" require>
</div>
<div class="mb-3">
  <label for="innhold" class="form-label">Artikkel Innhold</label>
  <textarea  type="text" class="form-control" id="innhold" row="5" placeholder="Innhold"></textarea require>
</div>
<label for="KategoriDataList" class="form-label">Velg en kategori</label>
<input class="form-control" list="datalistOptions" id="KategoriDataList" placeholder="Søk...">
<datalist id="datalistOptions">
  <option value="Kategori navn 1">
  <option value="Kategori navn 2">
  <option value="Kategori navn 3">
</datalist>
<div class="mb-3">
  <label for="video" class="form-label">Video URL</label>
  <input  type="text" class="form-control" id="video" placeholder="Innhold">
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
    <li class="list-group-item"><h5>Kategori navn 1</h5><p>undertekst</p></li>
    <li class="list-group-item"><h5>Kategori navn 2</h5><p>undertekst</p></li>
    <li class="list-group-item"><h5>Kategori navn 3</h5><p>undertekst</p></li>
    </ul>
</div>

</body>
</html>