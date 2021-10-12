@extends('layouts.app')

@section('title', "Registres - Choix de l'espèce")

@section('content')
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<form action="" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}					
			<div class="form-group col-lg-12">
				<label>Espèce</label>
				<select name="specie_id" class="form-control">
					@foreach($species as $specie)
						<option value="{{ $specie->id }}">{{ $specie->name }}</option>
					@endforeach
				</select>
			</div>												
			<button type="submit" class="btn btn-default">Suivant</button>
		</form>
	</div>
</div>
<!-- /.row -->
@endsection