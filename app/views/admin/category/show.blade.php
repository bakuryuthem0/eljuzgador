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
        <li class=""><a href="{{ URL::to('administrador/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="{{ Request::url() }}"><i class="fa fa-search"></i> Ver categorías</a></li>

      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-list"></i>
                  <h3 class="box-title">Ver categorías</h3>
                </div>
                <div class="box-body">
                  <div class="alert alert-danger hidden cat-full">
                    
                  </div>
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped menu-cat-table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Modificar</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($cat as $c)
                       <tr>
                       	<td>{{ $c->id }}</td>
                       	<td>{{ $c->description }}</td>
                        <td>
                          <a class="btn btn-warning btn-xs" target="_blank" href="{{ URL::to('administrador/categorias/ver-categorias/'.$c->id) }}"> 
                            Modificar
                          </a>
                        </td>
                       	<td>
                          <button class="btn btn-danger btn-xs btn-elim-cat" value="{{ $c->id}}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('administrador/categorias/eliminar') }}" data-tosend="cat_id"> 
                            Eliminar
                          </button>
                        </td>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Modificar</th>
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
        $(document).on('click','.menu_active', function(event) {
          var table = $('.menu-cat-table').DataTable();
          var checked = $(table.rows().nodes()).find('.menu_active:checked').length
          var check     = $(this);
          var length    = check.data('length');
          var max_text  = check.data('max-text');
          var url       = check.data('url');
          checkMenuCat(check, length, max_text, url, checked);
        });
      });
    </script>

@stop