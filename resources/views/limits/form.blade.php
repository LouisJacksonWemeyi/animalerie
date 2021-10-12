@extends('layouts.app')

@section('title', "Modifier une limite")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group">
						<label><span class="red">* : champs requis</span></label>
					</div>
					<div class="form-group {{ $errors->get('extrem_down') ? "has-error" : "" }}">
						<label>Extrême basse <span class="red">*</span></label>
						<input type="number" step="0.01" name="extrem_down" class="form-control" value="{{ old('extrem_down') ? old('extrem_down') : $limit->extrem_down }}" required>
						<p class="help-block">{{ $errors->first('extrem_down') }}</p>
					</div>						
					<div class="form-group {{ $errors->get('down') ? "has-error" : "" }}">
						<label>Basse <span class="red">*</span></label>
						<input type="number" step="0.01" name="down" class="form-control" value="{{ old('down') ? old('down') : $limit->down }}" required>
						<p class="help-block">{{ $errors->first('down') }}</p>
					</div>						
					<div class="form-group {{ $errors->get('up') ? "has-error" : "" }}">
						<label>Haute <span class="red">*</span></label>
						<input type="number" step="0.01" name="up" class="form-control" value="{{ old('up') ? old('up') : $limit->up }}" required>
						<p class="help-block">{{ $errors->first('up') }}</p>
					</div>						
					<div class="form-group {{ $errors->get('extrem_up') ? "has-error" : "" }}">
						<label>Extrême haute <span class="red">*</span></label>
						<input type="number" step="0.01" name="extrem_up" class="form-control" value="{{ old('extrem_up') ? old('extrem_up') : $limit->extrem_up }}" required>
						<p class="help-block">{{ $errors->first('extrem_up') }}</p>
					</div>											
					<div class="form-group {{ $errors->get('normal_color') ? "has-error" : "" }}">
						<label>Couleur normale</label>
						<select class="form-control" name="normal_color">
							@foreach($colors as $color)
						    	<option value="{{ $color->color }}" {{ $limit->normal_color == $color->color ? "selected" : "" }} style="color: {{ $color->color }};">{{ $color->alias }} </option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('normal_color') }}</p>
					</div>
					<div class="form-group {{ $errors->get('color') ? "has-error" : "" }}">
						<label>Couleur limite</label>
						<select class="form-control" name="color">
							@foreach($colors as $color)
						    	<option value="{{ $color->color }}" {{ $limit->color == $color->color ? "selected" : "" }} style="color: {{ $color->color }};">{{ $color->alias }} </option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('color') }}</p>
					</div>
					<div class="form-group {{ $errors->get('extrem_color') ? "has-error" : "" }}">
						<label>Couleur extrême limite</label>
						<select class="form-control" name="extrem_color">
							@foreach($colors as $color)
						    	<option value="{{ $color->color }}" {{ $limit->extrem_color == $color->color ? "selected" : "" }} style="color: {{ $color->color }};">{{ $color->alias }} </option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('extrem_color') }}</p>
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