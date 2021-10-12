@extends('layouts.app')

@section('title', "Ajouter/éditer une couleur")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group {{ $errors->get('color') ? "has-error" : "" }}">
						<label>Couleur</label>
						<input type="color" name="color" class="form-control" value="{{ old('color') ? old('color') : $color->color }}" required>
						<p class="help-block">{{ $errors->first('color') }}</p>
					</div>					
					<div class="form-group {{ $errors->get('alias') ? "has-error" : "" }}">
						<label>Nom</label>
						<input type="text" name="alias" class="form-control" value="{{ old('alias') ? old('alias') : $color->alias }}" required>
						<p class="help-block">{{ $errors->first('alias') }}</p>
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