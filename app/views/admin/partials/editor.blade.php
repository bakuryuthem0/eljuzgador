 {{ HTML::script('templates/admin/plugins/ckeditor/ckeditor.js') }}
 {{ HTML::script('templates/admin/plugins/ckeditor/config.js') }}

 <script>
   $(function () {
     // Replace the <textarea id="editor1"> with a CKEditor
     // instance, using default configuration.
     CKEDITOR.replace('editor1');
     //bootstrap WYSIHTML5 - text editor
   });
 </script>