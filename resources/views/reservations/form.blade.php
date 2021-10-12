@extends('layouts.app')

@section('title', "Ajouter/éditer une réservation")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		@if(Session::has('error'))
			<div class="alert alert-warning">
		        <h4><i class="icon fa fa-info"></i> Alerte</h4>
		        {!! Session::get('error') !!}
		    </div>
		@endif
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}	
					<div class="form-group {{ $errors->get('number') ? "has-error" : "" }}">
						<label>Nombre</label>
						<input type="number" step="0.01" name="number" class="form-control" min="0.01" value="{{ null !== old('number') ? old('number') : $reservation->number }}" required>
						<p class="help-block">{{ $errors->first('number') }}</p>
					</div>				
					<div class="form-group {{ $errors->get('start') ? "has-error" : "" }}">
						<label>Début</label>
						<input type="date" name="start" class="form-control" value="{{ old('start') ? old('start') : ($reservation->start ? $reservation->start->format("Y-m-d") : "") }}"required>
						<p class="help-block">{{ $errors->first('start') }}</p>
					</div>						
					<div class="form-group {{ $errors->get('end') ? "has-error" : "" }}">
						<label>Fin</label>
						<input type="date" name="end" class="form-control" value="{{ old('end') ? old('end') : ($reservation->end ? $reservation->end->format("Y-m-d") : "")}}" required>
						<p class="help-block">{{ $errors->first('end') }}</p>
					</div>	
					<div class="form-group {{ $errors->get('supply_id') ? "has-error" : "" }}">
						<label>Fourniture</label>
						<select name="supply_id" class="form-control" required>
							@foreach($supplies as $supply)
							@if($supply->stock > 0)
								<option value="{{ $supply->id }}" {{ (old('supply_id') && $supply->id == old('supply_id')) ? "selected" : (($reservation->supply_id && $supply->id == $reservation->supply_id) ? "selected" : "") }}>{{ $supply->name }}</option>
							@endif
							@endforeach
						</select>
						<p class="help-block">{{ $errors->first('supply_id') }}</p>
					</div>
					<div class="form-group {{ $errors->get('Remarque') ? "has-error" : "" }}">
					    <label>Remarques</label>
					    <textarea name="Remarques" class="form-control">{{ old('Remarques') ? old('Remarques') : $reservation->Remarques }}</textarea>
					    <p class="help-block">{{ $errors->first('Remarques') }}</p>
					</div>					
					<div class="form-group {{ $errors->get('place_id') ? "has-error" : "" }}">
						<label>Lieu</label>
						<select name="place_id" class="form-control" required>
							@foreach($places as $place)
								<option value="{{ $place->id }}" 
									{{ (old('place_id') && $place->id == old('place_id')) ? "selected" : (($reservation->place_id && $place->id == $reservation->place_id) ? "selected" : "") }}>{{ $place->name }}</option>
							@endforeach
						</select>
						<p class="help-block">{{ $errors->first('place_id') }}</p>
					</div>								
					<button type="submit" class="btn btn-default">Valider</button>
				</form>
		    </div>
		    <!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
@endsection