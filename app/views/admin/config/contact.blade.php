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
      <li class="active"><a href="{{ Request::url() }}"><i class="fa fa-envelope-o"></i> Información de Contacto</a></li>
    </ol>
  </section>
  <div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
      <div class="box box-success">
        <div class="box-header">
          <i class="fa fa-envelope-o"></i>
          <h3 class="box-title">Información de Contacto</h3>
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
            <form class="new-user-form" method="POST" action="{{ URL::to('administrador/contacto/enviar') }}"  enctype="multipart/form-data">
              <div class="formulario">
                <label>(*) Nombre.</label>
              </div>
              <div class="formulario">
                <input type="text" name="name" value="{{ $store_info->name }}" class="form-control">
              </div>
              @if($errors->has('name'))
                @foreach($errors->get('name') as $err)
                <div class="clearfix"></div>
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{ $err }}
                </div>
                @endforeach
              @endif
              <div class="formulario">
                <label>(*) Telefono.</label>
              </div>
              <div class="formulario">
                <input type="text" name="phone" value="{{ $store_info->phone }}" class="form-control">
              </div>
              @if($errors->has('phone'))
                @foreach($errors->get('phone') as $err)
                <div class="clearfix"></div>
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{ $err }}
                </div>
                @endforeach
              @endif
              <div class="formulario">
                <label>(*) Dirección.</label>
              </div>
              <div class="formulario">
                <textarea name="address" class="form-control">{{ $store_info->address }}</textarea>
              </div>
              @if($errors->has('address'))
                @foreach($errors->get('address') as $err)
                <div class="clearfix"></div>
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{ $err }}
                </div>
                @endforeach
              @endif
              <div class="formulario">
                <label>(*) Mapa. <i class="fa fa-info-circle text-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-trigger="hover" data-content="En este campo puede agregar la ubicación de su tienda mediante google maps. <br><br>Solo vaya a google maps <i class='fa fa-arrow-right'></i> busque su ubicación <i class='fa fa-arrow-right'></i> seleccione compartir <i class='fa fa-arrow-right'></i> insertar mapa y por ultimo copie el texto del iframe"></i></label>
              </div>
              <div class="formulario">
                <input type="text" name="map" value="" class="form-control">
                <div class="maps">@if(!is_null($store_info->map)){{ $store_info->map }}@endif</div>
              </div>
              @if($errors->has('map'))
                @foreach($errors->get('map') as $err)
                <div class="clearfix"></div>
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{ $err }}
                </div>
                @endforeach
              @endif
              <div class="formulario">
                <label>Email de contacto: @if(!empty($store_info->email) || !is_null($store_info->emails)){{ $store_info->email }} @else {{ $store->store_email }}@endif</label>
              </div>
              <div class="formulario">
                Cambiar email de contacto
                <input type="text" name="email" class="form-control" value="@if(!empty($store_info->email) || !is_null($store_info->emails)){{ $store_info->email }}@else{{ $store->store_email }}@endif">
              </div>
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
<script type="text/javascript">
  $(function () {
    $('[data-toggle="popover"]').popover()
  }) 
</script>
@stop