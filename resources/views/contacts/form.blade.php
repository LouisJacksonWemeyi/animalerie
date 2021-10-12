@extends('layouts.app')

@section('title', "Ajouter un contact")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group {{ $errors->get('lastname') ? "has-error" : "" }}">
						<label>Nom</label>
						<input type="text" name="lastname" class="form-control" value="{{ old('lastname') ? old('lastname') : $contact->lastname }}" required>
						<p class="help-block">{{ $errors->first('lastname') }}</p>

					</div>
					<div class="form-group {{ $errors->get('firstname') ? "has-error" : "" }}">
						<label>Prénom</label>
						<input type="text" name="firstname" class="form-control" value="{{ old('firstname') ? old('firstname') : $contact->firstname }}" required>
						<p class="help-block">{{ $errors->first('firstname') }}</p>

					</div>
					<div class="form-group {{ $errors->get('email') ? "has-error" : "" }}">
						<label>Email du contact</label>
						<input type="email" name="email" class="form-control" value="{{ old('email') ? old('email') : $contact->email }}" required>
						<p class="help-block">{{ $errors->first('email') }}</p>

					</div>						
					<div class="form-group {{ $errors->get('phone') ? "has-error" : "" }}">
						<label>Téléphone du contact</label>
						<input type="text" name="phone" class="form-control" value="{{ old('phone') ? old('phone') : $contact->phone }}" required>
						<p class="help-block">{{ $errors->first('phone') }}</p>

					</div>					
					<div class="form-group {{ $errors->get('note') ? "has-error" : "" }}">
						<label>Notes</label>
						<input type="text" name="note" class="form-control" value="{{ old('note') ? old('note') : $contact->note }}">
						<p class="help-block">{{ $errors->first('note') }}</p>

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