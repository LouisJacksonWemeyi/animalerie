@extends('layouts.app')

@section('title', "Ajouter/éditer un agrément")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group {{ $errors->get('name') ? "has-error" : "" }}">
					    <label>Numéro</label>
					    <input type="text" name="name" class="form-control" value="{{ old('name') ? old('name') : $agrement->name }}" required>
					    <p class="help-block">{{ $errors->first('name') }}</p>
					</div>					
					<div class="form-group {{ $errors->get('description') ? "has-error" : "" }}">
					    <label>Déscription</label>
					    <textarea name="description" class="form-control">{{ old('description') ? old('description') : $agrement->description }}</textarea>
					    <p class="help-block">{{ $errors->first('description') }}</p>
					</div>
					<div class="form-group {{ $errors->get('user') ? "has-error" : "" }}">
						<label>Titulaire</label>
						<select class="form-control" name="user">
							@foreach($users as $user)
						    	<option value="{{ $user->id }}" 
						    		{{ (old('user') && old('user') == $user->id ) ? "selected" : (( !old('user') && $agrement->user_id == $user->id) ? "selected" : "") }}>{{ $user->name }}</option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('user') }}</p>
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