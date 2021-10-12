@extends('layouts.app')

@section('title', "Registres - Choix de l'agrément")

@section('content')
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<form action="" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}					
			<div class="form-group col-lg-12">
				<label>Agrément</label>
				<select name="agrement_id" class="form-control">
					@foreach($agrements as $agrement)
						<option value="{{ $agrement->id }}">{{ $agrement->name }}</option>
					@endforeach
				</select>
			</div>												
			<button type="submit" class="btn btn-default">Suivant</button>
		</form>
	</div>
</div>
<!-- /.row -->
@endsection