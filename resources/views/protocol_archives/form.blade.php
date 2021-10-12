@extends('layouts.app')

@section('title', "Ajouter/modifier une archive de protocole")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">

		    <div class="box-body">
				<h3>Pour le protocole "{{ $protocol->title }}"</h3>
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}	
					<div class="form-group {{ $errors->get('date') ? "has-error" : "" }}">
						<label>Date</label>
						<input type="date" name="date" class="form-control" value="{{ old('date') ? old('date') : $archive->value_date }}" required>
						<p class="help-block">{{ $errors->first('date') }}</p>
					</div>	
					<div class="form-group {{ $errors->get('note') ? "has-error" : "" }}">
						<label>Remarque</label>
						<textarea name="note" class="form-control" rows="3" required>{{ old('note') ? old('note') : $archive->note }}</textarea>
						<p class="help-block">{{ $errors->first('note') }}</p>
					</div>
					<div class="form-group {{ $errors->get('total_animals') ? "has-error" : "" }}">
						<label>Nombre d'animaux dans le protocole</label>
						<input type="number" name="total_animals" class="form-control" value="{{ old('total_animals') ? old('total_animals') : $protocol->total_animals }}">
						<p class="help-block">{{ $errors->first('total_animals') }}</p>
					</div>
					<div class="form-group {{ $errors->get('date_end') ? "has-error" : "" }}">
						<label>Date de fin de validité du protocole</label>
						<input type="date" name="date_end" class="form-control" value="{{ old('date_end') ? old('date_end') : ($protocol->date_end ? $protocol->date_end->format("Y-m-d") : "") }}">
						<p class="help-block">{{ $errors->first('date_end') }}</p>
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