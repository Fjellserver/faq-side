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
<br>
<a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ url()->previous() }}" role="button">Gå tilbake</a>
@foreach($artikkel as $key => $data)
<h1>{{$data->tittel}}</h1>
<p>Sist endret: {{date("d.m.Y, H:i", strtotime($data->last_updated))}}</p>
<hr>
<p>{!! $data->innhold !!}</p>
@endforeach
</div>
</div>
@include('layouts.footer')
</body>
</html>