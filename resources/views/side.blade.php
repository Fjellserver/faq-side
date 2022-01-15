<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>HJELP Rediger Side | Fjellserver.no</title>
    <meta property="og:type" content="website">
    <link rel="icon" type="image/png" sizes="36x36" href="https://fjellserver.no/assets/img/android-icon-36x36.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://fjellserver.no/assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="https://fjellserver.no/assets/img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="https://fjellserver.no/assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="mask-icon" href="https://fjellserver.no/assets/img/safari-pinned-tab.svg" color="#1b316b">
    <link rel="shortcut icon" href="https://fjellserver.no/assets/img/favicon.ico">
    <meta name="msapplication-config" content="https://fjellserver.no/assets/img/browserconfig.xml">
    <link rel="stylesheet" href="https://fjellserver.no/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://fjellserver.no/assets/css/logo.css">
    <link rel="stylesheet" href="https://fjellserver.no/assets/css/main.css">
    <!-- TinyMCE editor -->
    <script src="https://cdn.tiny.cloud/1/t16tdhk8qomhysh45tj4xxfg99e4lw0mbx6f12yrcpojbnje/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script type="text/javascript">
        tinymce.init({
            selector: 'textarea',

            image_class_list: [
            {title: 'img-responsive', value: 'img-responsive'},
            ],
            height: 500,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
            },
            plugins: [
                "advlist autolink lists link image charmap print preview anchor media",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media ",

            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/upload',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            }
        });
  </script>
</head>
<body>

<div class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-light navbar-expand-lg navbar-static-top bg-secondary text-uppercase" style="padding-top: 0%; padding-bottom: 0%;" id="mainNav">
        <div class="container"><a class="navbar-brand js-scroll-trigger" href="https://hjelp.fjellserver.no">FJELLSERVER&nbsp;<img id="nav-logo" alt="logo" src="https://fjellserver.no/assets/img/Fjellserver%20-logo%20icon%20transparent.svg"></a>
        <h2 class="text-white">Hjelpeside ADMIN</h2>
        </div>
</nav>

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
<a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ route('rediger')}}" role="button">Gå tilbake</a>
<h1>Oppdater en Artikkel:</h1>
<form action="{{url('/dashboard/rediger/side')}}" method="post">
@csrf
<div class="mb-3">
@foreach($artikkel as $key => $data)
  <label for="tittel" class="form-label">Artikkel navn</label>
  <input type="text" class="form-control" id="tittel" name="tittel" placeholder="Tittel på artikkel" value="{{$data->tittel}}" require>
</div>
<div class="mb-3">
  <label for="innhold" class="form-label">Artikkel Innhold</label>
  <textarea  type="text" class="form-control" id="innhold" name="innhold" row="5" placeholder="Innhold">{{$data->innhold}}</textarea require>
</div>

<label for="KategoriDataList" class="form-label">Velg en kategori</label>
<input class="form-control" list="datalistOptions" id="KategoriDataList" name="KategoriDataList" placeholder="Søk..." value="{{$data->kategori}}">

<label for="short" class="form-label">Kort navn</label>
<input type="text" class="form-control" id="short" name="short" placeholder="Et kort navn" value="{{$data->short}}" require>
<label for="id" class="form-label">Artikkel id</label>
<input type="number" class="form-control" name="id" id="id" value="{{$data->id}}" readonly>
@endforeach
<datalist id="datalistOptions">
@foreach($kategori as $key => $data)
  <option value="{{$data->navn}}">
  @endforeach
</datalist>
<button type="submit" class="btn btn-primary">Oppdater</button>
</form>

</div>

<main class="flex-fill"></main>
<footer class="footer text-center" style="background-color: #1B316B; padding-bottom: 0%; padding-top: 0%;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4"></h4>
                <p></p>
            </div>
            <div class="col-md-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase"><strong>sosialt</strong></h4>
                <ul class="list-inline">
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="Facebook" href="https://www.facebook.com/fjellserver/" target="_blank" rel="noopener"><i class="fab fa-facebook-f fa-fw"></i></a></li>
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="Instagram" href="https://www.instagram.com/fjellserver/"><i class="fab fa-instagram fa-fw"></i></a></li>
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="Discord" href="https://discord.gg/STX8gt6"><i class="fab fa-discord fa-fw"></i></a></li>
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="YouTube" href="https://www.youtube.com/channel/UCTLsqpKLdkaYBMEgY2Ogpzg/"><i class="fab fa-youtube fa-fw"></i></a></li>
                    <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" aria-label="E-post" href="mailto:kontakt@fjellserver.no"><i class="fas fa-envelope fa-fw"></i></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4 class="text-uppercase mb-4"></h4>
                <p class="lead mb-0"><span></span></p>
            </div>
        </div>
    </div>
    <div class="copyright py-4 text-center text-white" style="background-color: #2c3e50;">
        <div class="container">
        <small id="year">Opphavsrett © Fjellserver 2019 -&nbsp;</small>
        <br>
        <small>Fjellserver.no er på ingen måte tilknyttet/levert/drevet/støttet av Mojang AB eller Microsoft.</small>
        </div>
    </div>
</footer>
</div>
<script src="https://fjellserver.no/assets/js/jquery.min.js"></script>
    <script src="https://fjellserver.no/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://fjellserver.no/assets/js/year.js"></script>
</body>
</html>
