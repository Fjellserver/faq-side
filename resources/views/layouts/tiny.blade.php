<!-- TinyMCE editor -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.tiny.cloud/1/t16tdhk8qomhysh45tj4xxfg99e4lw0mbx6f12yrcpojbnje/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
      tinymce.init({
          selector: 'textarea',
          image_class_list: [
              {title: 'img-responsive', value: 'img-fluid'},
          ],
          height: 500,
          promotion: false,
          setup: function (editor) {
              editor.on('init change', function () {
                  editor.save();
              });
          },
          // TinyMCE 7: "paste" is built in, "imagetools" became the premium "editimage"
          // plugin and "print" was removed, so they are no longer listed here.
          plugins: 'advlist autolink lists link image charmap preview anchor media searchreplace visualblocks code fullscreen insertdatetime table',
          toolbar: 'undo redo | styles | fontsize | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | searchreplace visualblocks code fullscreen',
          content_style: "body {font-size: 14pt;}",
          image_title: true,
          image_caption: true,
          automatic_uploads: true,
          file_picker_types: 'image',
          // Upload images with the session CSRF token so the /upload route is protected
          // like every other state-changing route. TinyMCE 7 expects a Promise that
          // resolves with the stored image URL.
          images_upload_handler: function (blobInfo, progress) {
              return new Promise(function (resolve, reject) {
                  var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                  var xhr = new XMLHttpRequest();

                  xhr.withCredentials = true;
                  xhr.open('POST', '/upload');
                  xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                  xhr.setRequestHeader('Accept', 'application/json');

                  xhr.upload.onprogress = function (e) {
                      progress(e.loaded / e.total * 100);
                  };

                  xhr.onload = function () {
                      var json = null;
                      try { json = JSON.parse(xhr.responseText); } catch (e) {}

                      if (xhr.status === 422) {
                          reject({ message: (json && json.message) || 'Filen ble avvist. Kun bilder (jpg, png, gif, webp) opptil 5 MB er tillatt.', remove: true });
                          return;
                      }

                      if (xhr.status < 200 || xhr.status >= 300) {
                          reject({ message: 'Opplasting feilet (HTTP ' + xhr.status + ')', remove: xhr.status === 403 || xhr.status === 419 });
                          return;
                      }

                      if (!json || typeof json.location !== 'string') {
                          reject('Ugyldig svar fra serveren');
                          return;
                      }

                      resolve(json.location);
                  };

                  xhr.onerror = function () {
                      reject('Opplasting feilet på grunn av en nettverksfeil.');
                  };

                  var formData = new FormData();
                  formData.append('file', blobInfo.blob(), blobInfo.filename());
                  xhr.send(formData);
              });
          },
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
