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
            <li class=""><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#"><i class="fa fa-user-plus"></i> Nuevo usuario</a></li>
          </ol>
        </section>
        <div class="row">
          <div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Nuevo usuario</h3>
                </div>
                <div class="box-body chat" id="chat-box">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <form class="new-user-form" method="POST" action="{{ URL::to('administrador/usuario/nuevo/enviar') }}"> 
                    <div class="input-group">
                     <label class="">Nombre de usuario</label>
                     <input type="text" name="username" class="form-control validate-input" placeholder="Nombre de usuario" value="{{ Input::old('username') }}">
                     @if($errors->has('username'))
                        @foreach($errors->get('username') as $err)
                        <div class="clearfix"></div>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ $err }}
                        </div>
                        @endforeach
                      @endif
                    </div>
                    <div class="input-group">
                     <label class="">Contraseña</label>
                     <input type="password" name="password" class="form-control validate-input" placeholder="Contraseña" >
                     @if($errors->has('password'))
                        @foreach($errors->get('password') as $err)
                        <div class="clearfix"></div>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ $err }}
                        </div>
                        @endforeach
                      @endif
                    </div>
                    <div class="input-group">
                     <label class="">Repita la Contraseña</label>
                     <input type="password" name="password_confirmation" class="form-control validate-input" placeholder="Repita la Contraseña" >
                     @if($errors->has('password_confirmation'))
                        @foreach($errors->get('password_confirmation') as $err)
                        <div class="clearfix"></div>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ $err }}
                        </div>
                        @endforeach
                      @endif
                    </div>
                    <div class="input-group">
                     <label class="">Role</label>
                     <select class="form-control" name="role">
                      @foreach($roles as $r)
                        <option value="{{ $r->id }}">{{ $r->description }}</option>
                      @endforeach
                     </select>
                     @if($errors->has('role'))
                        @foreach($errors->get('role') as $err)
                        <div class="clearfix"></div>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ $err }}
                        </div>
                        @endforeach
                      @endif
                    </div>
                    <input type="hidden" name="status" class="status" value="1">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  </form>
                </div><!-- /.chat -->
                <div class="box-footer">
                  <button class="btn btn-success btn-send">Enviar</button>
                </div>
              </div><!-- /.box (chat box) -->

          </div>
        </div>

      </div><!-- /.content-wrapper -->
        
@stop