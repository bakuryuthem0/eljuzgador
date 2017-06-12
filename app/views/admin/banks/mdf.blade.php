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
      <li class="active"><a href="{{ Request::url() }}"><i class="fa fa-cogs"></i> Modificar Bancos</a></li>
    </ol>
  </section>
  <div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
      <div class="box box-success">
        <div class="box-header">
          <i class="fa fa-cogs"></i>
          <h3 class="box-title">Modificar Bancos</h3>
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
            <form class="new-user-form" method="POST" action="{{ URL::to('administrador/bancos/modificar/enviar') }}"  enctype="multipart/form-data">
              <div class="input-group">
                <label>(*) Nombre del banco</label>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Nombre del banco" name="bank_name" value="{{ $bank->name }}">
              </div>
              <div class="input-group">
                <label>(*) Tipo de cuenta</label>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Tipo de cuenta" name="account_type" value="{{ $bank->account_type }}">
              </div>
              <div class="input-group">
                <label>(*) Numero de cuenta</label>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Numero de cuenta" name="account_number" value="{{ $bank->account_number }}">
              </div>
              <div class="input-group">
                <label>(*) Identificador</label>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="(Cedula, Carnet de identificación)" name="identifier" value="{{ $bank->identifier }}">
              </div>
              <input type="hidden" name="bank_id" value="{{ $bank->id }}">
              {{ Form::token() }}
              
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

@stop