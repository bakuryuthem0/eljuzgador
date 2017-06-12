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
        <li class="active"><a href="#"><i class="fa fa-search"></i> Ver usuarios</a></li>
      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Ver usuarios</h3>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre de Usuario</th>
                          <th>Rol</th>
                          <th>Cambiar contraseña</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($users as $u)
                       <tr>
                       	<td>{{ $u->id }}</td>
                       	<td>{{ $u->username }}</td>
                       	<td>{{ $u->roles->description }}</td>
                       	<td><button class="btn btn-warning btn-xs btn-change-pass" value="{{ $u->id}}" data-toggle="modal" data-target="#changePass">Cambiar</button></td>
                       	<td>
                          <button class="btn btn-danger btn-xs btn-elim-user" value="{{ $u->id}}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('administrador/eliminar-usuario') }}" data-tosend="id"> 
                            Eliminar
                          </button>
                        </td>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Nombre de Usuario</th>
                          <th>Rol</th>
                          <th>Cambiar contraseña</th>
                          <th>Eliminar</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div><!-- /.box-body -->
      		</div>
    	</div>

  	</div><!-- /.content-wrapper -->
</div>  
<div class="modal fade" id="changePass">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cambiar contraseña</h4>
			</div>
			<div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
				<div class="input-group">
					<label class="">Contraseña</label>
					<input type="password" name="password" class="form-control validate-input password" placeholder="Contraseña" >
				</div>
				<div class="input-group">
					<label class="">Repita la Contraseña</label>
					<input type="password" name="password_confirmation" class="form-control validate-input password_confirmation" placeholder="Repita la Contraseña" >
				</div>
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-warning send-change-pass" data-url="{{ URL::to('administrador/usuario/perfil/cambiar-contrasena/enviar') }}">Cambiar</button>
			</div>
		</div>
	</div>
</div>
{{ View::make('partials.modalElim') }}
{{ Form::token() }}

@stop

@section('postscript')
    {{ HTML::style('templates/admin/plugins/datatables/dataTables.bootstrap.css') }}
    {{ HTML::script('templates/admin/plugins/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('templates/admin/plugins/datatables/dataTables.bootstrap.min.js') }}
    <script>
      $(function () {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>

@stop