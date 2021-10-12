@extends('layouts.app')

@section('title', "Ajouter un événement")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group">
						<label>Titre</label>
						<input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
					</div>					
					<div class="form-group">
						<label>Déscription</label>
						<textarea type="text" name="title" class="form-control" required >{{ $event->description }}</textarea>
					</div>
					<div class="form-group">
						<label>Titre</label>
					    <input type="date" name="date" class="form-control" min="{{ date("Y-m-d") }}" value="{{ isset($event->date) ? $event->date->format("Y-m-d") : "" }}"required>
					</div>	
					<td>{{ $event->display_color }}</td>

					<div class="form-group">
						<label>Protocoles éthiques</label>
						<select class="form-control" name="ethical_protocol_id">
							@foreach($protocols as $protocol)
						    	<option value="{{ $protocol->id }}" {{ $protocol->ethical_protocol_id == $protocol->id ? "selected" : "" }}>{{ $protocol->title }}</option>
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