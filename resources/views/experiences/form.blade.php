@extends('layouts.app')

@section('title', "Ajouter une expérience")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
				<h3>Pour le protocole "{{ $protocol->title }}"</h3>

					<div class="form-group {{ $errors->get('number') ? "has-error" : "" }}">
						<label>Numéro d'expérience</label>
						<input type="text" name="number" class="form-control" value="{{ old('number') ? old('number') : $experience->number }}" >
						<p class="help-block">{{ $errors->first('number') }}</p>

					</div>	
					<div class="form-group {{ $errors->get('total_animals') ? "has-error" : "" }}">
						<label>Total des animaux</label>
						<input type="number" step="1" name="total_animals" class="form-control" value="{{ old('total_animals') ? old('total_animals') : $experience->total_animals }}" >
						<p class="help-block">{{ $errors->first('total_animals') }}</p>
					</div>	
					<div class="form-group {{ $errors->get('severity_id') ? "has-error" : "" }}">
						<label>Sévérité prévue</label>
						<select name="severity_id" class="form-control">
							@foreach($severities as $severity)
								<option value="{{ $severity->id }}" {{ $experience->severity_id == $severity->id ? "selected" : "" }}>{{ $severity->title }}</option>
							@endforeach
							<option value="4548">test</option>
						</select>
						<p class="help-block">{{ $errors->first('severity_id') }}</p>
					</div>			
					<div class="form-group {{ $errors->get('note') ? "has-error" : "" }}">
						<label>Description</label>
						<textarea name="note" rows="3" class="form-control">{{ old('note') ? old('note') : $experience->note }}</textarea>
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