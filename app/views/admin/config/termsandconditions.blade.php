@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li class=""><a href="{{ URL::to('administrador') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{ Request::url() }}"><i class="fa fa-list"></i> Terminos y Condiciones</a></li>
    </ol>
  </section>
  <div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
      <div class="box box-success">
        <div class="box-header">
          <i class="fa fa-list"></i>
          <h3 class="box-title">Terminos y Condiciones</h3>
        </div>
        <div class="box-body chat" id="chat-box">
          @if(Session::has('success'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
          </div>
          @elseif(Session::has('danger'))
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('danger') }}
          </div>
          @endif
          <div class="alert responseAjax">
            <p></p>
          </div>
          <div class="col-xs-12">
            <form class="new-user-form" method="POST" action="{{ URL::to('administrador/terminos-y-condiciones/enviar') }}"  enctype="multipart/form-data">
              <div class="input-group">
                <label>(*) Terminos y Condiciones.</label>
              </div>
              <div class="">
                <textarea id="editor1" name="terms">@if(!empty($store_info->terms) || !is_null($store_info->terms)){{ $store_info->terms }}@endif</textarea>
              </div>
              @if($errors->has('terms'))
                @foreach($errors->get('terms') as $err)
                <div class="clearfix"></div>
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{ $err }}
                </div>
                @endforeach
              @endif
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
          </div>
          
        </div><!-- /.chat -->
        <div class="box-footer">
          <div class="col-xs-12"><button class="btn btn-success btn-new-user">Enviar</button></div>
        </div>
      </div><!-- /.box (chat box) -->
    </div>
  </div>
</div><!-- /.content-wrapper -->
        
@stop

@section('postscript')
 {{ HTML::script('admin/plugins/ckeditor/ckeditor.js') }}
 {{ HTML::script('admin/plugins/ckeditor/config.js') }}

 <script>
   $(function () {
     // Replace the <textarea id="editor1"> with a CKEditor
     // instance, using default configuration.
     CKEDITOR.replace('editor1');
     //bootstrap WYSIHTML5 - text editor
   });
 </script>
@stop