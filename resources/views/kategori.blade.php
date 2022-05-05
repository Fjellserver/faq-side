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
  <div class="row">
    <div class="col">
    <h1 style="margin-top: 8px; margin-bottom: 8px;">Artikler:</h1>
    </div>
    <div class="col">
    <a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ route('faq')}}" role="button">Gå tilbake</a>
    </div>
  </div>
<div class="list-group">
@foreach($artikler as $key => $data)
  <a href="{!! url('/artikkel?artikkel=' . $data->tittel) !!}" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{!! $data->tittel !!}</h5>
    </div>
    <p class="mb-1">{!! $data->intro !!}</p>
  </a>
  @endforeach
</div>
</div>
@include('layouts.footer')
</body>
</html>