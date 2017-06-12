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
            <li class="active"><a href="#"><i class="fa fa-pencil"></i> Nuevo Noticia</a></li>
          </ol>
        </section>
        <div class="row">
          <div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-pencil"></i>
                  <h3 class="box-title">Nuevo Noticia</h3>
                </div>
                <div class="box-body chat" id="chat-box">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <form class="new-user-form row" method="POST" action="{{ URL::to('administrador/noticia/nuevo/enviar') }}" enctype="multipart/form-data"> 
                     <div class="col-xs-12">
                        <h3>Datos básicos.</h3>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Ante-Título (opcional)</label>
                           <input type="text" class="form-control" name="pretitle" placeholder="Ante-Título" value="{{ Input::old('pretitle') }}">
                           @if($errors->has('pretitle'))
                              @foreach($errors->get('pretitle') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                        </div>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Título</label>
                           <input type="text" class="form-control validate-input" name="title" placeholder="Título" value="{{ Input::old('title') }}" required>
                           @if($errors->has('title'))
                              @foreach($errors->get('title') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                        </div>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Sub-título  (opcional)</label>
                           <input type="text" class="form-control " name="subtitle" placeholder="Título" value="{{ Input::old('subtitle') }}" required>
                           @if($errors->has('subtitle'))
                              @foreach($errors->get('subtitle') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                        </div>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Categoría.</label>
                           <div class="input-group">
                             <select class="form-control category validate-input" name="category">
                                <option value="">Seleccione una opción</option>
                                @foreach($cat as $c)
                                   <option value="{{ $c->id }}">{{ $c->description }}</option>
                                @endforeach
                             </select>
                              
                           </div>
                           @if($errors->has('category'))
                              @foreach($errors->get('category') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                           @endforeach
                         @endif
                        </div>
                     </div>
                     <div class="formulario col-xs-12 col-md-4">
                      <div class="input-group">
                         <label class="item-label">Sin especificar.</label>
                         <div class="input-group">
                          <input type="radio" name="mainorrelevant" @if(Input::old('mainorrelevant') != "relevant" && Input::old('mainorrelevant') != 'main') checked @endif value="no">
                         </div>
                      </div>
                    </div>
                    <div class="formulario col-xs-12 col-md-4">
                        <div class="input-group">
                           <label class="item-label">Colocar como relevante?.</label>
                           <div class="input-group">
                            <input type="radio" name="mainorrelevant" @if(Input::old('mainorrelevant')) checked @endif value="relevant">
                           </div>
                        </div>
                     </div>
                     <div class="formulario col-xs-12 col-md-4">
                        <div class="input-group">
                           <label class="item-label">Colocar como noticia principal?.</label>
                           <div class="input-group">
                            <input type="radio" name="mainorrelevant" @if(Input::old('mainorrelevant')) checked @endif value="main">
                           </div>
                        </div>
                     </div>
                      @if($errors->has('mainorrelevant'))
                      <div class="col-xs-12">
                          @foreach($errors->get('mainorrelevant') as $err)
                          <div class="clearfix"></div>
                          <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $err }}
                          </div>
                       @endforeach
                      </div>
                     @endif
                     <div class="col-xs-12">
                        <h3>Descripción / Imagenes.</h3>
                     </div>
                     <div class="col-xs-12 formulario">
                        <textarea class="form-control" id="editor1" name="description" rows="10" cols="80">
                           {{Input::old('description') }}
                        </textarea>
                        @if($errors->has('description'))
                           @foreach($errors->get('description') as $err)
                           <div class="clearfix"></div>
                           <div class="alert alert-danger">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             {{ $err }}
                           </div>
                           @endforeach
                        @endif
                     </div>
                     <div class="col-xs-12 formulario">
                        <div class="input-group">
                            <label class="item-label">Imagen principal</label>
                            <input type="file" name="img[]" class="image-file image active">
                            <input type="text" name="img_url[]" class="image-text image hidden form-control" placeholder="URL" disabled>
                            <i class="fa fa-refresh change-image-input"></i>
                            <output class="outpost"></output>

                            @if($errors->has('img'))
                              @foreach($errors->get('img') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                            @if($errors->has('img_url'))
                              @foreach($errors->get('img_url') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                          </div>
                        </div>
                        <div class="col-xs-12 new-image to-clone formulario">
                          <button type="button" class="close dimiss-cloned">&times;</button>
                          <br>
                          <div class="input-group">
                            <input type="file" name="" class="image-file image active">
                            <input type="text" name="img_url" class="image-text image hidden form-control" placeholder="URL" disabled>
                            <i class="fa fa-refresh change-image-input"></i>
                            <output class="outpost"></output>
                          </div>

                        </div>
                     <div class="col-xs-12 formulario">
                        <button type="button" class="btn btn-primary btn-clone" data-target="new-image" data-input="image-file" data-name="img[]">
                          Agregar Imagen
                        </button>                     
                     </div>
                     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                  </form>
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="col-xs-12">
                     <button class="btn btn-success btn-send">Enviar</button>
                  </div>
                </div>
              </div><!-- /.box (chat box) -->

          </div>
        </div>

      </div><!-- /.content-wrapper -->
        
@stop

@section('postscript')

{{ View::make('admin.partials.editor') }}
 
@stop