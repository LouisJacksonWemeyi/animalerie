@extends('layouts.app')

@section('title', "Ajouter/éditer un(e) utilisateur/trice à un agrément")

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
					<div class="form-group {{ $errors->get('user_id') ? "has-error" : "" }}">
						<label>Utilisateur/trice</label>
						<select class="form-control" name="user_id">
							@foreach($users as $user)
						    	<option value="{{ $user->id }}" {{ $user->hasToBeSelected($agrement_user->user_id, old('user_id')) }}>{{ $user->name }} </option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('user_id') }}</p>
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