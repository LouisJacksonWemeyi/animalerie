@extends('layouts.app')

@section('title', "Ajouter une catégorie de contacts")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group {{ $errors->get('name') ? "has-error" : "" }}">
						<label>Nom de la catégorie</label>
						<input type="text" name="name" class="form-control" value="{{ old('name') ? old('name') : $category->name }}" required>
						<p class="help-block">{{ $errors->first('name') }}</p>
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