@extends('layouts.admin')

@section('content')
@if(!empty($store->color_palet))
  <?php $colors = json_decode(stripslashes($store->color_palet)); ?>
@endif
<div class="content-wrapper">
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="col-xs-12 col-md-3">
            <div class="box">
              <div class="box-header box-primary with-border">
                <h3 class="box-title">Modificar Colores</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="formulario">
                  @if(Session::has('success') || Session::has('danger'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::has('success') ? Session::get('success') : Session::get('danger') }}
                  </div>
                  @endif
                  <form method="POST" action="{{ URL::to('administrador/tienda/editar-colores/enviar') }}" enctype="multipart/form-data" class="colors-form">
                    <div class="formulario bg-warning padding-1">
                      <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Todos los colores son obligatorios. Para cambiar el color, haga click en el campo, seleccione el color y por ultimo precione el boton <div class="colorpicker_submit text"></div></p>
                    </div>
                    <div class="visible-xs">
                      <div class="alert alert-info">
                        Se recomienda utilizar esta herramienta en un computador debido a incompatibilidad con algunos dispositivos moviles.
                      </div>
                    </div>
                      <div class="col-xs-12 formulario">
                        <label>Color de fondo (primario)</label>
                        <input type="text" name="first_background" class="colorPicker form-control" data-target=".first" data-type="background-color" @if(!is_null($store->color_palet) && !empty($store->color_palet))  value="{{ $colors->first->background_color }}" @endif>
                        @if($errors->has('first_background'))
                            @foreach($errors->get('first_background') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 formulario">
                        <label>Color del text (primario)</label>
                        <input type="text" name="first_color" class="colorPicker form-control" data-target=".first" data-type="color" @if(!is_null($store->color_palet) && !empty($store->color_palet))  value="{{ $colors->first->color }}" @endif>
                        @if($errors->has('first_color'))
                            @foreach($errors->get('first_color') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 formulario">
                        <label>Color de fondo (secundario)</label>
                        <input type="text" name="second_background" class="colorPicker form-control" data-target=".second" data-type="background-color" @if(!is_null($store->color_palet) && !empty($store->color_palet))  value="{{ $colors->second->background_color }}" @endif>
                        @if($errors->has('second_background'))
                            @foreach($errors->get('second_background') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 formulario">
                        <label>Color del text (secundario)</label>
                        <input type="text" name="second_color" class="colorPicker form-control" data-target=".second" data-type="color" @if(!is_null($store->color_palet) && !empty($store->color_palet))  value="{{ $colors->second->color }}" @endif>
                        @if($errors->has('second_color'))
                            @foreach($errors->get('second_color') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 formulario">
                        <label>Color de fondo (terciario)</label>
                        <input type="text" name="third_background" class="colorPicker form-control" data-target=".third" data-type="background-color" @if(!is_null($store->color_palet) && !empty($store->color_palet))  value="{{ $colors->third->background_color }}" @endif>
                        @if($errors->has('third_background'))
                            @foreach($errors->get('third_background') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 formulario">
                        <label>Color del text (terciario)</label>
                        <input type="text" name="third_color" class="colorPicker form-control" data-target=".third" data-type="color" @if(!is_null($store->color_palet) && !empty($store->color_palet))  value="{{ $colors->third->color }}" @endif>
                        @if($errors->has('third_color'))
                            @foreach($errors->get('third_color') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="formulario">
                        
                      </div>
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  </form>
                  <form method="POST" action="{{ URL::to('administrador/tienda/restablecer') }}" class="restore-form">
                    <input type="hidden" name="id" value="{{ $store->id }}">
                  </form>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <div class="formulario">
                  <button class="btn btn-success btn-send center-block formulario">Enviar</button>
                  <button class="btn btn-warning restore center-block formulario">Reestablecer colores por defecto</button>
                </div>
              </div><!-- box-footer -->
            </div><!-- /.box -->
          </div>
          <div class="col-xs-12 col-md-9">
            <iframe class="store_frame" src="{{ URL::to('inicio') }}"></iframe>
          </div>
          <div class="clearfix"></div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        
@stop

@section('postscript')
<link rel="stylesheet" media="screen" type="text/css" href="{{ asset('plugins/colorPicker/lib/colorpicker.css') }}" />
<script type="text/javascript" src="{{ asset('plugins/colorPicker/lib/colorpicker.js') }}"></script>

<script type="text/javascript">
  $('.store_frame').on('load', function(event) {
    var iframeDom = $($('.store_frame')[0].contentDocument);
    iframeDom.find('a').on('click', function(event) {
      event.preventDefault();
    });
    $('.colorPicker').on('focus', function(event) {
      $(this).addClass('focused')
    });
    $('.colorPicker').ColorPicker({
      onSubmit: function(hsb, hex, rgb, el) {
        $(el).val('#'+hex);
        $(el).ColorPickerHide();
      },
      onBeforeShow: function () {
        $(this).ColorPickerSetColor(this.value);
      },
      onChange: function (hsb, hex, rgb) {
        var input = $('.colorPicker.focused');
        input.val('#' + hex);
        var element = iframeDom.find(input.data('target'));
        if (input.data('type') === "color") {
          element.css(input.data('type'), '#'+hex).find('a,p,span,label,h1,h2,h3,h4,h5,h6,input,button,b,i,em,strong').css(input.data('type'), '#'+hex);
          //a,p,span,label,h1,h2,h3,h4,h5,h6,input,button,b,i,em,strong
        }else
        {
          element.css(input.data('type'), '#'+hex);
          
        }
      },
      onHide : function(hsb, hex, rgb, el){
        $('.colorPicker.focused').removeClass('focused')
      }
    })
    .bind('keyup', function(){
      $(this).ColorPickerSetColor(this.value);
    });
    $('.btn-send').on('click', function(event) {
      $('.colors-form').submit();
    });
    $('.restore').on('click', function(event) {
      $('.restore-form').submit();
    });
  });
</script>
@stop