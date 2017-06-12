@foreach($subcat as $s)
	<option value="{{ $s->id }}">{{ $s->description_es }}</option>
@endforeach