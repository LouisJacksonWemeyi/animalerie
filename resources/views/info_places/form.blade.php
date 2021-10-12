@extends('layouts.app')

@section('title', "Modifier une information de lieu")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
		<form action="" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="form-group {{ $errors->get('humidity') ? "has-error" : "" }}">
				<label>Humidité (%)</label>
				<input type="number" step="0.01" name="humidity" class="form-control" value="{{ old('humidity') ? old('humidity') : $info_place->humidity }}" autofocus required>
				<p class="help-block">{{ $errors->first('humidity') }}</p>
				
			</div>						
			<div class="form-group {{ $errors->get('temperature') ? "has-error" : "" }}">
				<label>Température (°C)</label>
				<input type="number" step="0.01" name="temperature" class="form-control" value="{{ old('temperature') ? old('temperature') : $info_place->temperature }}" required>
				<p class="help-block">{{ $errors->first('temperature') }}</p>
				
			</div>						
			<div class="form-group {{ $errors->get('note') ? "has-error" : "" }}">
				<label>Remarque</label>
				<textarea class="form-control" name="note" id="" rows="3">{{ old('note') ? old('note') : $info_place->note }}</textarea>
				<p class="help-block">{{ $errors->first('note') }}</p>
				
			</div>				
			<div class="form-group {{ $errors->get('info_date') ? "has-error" : "" }}">
				<label>Date</label>
				<input type="date" name="info_date" class="form-control" value="{{ old('info_date') ? old('info_date') : ($info_place->info_date ?$info_place->info_date->format("Y-m-d") : "" )}}" required>
				<p class="help-block">{{ $errors->first('info_date') }}</p>
				
			</div>						
			<div class="form-group {{ $errors->get('place_id') ? "has-error" : "" }}">
				<label>Lieu</label>
				<select name="place_id" class="form-control">
					@foreach($places as $place)
					<option value="{{ $place->id }}" {{ $info_place->place_id == $place->id ? "selected" : "" }}>{{ $place->name }}</option>
					@endforeach
				</select>
				<p class="help-block">{{ $errors->first('place_id') }}</p>
				
			</div>
			<div>
				<button type="submit" class="btn btn-primary">Modifier</button>
			</div>
		</form>
		    </div>
		    <!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
@endsection