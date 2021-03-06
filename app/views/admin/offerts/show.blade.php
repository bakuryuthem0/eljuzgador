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
        <li class="active"><a href="#"><i class="fa fa-search"></i> Ver Ofertas</a></li>
      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Ver Ofertas</h3>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped valign-table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Titulo</th>
                          <th>Sub-titilo</th>
                          <th>Cantidad de items</th>
                          <th>Porcentaje</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($offerts as $o)
                       <tr>
                       	<td class="text-center">{{ $o->id }}</td>
                       	<td class="text-center">{{ $o->title_es }}</td>
                        <td class="text-center">{{ $o->subtitle_es }}</td>
                        <td class="text-center">
                          <button class="btn btn-info btn-xs" data-toggle="collapse" data-target="#collapseExample{{ $o->id }}" aria-expanded="false" aria-controls="collapseExample{{ $o->id }}">
                            {{ $o->offert_item_count->first()->aggregate }}</button></td>
                        <td class="text-center">{{ $o->percent }}%</td>
                       	<td class="text-center">
                          <button class="btn btn-danger btn-elim-offert btn-xs" data-what-to-elim="Eliminar offerta" value="{{ $o->id }}" data-url="{{ URL::to('administrador/ver-ofertas/eliminar-oferta') }}" data-toggle="modal" data-target="#elimThing" data-tosend="id">
                            Eliminar
                          </button>
                        </td>
                        <tr class="collapse" id="collapseExample{{ $o->id }}">
                          <td colspan="5">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Item</th>
                                  <th>Precio</th>
                                  <th>Stock</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($o->offertItems as $i)
                                <tr>
                                  <td class="text-center">{{ $i->items->id }}</td>
                                  <td class="text-center">{{ $i->items->title_es }}</td>
                                  <td class="text-center">{{ $i->items->price }}</td>
                                  <td class="text-center">{{ $i->items->stock }}</td>
                                  <td class="text-center">
                                    <button class="btn btn-danger btn-xs btn-remove-item" data-url="{{ URL::to('administrador/ver-ofertas/remover-item') }}" value="{{ $i->id }}" data-toggle="modal" data-target="#elimThing" data-tosend="id">
                                      Eliminar
                                    </button>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </td>
                        </tr>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Titulo</th>
                          <th>Sub-titilo</th>
                          <th>Cantidad de items</th>
                          <th>Porcentaje</th>
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
    {{ HTML::style('admin/plugins/datatables/dataTables.bootstrap.css') }}
    {{ HTML::script('admin/plugins/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('admin/plugins/datatables/dataTables.bootstrap.min.js') }}
    <script>
      $(function () {
        
      });
    </script>

@stop