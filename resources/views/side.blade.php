<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>HJELP Rediger Side | Fjellserver.no</title>
    @include('layouts.meta')
    @include('layouts.tiny')
</head>
<body>

<div class="d-flex flex-column min-vh-100" id="page-top">
  @include('layouts.nav')

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
<a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ route('rediger')}}" role="button" onclick="return confirm('Er du sikker p&aring; at du vil gå tilbake?\nArtikkelen kan ikke gjennopprettes.')">Avbryt</a>
<h1>Oppdater en Artikkel:</h1>
<form action="{{url('/dashboard/rediger/side')}}" method="post">
@csrf
<div class="mb-3">
@foreach($artikkel as $key => $data)
  <label for="tittel" class="form-label">Artikkel navn</label>
  <input type="text" class="form-control" id="tittel" name="tittel" placeholder="Tittel på artikkel" value="{{$data->tittel}}" require>
  <label for="intro" class="form-label">Intro</label>
  <input type="text" class="form-control" id="intro" name="intro" placeholder="Intro på artikkelen" value="{{$data->intro}}" require>
</div>
<div class="mb-3">
  <label for="innhold" class="form-label">Artikkel Innhold</label>
  <textarea type="text" class="form-control" id="innhold" name="innhold" row="5" placeholder="Innhold">{{$data->innhold}}</textarea require>
</div>

<label for="KategoriDataList" class="form-label">Velg en kategori</label>
<input class="form-control" list="datalistOptions" id="KategoriDataList" name="KategoriDataList" placeholder="Søk..." value="{{$data->kategori}}">

<div class="mb-3">
<label for="short" class="form-label">Kort navn</label>
<input type="text" class="form-control" id="short" name="short" placeholder="Et kort navn" value="{{$data->short}}" require>
</div>
<script>
  function check()
{
  if (document.getElementById('sticky').checked) 
  {
      document.getElementById('sticky').value = 1;
  } else {
    document.getElementById('sticky').value = 0;
  }
}
function hidecheck()
{
  if (document.getElementById('hide').checked) 
  {
      document.getElementById('hide').value = 1;
  } else {
    document.getElementById('hide').value = 0;
  }
}
</script>
<div class="mb-3">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{$data->sticky}}" @if (isset($data->sticky)) @if ($data->sticky==1) checked @endif @endif id="sticky" name="sticky" onclick="check();">
    <label class="form-check-label" for="sticky">
      Fest øverst på siden
    </label>
  </div>
</div>
<div class="mb-3">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{$data->hide}}" @if (isset($data->hide)) @if ($data->hide==1) checked @endif @endif id="hide" name="hide" onclick="hidecheck();">
    <label class="form-check-label" for="hide">
      Skjul artikkel
    </label>
  </div>
</div>
<div class="mb-3">
<label for="id" class="form-label">Artikkel id</label>
<input type="number" class="form-control" name="id" id="id" value="{{$data->id}}" readonly>
<label for="delid" class="form-label">Skriv artikkelens tittel for å slette</label>
<input type="text" class="form-control" id="delid" name="delid" placeholder="La stå tom med mindre du vil slette artikkelen" value="">
@endforeach
<datalist id="datalistOptions">
@foreach($kategori as $key => $data)
  <option value="{{$data->navn}}">
  @endforeach
</datalist>
<button type="submit" class="btn btn-primary">Oppdater</button>
</div>
</form>

</div>

@include('layouts.footer')
</body>
</html>
