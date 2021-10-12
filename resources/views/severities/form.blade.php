@extends('layouts.app')

@section('title', "Ajouter/éditer une classe de sévérité")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group {{ $errors->get('title') ? "has-error" : "" }}">
						<label>Nom de la classe de sévérité</label>
						<input type="text" name="title" class="form-control" value="{{ old('title') ? old('title') : $severity->title }}" required>
						<p class="help-block">{{ $errors->first('title') }}</p>
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