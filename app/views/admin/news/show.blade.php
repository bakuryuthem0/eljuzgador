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
        <li class="active"><a href="#"><i class="fa fa-shopping-bag"></i> Ver productos</a></li>
      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-11 center-block formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Ver productos</h3>
                </div>
                <div class="box-body">
                  <div class="alert alert-danger hidden cat-full">
                    
                  </div>
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped menu-cat-table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>ante-titulo</th>
                          <th>Titulo</th>
                          <th>sub-titulo</th>
                          <th>Ver Detalles</th>
                          <th class="menu_active_title" data-toggle="popover" data-trigger="manual" title="Alerta" data-content="">Relevante</th>
                          <th class="titulares_title" data-toggle="popover" data-trigger="manual" title="Alerta" data-content="">Titulares</th>
                          <th>Modificar</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($articles as $a)
                       <tr>
                       	<td>{{ $a->id }}</td>
                       	<td>@if($a->pretitle) {{ $a->pretitle->title }} @else Sin ante-titulo @endif</td>
                        <td>{{ $a->title }}</td>
                        <td>@if($a->subtitle) {{ $a->subtitle->title }} @else Sin sub-titulo @endif</td>
                        <td><button class="btn btn-info btn-xs show-item-info" value="{{ $a->id }}" data-toggle="modal" data-target="#showItemInfo">Ver</button></td>
                        <td>
                          <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
                          <input type="checkbox" class="menu_active menu_active_{{ $a->id }}" data-url="{{ URL::to('administrador/noticias/activar-relevante') }}" data-max-text="6 categorías" data-length="6" name="menu_cat_{{ $a->id }}" value="{{ $a->id }}" @if($a->is_relevant == 1) checked @endif>
                        </td>
                        <td>
                          <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
                          <input type="checkbox" class="titular_active titular_active_{{ $a->id }}" data-url="{{ URL::to('administrador/noticias/activar-titular') }}" name="titular_{{ $a->id }}" value="{{ $a->id }}" @if($a->show_marquee == 1) checked @endif>
                        </td>
                       	<td><a target="_blank" href="{{ URL::to('administrador/noticia/modificar/'.$a->id) }}" class="btn btn-warning btn-xs">Modificar</a></td>
                       	<td><button class="btn btn-danger btn-xs btn-elim-article" value="{{ $a->id}}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('administrador/ver-articulos/eliminar') }}" data-tosend="id">Eliminar</button></td>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>ante-titulo</th>
                          <th>Titulo</th>
                          <th>Ver Detalles</th>
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
<div class="modal fade" id="showItemInfo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles del producto</h4>
      </div>
      <div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
        <div class="text-center">
          <img src="{{ asset('images/loader.gif') }}" class="miniLoader active">
        </div>
        <div class="partial-container">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

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
          "searching": true,
          "ordering": true,
          "order": [],
          "info": true,
          "autoWidth": false
        });
        
      });
    </script>

@stop