<h5><strong>Titulo</strong></h5>
<p class="title es">{{ $item->title_es }}</p>
<p class="title eng hidden">{{ $item->title_eng }}</p>
<h5><strong>Categoría</strong></h5>
<p class="cat es">{{ $item->categoria->description_es }}</p>
<p class="cat eng hidden">{{ $item->categoria->description_eng }}</p>
<h5><strong>Sub-Categoría</strong></h5>
<p class="subcat es">{{ $item->subcategoria->description_es }}</p>
<p class="subcat eng hidden">{{ $item->subcategoria->description_eng }}</p>
<div class="misc_container">
     @foreach($misc as $m)
          <label class="label_{{ strtolower($m->description_eng) }}">{{ $m->description_es }}</label>
          <ul class="{{ strtolower($m->description_eng) }} es">
               @foreach($item->itemMisc as $im)
                    @if($m->id == $im->misc_id)
                         <li>{{ $im->description_es }}</li>
                    @endif
               @endforeach
          </ul>
          <ul class="{{ strtolower($m->description_eng) }} eng hidden">
                @foreach($item->itemMisc as $im)
                    @if($m->id == $im->misc_id)
                         <li>{{ $im->description_eng }}</li>
                    @endif
               @endforeach
          </ul>
     @endforeach
</div>
<h5><strong>Descripción</strong></h5>
<div class="description es">{{ $item->description_es }}</div>
<div class="description eng hidden">{{ $item->description_eng }}</div>