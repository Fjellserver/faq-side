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
          toolbar: "insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
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