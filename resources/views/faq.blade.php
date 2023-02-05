<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>Hjelpeside | Fjellserver.no</title>
    @include('layouts.meta')
</head>
<body>

<div class="d-flex flex-column min-vh-100">
  @include('layouts.nav')

<div class="container">
<h1 style="margin-top: 8px; margin-bottom: 8px;">Kategorier:</h1>
<div class="list-group">
@foreach($kategori as $key => $data)
  <a href="{{ url('/kategori?kategori=' . $data->navn) }}" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1" style="line-height: 110%;">{{$data->navn}}</h5>
      {{-- <span class="badge bg-primary rounded-pill d-flex justify-content-between align-items-center text-white">14</span> --}}
    </div>
    <p class="mb-1" style="line-height: 110%;">{{$data->undertekst}}</p>
  </a>
  @endforeach
</div>
</div>
</div>
@include('layouts.footer')
</body>
</html>