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

<div class="d-flex flex-column min-vh-100" name="top">
  @include('layouts.nav')

<div class="container">
<br>
<a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ url()->previous() }}" role="button">Gå tilbake</a>
@foreach($artikkel as $key => $data)
<h1>{{$data->tittel}}</h1>
<p>Sist endret: {{date("d.m.Y, H:i", strtotime($data->last_updated))}}</p>
<hr>
<p>{!! $data->innhold !!}</p>
@endforeach
<hr>
<a href="#top"><p class="text-center">Ta meg til toppen</p></a>
<h1 style="margin-top: 8px; margin-bottom: 8px;">Andre Kategorier:</h1>
<div class="list-group">
@foreach($kategori as $key => $data)
  <a href="{{ url('/kategori?kategori=' . $data->navn) }}" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{$data->navn}}</h5>
      <!-- <span class="badge bg-primary rounded-pill d-flex justify-content-between align-items-center text-white">14</span> -->
    </div>
    <p class="mb-1">{{$data->undertekst}}</p>
  </a>
  @endforeach
</div>
</div>
@include('layouts.footer')
</body>
</html>