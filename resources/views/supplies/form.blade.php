@extends('layouts.app')

@section('title', "Ajouter une fourniture")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group {{ $errors->get('name') ? "has-error" : "" }}">
						<label>Nom</label>
						<input type="text" name="name" class="form-control" value="{{ $supply->name }}" required>
						<p class="help-block">{{ old('name') ? old('name') : $errors->first('name') }}</p>
					</div>
					<!-- champ type ajouter par JAckson et la presence de condition pour la gestion de l'ordre de l'affichage-->
					@if ($supply->type == "consommable")
					<div class="form-group {{ $errors->get('unit_id') ? "has-error" : "" }}">
						<label>Type</label>
						<select name="type" class="form-control" required>
							
								<option value="consommable">consommable</option>
								<option value="materiel">materiel</option>
						
						</select>
						<p class="help-block">{{ $errors->first('unit_id') }}</p>
					</div>
					@else
					<div class="form-group {{ $errors->get('unit_id') ? "has-error" : "" }}">
						<label>Type</label>
						<select name="type" class="form-control" required>
							
								<option value="materiel">materiel</option>
								<option value="consommable">consommable</option>
						
						</select>
						<p class="help-block">{{ $errors->first('unit_id') }}</p>
					</div>
					@endif
					
					<div class="form-group {{ $errors->get('unit_id') ? "has-error" : "" }}">
						<label>Unité</label>
						<select name="unit_id" class="form-control" required>
							@foreach($units as $unit)
								<option value="{{ $unit->id }}" {{ $supply->unit_id == $unit->id ? "selected" : "" }}>{{ $unit->name }}</option>
							@endforeach
						</select>
						<p class="help-block">{{ $errors->first('unit_id') }}</p>
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