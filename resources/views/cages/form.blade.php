@extends('layouts.app')

@section('title', "Ajouter une cage")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
		    	<h2>Pour l'expérience "{{ $experience->number }}"</h2>
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
					    <label>Nom</label>
					    <input type="text" name="name" class="form-control" value="{{ $cage->name }}" required>
					</div>						
					<div class="form-group">
					    <label>Date du dernier nettoyage</label>
					    <input type="date" name="last_cleaning" class="form-control" value="{{ !empty($cage->last_cleaning) ? $cage->last_cleaning->format("Y-m-d") : "" }}">
					    <p class="help-block">Par défaut le dernier néttoyage est réglé à la date actuelle.</p>
					</div>					
					<div class="form-group">
					    <label>Type de cage</label>
					    <select class="form-control" name="cage_type_id" required>
					    	@foreach($cage_types as $cage_type)
					        	<option value="{{ $cage_type->id }}" {{ $cage->cage_type_id == $cage_type->id ? "selected" : "" }}>{{ $cage_type->name }}</option>
					        @endforeach
					    </select>
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