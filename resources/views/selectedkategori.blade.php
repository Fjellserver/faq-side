<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>HJELP Rediger Kategori | Fjellserver.no</title>
    @include('layouts.meta')
</head>
<body>

<div class="d-flex flex-column min-vh-100">
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
<a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ route('redigerkategori')}}" role="button" onclick="return confirm('Er du sikker p&aring; at du vil gå tilbake?\nArtikkelen kan ikke gjennopprettes.')">Avbryt</a>
<h1>Oppdater en Kategori:</h1>
<form action="{{url('/dashboard/rediger/kategori/selectedkategori')}}" method="post">
@csrf
@foreach($kategori as $key => $data)
<div class="mb-3">
  <label for="navn" class="form-label">Kategori navn</label>
  <input type="text" class="form-control" id="navn" name="navn" placeholder="Navn på kategori" value="{{$data->navn}}" require>
</div>
<div class="mb-3">
  <label for="undertekst" class="form-label">Undertekst</label>
  <input type="text" class="form-control" id="undertekst" name="undertekst" placeholder="beskriv hva kategorien handler om" value="{{$data->undertekst}}" require>
</div>
<div class="mb-3">
  <label for="prioritering" class="form-label">Prioritering</label>
  <input type="number" class="form-control" name="prioritering" id="prioritering" placeholder="Gi arikkelen en prioritering jo høyere tall dersto høyere på siden kommer den" value="{{$data->prioritering}}" require>
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
      Skjul kategori
    </label>
  </div>
</div>
<div class="mb-3">
<label for="id" class="form-label">Kategori id</label>
<input type="number" class="form-control" name="id" id="id" value="{{$data->id}}" readonly>
<label for="delid" class="form-label">Skriv navnet på kategorien for å slette</label>
<input type="text" class="form-control" id="delid" name="delid" placeholder="La stå tom med mindre du vil slette kategorien" value="">
</div>
@endforeach
<div class="mb-3">
  <button type="submit" class="btn btn-primary">Oppdater</button>
</div>
</form>

</div>

@include('layouts.footer')
</body>
</html>
