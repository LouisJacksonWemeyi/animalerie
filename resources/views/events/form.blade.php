@extends('layouts.app')

@section('title', "Ajouter un événement")

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
					<div class="form-group {{ $errors->get('title') ? "has-error" : "" }}">
						<label>Titre <span class="red">*</span></label>
						<input type="text" name="title" class="form-control" value="{{ old('title') ? old('title') : $event->title }}" required>
						<p class="help-block">{{ $errors->first('title') }}</p>
					</div>					
					<div class="form-group {{ $errors->get('description') ? "has-error" : "" }}">
						<label>Déscription</label>
						<textarea type="text" name="description" class="form-control">{{ old('description') ? old('description') : $event->description }}</textarea>
						<p class="help-block">{{ $errors->first('description') }}</p>
					</div>
					<div class="form-group {{ $errors->get('date') ? "has-error" : "" }}">
						<label>Date <span class="red">*</span></label>
					    <input type="date" name="date" class="form-control" min="{{ date("Y-m-d") }}" value="{{ old('date') ? old('date') : ($event->date ? $event->date->format("Y-m-d") : "") }}" required>
					    <p class="help-block">{{ $errors->first('date') }}</p>
					</div>	
					<div class="form-group {{ $errors->get('display_color') ? "has-error" : "" }}">
						<label>Couleur</label>
						<select class="form-control" name="display_color">
							@foreach($colors as $color)
						    	<option value="{{ $color->color }}" {{ $event->display_color == $color->color ? "selected" : "" }} style="color: {{ $color->color }};">{{ $color->alias }} </option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('display_color') }}</p>
					</div>

					<div class="form-group {{ $errors->get('ethical_protocol_id') ? "has-error" : "" }}">
						<label>Protocole éthique</label>
						<select class="form-control" name="ethical_protocol_id">
							<option value="">Pas de protocole lié</option>
							@foreach($protocols as $protocol)
						    	<option value="{{ $protocol->id }}" {{ $protocol->ethical_protocol_id == $protocol->id ? "selected" : "" }}>{{ $protocol->title }} ({{ $protocol->ethical_number }})</option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('ethical_protocol_id') }}</p>

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