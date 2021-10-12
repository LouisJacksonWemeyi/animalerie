@extends('layouts.app')

@section('title', "Ajouter une news")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group {{ $errors->get('title') ? "has-error" : "" }}">
						<label>Titre</label>
						<input type="text" name="title" class="form-control" value="{{ old('title') ? old('title') : $new->title }}" required>
						<p class="help-block">{{ $errors->first('title') }}</p>
					</div>					
					<div class="form-group {{ $errors->get('content') ? "has-error" : "" }}">
						<label>Contenu</label>
						<textarea type="text" name="content" class="form-control" rows="5">{{ old('content') ? old('content') : $new->content }}</textarea>
						<p class="help-block">{{ $errors->first('content') }}</p>
					</div>
					<!-- /.form group -->
					<div class="form-group {{ $errors->get('display_start') ? "has-error" : "" }}">
						<label>Date du début d'affichage</label>
					    <input type="date" name="display_start" class="form-control" min="{{ date("Y-m-d") }}" value="{{ old('display_start') ? old('display_start') : ($new->display_start ? $new->display_start->format("Y-m-d") : "") }}" required>
						<p class="help-block">{{ $errors->first('display_start') }}</p>
					</div>						
					<div class="form-group {{ $errors->get('display_end') ? "has-error" : "" }}">
						<label>Date de fin d'affichage</label>
					    <input type="date" name="display_end" class="form-control" min="{{ date("Y-m-d") }}" value="{{ old('display_end') ? old('display_end') : ($new->display_end ? $new->display_end->format("Y-m-d") : "") }}" required>
						<p class="help-block">{{ $errors->first('display_end') }}</p>
					</div>	
					<div class="form-group {{ $errors->get('display_color') ? "has-error" : "" }}">
						<label>Couleur</label>
						<select class="form-control" name="display_color">
							@foreach($colors as $color)
						    	<option value="{{ $color->color }}" {{ old('display_color') ? "selected" : ($new->display_color == $color->color ? "selected" : "") }} style="color: {{ $color->color }};">{{ $color->alias }} </option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('display_color') }}</p>
					</div>
					<button type="submit" class="btn btn-default">Valider</button>
				</form>
		    </div>
		    <!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>
@endsection