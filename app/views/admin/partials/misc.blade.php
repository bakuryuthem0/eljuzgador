<input type="hidden" name="{{strtolower($m->misc->description_eng)}}_misc_id" value="{{ $m->misc->id }}">
<div class="col-xs-12 col-md-6 formulario">
   <div class="input-group">
      <label class="item-label">{{ $m->misc->description_es }} (español)</label>
      <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
      <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
      <input type="text" class="form-control" name="{{ strtolower($m->misc->description_eng) }}_es[]" placeholder="{{ $m->misc->description_es }} (español)" value="{{ Input::old(strtolower($m->misc->description_eng).'_es.0') }}" required>
      @if($errors->has(strtolower($m->misc->description_eng).'_es'))
         @foreach($errors->get(strtolower($m->misc->description_eng).'_es') as $err)
         <div class="clearfix"></div>
         <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{ $err }}
         </div>
         @endforeach
       @endif
   </div>
</div>
@if($store->store_plan > 1)
<div class="col-xs-12 col-md-6 formulario">
   <div class="input-group">
      <label class="item-label">{{ $m->misc->description_es }} (ingles)</label>
      <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
      <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
      <input type="text" class="form-control" name="{{ strtolower($m->misc->description_eng) }}_eng[]" placeholder="{{ $m->misc->description_es }} (ingles)" value="{{ Input::old(strtolower($m->misc->description_eng).'_eng.0') }}" required>
      @if($errors->has(strtolower($m->misc->description_eng).'_eng'))
         @foreach($errors->get(strtolower($m->misc->description_eng).'_eng') as $err)
         <div class="clearfix"></div>
         <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{ $err }}
         </div>
         @endforeach
       @endif
   </div>
</div>
@if(count(Input::old(strtolower($m->misc->description_eng).'_es')) > 2)
   @for($i = 1; $i < count(Input::old(strtolower($m->misc->description_eng).'_es')); $i++)
      @if(!empty(Input::old(strtolower($m->misc->description_eng).'_es')[$i]))
      <div class="col-xs-12 no-padding to-clone active">
         <button type="button" class="close dimiss-cloned">&times;</button>
         <div class="col-xs-12 col-md-6 formulario">
            <input type="text" class="form-control" name="{{ strtolower($m->misc->description_eng) }}_es[{{$i}}]" placeholder="{{ $m->misc->description_es }} (español)" value="{{ Input::old(strtolower($m->misc->description_eng).'_es.'.$i) }}" required>
         </div>
         <div class="col-xs-12 col-md-6 formulario">
            <input type="text" class="form-control" name="{{ strtolower($m->misc->description_eng) }}_eng[{{$i}}]" placeholder="{{ $m->misc->description_es }} (ingles)" value="{{ Input::old(strtolower($m->misc->description_eng).'_eng.'.$i) }}" required>
         </div>
      </div>
      @endif
   @endfor
   <div class="col-xs-12 no-padding new-{{ strtolower($m->misc->description_eng) }} to-clone">
      <button type="button" class="close dimiss-cloned">&times;</button>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control" name="" placeholder="{{ $m->misc->description_es }} (español)" value="" required>
      </div>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control" name="" placeholder="{{ $m->misc->description_es }} (ingles)" value="" required>
      </div>
   </div>

@else
   <div class="col-xs-12 no-padding new-{{ strtolower($m->misc->description_eng) }} to-clone">
      <button type="button" class="close dimiss-cloned">&times;</button>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control {{ strtolower($m->misc->description_eng) }}_es" name="" placeholder="{{ $m->misc->description_es }} (español)" value="{{ Input::old(strtolower($m->misc->description_eng).'_es.1') }}" required>
      </div>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control {{ strtolower($m->misc->description_eng) }}_eng" name="" placeholder="{{ $m->misc->description_es }} (ingles)" value="{{ Input::old(strtolower($m->misc->description_eng).'_eng.1') }}" required>
      </div>
   </div>
@endif
<div class="col-xs-12 formulario">
   <button type="button" class="btn btn-primary btn-clone" data-target="new-{{ strtolower($m->misc->description_eng) }}" data-input="{{ strtolower($m->misc->description_eng) }}_" data-name-es="{{ strtolower($m->misc->description_eng) }}_es[]" data-name-eng="{{ strtolower($m->misc->description_eng) }}_eng[]">
     Agregar {{ $m->misc->description_es }}
   </button>
</div>
@endif