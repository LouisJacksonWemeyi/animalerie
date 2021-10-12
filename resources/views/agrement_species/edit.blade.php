@extends('layouts.app')

@section('title', "Editer une espèce à un agrément")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
			<h3>Pour l'agrément "{{ $agrement_specie->agrement->name }}"</h3>
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="agrement_id" value="{{ $agrement_specie->agrement->id }}">
					<input type="hidden" name="specie_id" value="{{ $agrement_specie->specie->id }}">
					<div class="form-group">
						<label>Espèce</label>
						<p>{{ $agrement_specie->specie->name}}</p>
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