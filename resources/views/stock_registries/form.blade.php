@extends('layouts.app')

@section('title', "Ajouter/éditer ligne dans le registre")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group {{ $errors->get('in') ? "has-error" : "" }}">
						<label>Entrée <span class="red">* (ou sortie)</span></label>
						<input type="text" name="in" class="form-control" value="{{ old('in') ? old('in') : $registry->in }}">
						<p class="help-block">{{ $errors->first('in') }}</p>
					</div>
					<div class="form-group {{ $errors->get('out') ? "has-error" : "" }}">
						<label>Sortie <span class="red">* (ou entrée)</span></label>
						<input type="text" name="out" class="form-control" value="{{ old('out') ? old('out') : $registry->out }}">
						<p class="help-block">{{ $errors->first('out') }}</p>
					</div>					
					<div class="form-group {{ $errors->get('expiration_date') ? "has-error" : "" }}">
						<label>Date de péremption</label>
						<input type="date" name="expiration_date" class="form-control" value="{{ old('expiration_date') ? old('expiration_date') : $registry->value_expire }}">
						<p class="help-block">{{ $errors->first('expiration_date') }}</p>
					</div>
					<div class="form-group {{ $errors->get('experience_id') ? "has-error" : "" }}">
						<label>Expérience liée</label>
						<select name="experience_id" class="form-control" required>
							@foreach($experiences as $experience)
								<option value="{{ $experience->id }}" {{ $experience->hasToBeSelected($registry->experience_id, old('experience_id') )}}>{{ $experience->number }}</option>
							@endforeach
						</select>
						<p class="help-block">{{ $errors->first('experience_id') }}</p>
					</div>
					<div class="form-group {{ $errors->get('note') ? "has-error" : "" }}">
						<label>Remarque</label>
						<textarea name="note" class="form-control">{{ old('note') ? old('note') : $registry->note }}</textarea>
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