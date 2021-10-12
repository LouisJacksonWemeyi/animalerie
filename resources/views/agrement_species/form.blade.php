@extends('layouts.app')

@section('title', "Ajouter une espèce à un agrément")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
			<h3>Pour l'agrément "{{ $agrement->name }}"</h3>
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="agrement_id" value="{{ $agrement->id }}">
					<div class="form-group {{ $errors->get('specie_id') ? "has-error" : "" }}">
						<label>Espèce</label>
						<select class="form-control" name="specie_id">
							@foreach($species as $specie)
						    	<option value="{{ $specie->id }}" {{ $specie->hasToBeSelected($agrement_specie->specie_id, old('specie_id')) }} {{ $agrement_specie->specie_id == $specie->id ? "selected" : "" }}>{{ $specie->name }} </option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('specie_id') }}</p>
					</div>	
					<div class="form-group {{ $errors->get('url_file') ? "has-error" : "" }}">
					    <label>URL du fichier en ligne</label>
					    <input type="url" name="url_file" class="form-control" value="{{ old('url_file') ? old('url_file') :  $agrement_specie->url_file }}">
					    <p class="help-block">{{ $errors->first('url_file') }}</p>
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