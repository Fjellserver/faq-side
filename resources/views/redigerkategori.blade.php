<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>HJELP Dashboard rediger | Fjellserver.no</title>
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
<a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ route('dashboard')}}" role="button">Gå tilbake</a>
<h1>Katogorier:</h1>
<div class="list-group" style="margin-top: 8px; margin-bottom: 8px;">
@foreach($kategori as $key => $data)
  <a href="{{ url('/dashboard/rediger/kategori/selectedkategori?kategori=' . $data->id) }}" class="list-group-item list-group-item-action" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{$data->navn}}</h5>
    </div>
    <p class="mb-1">{{$data->undertekst}}</p>
    <p class="mb-1"><b>Sist endret:</b> {{$data->last_updated}}</p>
  </a>
  @endforeach
</div>
</div>

@include('layouts.footer')
</body>
</html>