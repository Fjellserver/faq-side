<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>HJELP Dashboard | Fjellserver.no</title>
    @include('layouts.meta')
    @include('layouts.tiny')
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
<a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ route('rediger')}}" role="button">Rediger en artikkel</a>
<h1>Lag en Artikkel:</h1>
<form action="{{url('dashboard/artikkel')}}" method="post">
@csrf
<div class="mb-3">
  <label for="tittel" class="form-label">Artikkel navn</label>
  <input type="text" class="form-control" id="tittel" name="tittel" placeholder="Tittel på artikkel" value="{{ old('tittel') }}">
</div>
<div class="mb-3">
  <label for="intro" class="form-label">Intro</label>
  <input type="text" class="form-control" id="intro" name="intro" placeholder="Intro på artikkelen" value="{{ old('intro') }}">
</div>
<div class="mb-3">
  <label for="innhold" class="form-label">Innhold</label>
  <textarea type="text" class="form-control" id="innhold" name="innhold" row="5" placeholder="Innhold">{{ old('innhold') }}</textarea>
</div>
<div class="mb-3">
<label for="KategoriDataList" class="form-label">Velg en kategori</label>
<input class="form-control" list="datalistOptions" id="KategoriDataList" name="KategoriDataList" placeholder="Søk..." value="{{ old('KategoriDataList') }}">
<datalist id="datalistOptions">
@foreach($kategori as $key => $data)
  <option value="{{$data->navn}}">
  @endforeach
</datalist>
</div>
<div class="mb-3">
    <label for="short" class="form-label">Et kort navn</label>
    <input type="text" class="form-control" id="short" name="short" placeholder="Et kort navn" value="{{ old('short') }}">
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
    <input class="form-check-input" type="checkbox" value="0" id="sticky" name="sticky" onclick="check();" @if (old('sticky')==1) checked @endif>
    <label class="form-check-label" for="sticky">
      Fest øverst på siden
    </label>
  </div>
</div>
<div class="mb-3">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="0" id="hide" name="hide" onclick="hidecheck();" @if (old('hide')==1) checked @endif>
    <label class="form-check-label" for="hide">
      Skjul artikkel
    </label>
  </div>
</div>
<div class="mb-3">
<button type="submit" class="btn btn-primary">Publiser</button>
</div>
</form>
</div>

<div class="container">
  <div class="mb-3">
  <a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ route('redigerkategori')}}" role="button">Endre en kategori</a>
  <h1>Lag en Kategori:</h1>
  </div>
<form action="{{url('dashboard/kategori')}}" method="post">
@csrf
  <div class="mb-3">
    <label for="navn" class="form-label">Kategori navn</label>
    <input type="text" class="form-control" id="navn" name="navn" placeholder="Kategori navn" value="{{ old('navn') }}">
  </div>
  <div class="mb-3">
    <label for="undertekst" class="form-label">Kategori undertekst</label>
    <input type="text" class="form-control" id="undertekst" name="undertekst" placeholder="Hva handler kategorien om?" value="{{ old('undertekst') }}">
  </div>
  <div class="mb-3">
    <label for="prioritering" class="form-label">Prioritering</label>
    <input type="number" class="form-control" name="prioritering" id="prioritering" placeholder="Gi arikkelen en prioritering jo høyere tall dersto høyere på siden kommer den" value="{{ old('prioritering') }}">
  </div>
  <script>
    function kategoricheck()
  {
    if (document.getElementById('stickykategori').checked) 
    {
        document.getElementById('stickykategori').value = 1;
    } else {
      document.getElementById('stickykategori').value = 0;
    }
  }
  function kategorihidecheck()
  {
    if (document.getElementById('hidekategori').checked) 
    {
        document.getElementById('hidekategori').value = 1;
    } else {
      document.getElementById('hidekategori').value = 0;
    }
  }
  </script>
  <div class="mb-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="0" id="stickykategori" name="sticky" onclick="kategoricheck();" @if (old('sticky')==1) checked @endif>
      <label class="form-check-label" for="sticky">
        Fest øverst på siden
      </label>
    </div>
  </div>
  <div class="mb-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="0" id="hidekategori" name="hide" onclick="kategorihidecheck();" @if (old('hide')==1) checked @endif>
      <label class="form-check-label" for="hide">
        Skjul artikkel
      </label>
    </div>
  </div>
  <div class="mb-3">
  <button type="submit" class="btn btn-primary">Legg til</button>
  </form>
  </div>
</div>
@include('layouts.footer')
</body>
</html>