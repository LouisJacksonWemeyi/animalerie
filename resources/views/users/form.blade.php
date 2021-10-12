@extends('layouts.app')

@section('title', "Ajouter/éditer un(e) utilisateur/trice")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group {{ $errors->get('firstname') ? "has-error" : "" }}">
						<label>Prénom</label>
						<input type="text" name="firstname" class="form-control" value="{{ old('firstname') ? old('firstname') : $user->firstname }}" required>
					    <p class="help-block">{{ $errors->first('firstname') }}</p>
					</div>						
					<div class="form-group {{ $errors->get('lastname') ? "has-error" : "" }}">
						<label>Nom</label>
						<input type="text" name="lastname" class="form-control" value="{{ old('lastname') ? old('lastname') : $user->lastname }}" required>
					    <p class="help-block">{{ $errors->first('lastname') }}</p>
					</div>						
					<div class="form-group {{ $errors->get('email') ? "has-error" : "" }}">
						<label>Email</label>
						<input type="email" name="email" class="form-control" value="{{ old('email') ? old('email') : $user->email }}" required>
					    <p class="help-block">{{ $errors->first('email') }}</p>
					</div>
					@if($user->id != Auth::id())				
					<div class="form-group {{ $errors->get('rank') ? "has-error" : "" }}">
						<label>Rang</label>
						<select name="rank" class="form-control" >
							@foreach($ranks as $rank)
								<option value="{{ $rank->id }}" {{ $user->rank_id == $rank->id ? "selected" : "" }}>{{ $rank->name }}</option>
							@endforeach
						</select>
					    <p class="help-block">{{ $errors->first('rank') }}</p>
					</div>
					@endif
					@if($user->password)
					<div class="form-group">
						<label>Changer le mot de passe</label>
						<small>(Laisser vide si vous ne souhaitez pas le changer)</small>
						<input type="text" name="new_password" class="form-control">
					</div>	
					@endif					
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