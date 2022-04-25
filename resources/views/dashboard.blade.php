<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#1b316b"/>
    <title>HJELP Dashboard | Fjellserver.no</title>
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
                "advlist autolink autosave lists link image charmap print preview anchor media",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | restoredraft",
            mobile: { theme: 'mobile' },
            content_style: "body {font-size: 14pt;}",
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
<a class="btn btn-primary btn-lg float-right" style="margin-top: 8px;" href="{{ route('rediger')}}" role="button">Rediger en artikkel</a>
<h1>Lag en Artikkel:</h1>
<form action="{{url('dashboard/artikkel')}}" method="post">
@csrf
<div class="mb-3">
  <label for="tittel" class="form-label">Artikkel navn</label>
  <input type="text" class="form-control" id="tittel" name="tittel" placeholder="Tittel på artikkel" require>
</div>
<div class="mb-3">
  <label for="intro" class="form-label">Intro</label>
  <input type="text" class="form-control" id="intro" name="intro" placeholder="Intro på artikkelen" require>
</div>
<div class="mb-3">
  <label for="innhold" class="form-label">Innhold</label>
  <textarea type="text" class="form-control" id="innhold" name="innhold" row="5" placeholder="Innhold"></textarea require>
</div>
<div class="mb-3">
<label for="KategoriDataList" class="form-label">Velg en kategori</label>
<input class="form-control" list="datalistOptions" id="KategoriDataList" name="KategoriDataList" placeholder="Søk...">
<datalist id="datalistOptions">
@foreach($kategori as $key => $data)
  <option value="{{$data->navn}}">
  @endforeach
</datalist>
</div>
<div class="mb-3">
    <label for="short" class="form-label">Et kort navn</label>
    <input type="text" class="form-control" id="short" name="short" placeholder="Et kort navn" require>
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
    <input class="form-check-input" type="checkbox" value="0" id="sticky" name="sticky" onclick="check();">
    <label class="form-check-label" for="sticky">
      Fest øverst på siden
    </label>
  </div>
</div>
<div class="mb-3">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="0" id="hide" name="hide" onclick="hidecheck();">
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
    <input type="text" class="form-control" id="navn" name="navn" placeholder="Kategori navn">
  </div>
  <div class="mb-3">
    <label for="undertekst" class="form-label">Kategori undertekst</label>
    <input type="text" class="form-control" id="undertekst" name="undertekst" placeholder="Hva handler kategorien om?">
  </div>
  <div class="mb-3">
    <label for="prioritering" class="form-label">Prioritering</label>
    <input type="number" class="form-control" name="prioritering" id="prioritering" placeholder="Gi arikkelen en prioritering jo høyere tall dersto høyere på siden kommer den">
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
      <input class="form-check-input" type="checkbox" value="0" id="stickykategori" name="sticky" onclick="kategoricheck();">
      <label class="form-check-label" for="sticky">
        Fest øverst på siden
      </label>
    </div>
  </div>
  <div class="mb-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="0" id="hidekategori" name="hide" onclick="kategorihidecheck();">
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

<main class="flex-fill"></main>
<footer class="footer text-center" style="padding-bottom: 0%; padding-top: 0%;">
    <section style="background-color: black;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="white" fill-opacity="1"
          d="M0,192L80,181.3C160,171,320,149,480,170.7C640,192,800,256,960,261.3C1120,267,1280,213,1360,186.7L1440,160L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
        </path>
      </svg>
      <h4 class="text-uppercase"><strong>sosialt</strong></h4>
      <ul class="list-inline">
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="Facebook" href="https://www.facebook.com/fjellserver/" target="_blank"
            rel="noopener"><i class="fab fa-facebook-f fa-fw"></i></a></li>
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="Instagram" href="https://www.instagram.com/fjellserver/"><i
              class="fab fa-instagram fa-fw"></i></a></li>
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="Discord" href="https://discord.gg/STX8gt6"><i
              class="fab fa-discord fa-fw"></i></a></li>
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="YouTube" href="https://www.youtube.com/channel/UCTLsqpKLdkaYBMEgY2Ogpzg/"><i
              class="fab fa-youtube fa-fw"></i></a></li>
        <li class="list-inline-item"><a class="btn btn-outline-light btn-social text-center rounded-circle"
            role="button" aria-label="E-post" href="mailto:kontakt@fjellserver.no"><i
              class="fas fa-envelope fa-fw"></i></a></li>
      </ul>

      <div class="row">
        <div class="col-md">
          <a class="font-weight-bold text-uppercase" style="font-size: 1.3rem; color: white;">Juridisk</a>
          <div class="col-md">
            <a href="https://fjellserver.no/retningslinjer/" style="color: white;">Retningslinjer</a>
          </div>
          <div class="col-md">
            <a href="https://fjellserver.no/salgsbetingelser/" style="color: white;">Salgsbetingelser</a>
          </div>
          <div class="col-md">
            <a href="https://account.mojang.com/documents/minecraft_eula" style="color: white;">EULA</a>
          </div>
          <div class="col-md">
            <a href="https://fjellserver.no/informasjonskapsler/" style="color: white;">Informasjonskapsler</a>
          </div>
        </div>

        <div class="col-md">
          <a class="font-weight-bold text-uppercase" style="font-size: 1.3rem; color: white;">Verktøy</a>
          <div class="col-md">
            <a href="https://status.fjellserver.no/" style="color: white;">Systemstatus</a>
          </div>
          <div class="col-md">
            <a href="https://hjelp.fjellserver.no" style="color: white;">Hjelp/FAQ</a>
          </div>
          <div class="col-md">
            <a href="https://fjellserver.no/kontakt" style="color: white;">Kontakt oss</a>
          </div>
        </div>

        <div class="col-md">
          <a class="font-weight-bold text-uppercase" style="font-size: 1.3rem; color: white;">Snarveier</a>
          <div class="col-md">
            <a href="http://kunde.fjellserver.no/" style="color: white;">Kundeportal</a>
          </div>
          <div class="col-md">
            <a href="https://panel.fjellserver.no/" style="color: white;">Kontrollpanel</a>
          </div>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#2c3e50" fill-opacity="1"
          d="M0,256L40,261.3C80,267,160,277,240,256C320,235,400,181,480,144C560,107,640,85,720,85.3C800,85,880,107,960,133.3C1040,160,1120,192,1200,218.7C1280,245,1360,267,1400,277.3L1440,288L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
      </svg>
    </section>
    <div class="copyright py-4 text-center text-white" style="background-color: #2c3e50;">
      <div class="container">
        <small id="year">Opphavsrett © Fjellserver 2019 -&nbsp;</small>
        <br>
        <small>Fjellserver.no er på ingen måte tilknyttet/levert/drevet/støttet av Mojang AB eller Microsoft.</small>
        <br>
        <small>Fjellserver.no eies av Batalden Data Org.nr 928 144 488</small>
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