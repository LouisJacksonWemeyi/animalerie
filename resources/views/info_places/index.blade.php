@extends('layouts.app')

@section('title', "Informations des lieux")

@section('content')
<div class="row">
 @can('create')
	<div class="col-lg-12">
		<small>(Les informations sont vérouillées le lendemain de leur création.)</small>
		
		<form action="" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group col-lg-2 {{ $errors->get('humidity') ? "has-error" : "" }}">
				<input type="number" step="0.01" name="humidity" class="form-control" placeholder="Humidité (%)" autofocus value="{{ old('humidity') ? old('humidity') : $info_place->humidity }}" required>
				<p class="help-block">{{ $errors->first('humidity') }}</p>

			</div>						
			<div class="form-group col-lg-2 {{ $errors->get('temperature') ? "has-error" : "" }}">
				<input type="number" step="0.01" name="temperature" class="form-control" placeholder="Température (°C)" value="{{ old('temperature') ? old('temperature') : $info_place->temperature }}" required>
				<p class="help-block">{{ $errors->first('temperature') }}</p>

			</div>						
			<div class="form-group col-lg-3 {{ $errors->get('note') ? "has-error" : "" }}">
				<input type="text" name="note" class="form-control" placeholder="Remarque" value="{{ old('note') ? old('note') : $info_place->note }}">
				<p class="help-block">{{ $errors->first('note') }}</p>
				
			</div>				
			<div class="form-group col-lg-2 {{ $errors->get('info_date') ? "has-error" : "" }}">
				<input type="date" name="info_date" class="form-control" value="{{ old('info_date') ? old('info_date') : now()->format("Y-m-d") }}" required>
				<p class="help-block">{{ $errors->first('info_date') }}</p>

			</div>						
			<div class="form-group col-lg-2 {{ $errors->get('place_id') ? "has-error" : "" }}">
				<select name="place_id" class="form-control">
					@foreach($places as $place)
					<option value="{{ $place->id }}">{{ $place->name }}</option>
					@endforeach
				</select>
				<p class="help-block">{{ $errors->first('place_id') }}</p>

			</div>
			<div class="col-lg-1">
				<button type="submit" class="btn btn-primary">Ajouter</button>
			</div>
		</form>
	</div>
	@endcan
	<div class="col-lg-12 col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Tri par date</a></li>
				<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Tri par lieu</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="table-responsive">
						@can('export')
						<a title="Exporter ces informations de lieux" href="{{ route("info.place.export_by_date") }}"><button type="button" class="btn btn-outline btn-info">Export</button></a>
						@endcan
						<table class="table table-striped table-bordered table-hover datatable1">
							<thead>
								<tr>
									<th id="date">Date</th>
									<th>Humidité</th>
									<th>Température</th>
									<th>Remarque</th>
									<th>Utilisateur</th>
									<th>Lieu</th>
									<th width="10%">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($infos as $info)
								<tr class="{{ $info->is_today ? "bg-green disabled" : "" }}">
									<td data-order="{{ $info->date_timestamp }}">{{ $info->date }}</td>
									<td style="color: {{ $info->humid_color }}">{{ $info->humidity }} %</td>
									<td style="color: {{ $info->temp_color }}">{{ $info->temperature }} °C</td>
									<td>{{ $info->note }}</td>
									<td>{{ $info->user->name }}</td>
									<td data-order="{{ $info->place_id }}">{{ $info->place->name }}</td>
									<td>
										@if($info->registered_today)
										@can('edit')
										<a title="Modifier cette information de lieu" href="{{ route("info.place.edit", ["id" => $info->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
										@endcan
										@can('destroy')
										<a class="should_confirm_delete" title="Supprimer cette information de lieu" href="{{ route("info.place.destroy", ["id" => $info->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
										@endcan
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="tab_2">
					<div class="table-responsive">
						@foreach($places as $place)
						@can('export')
						<a title="Exporter ces informations de lieux" href="{{ route("info.place.export_by_place", ['place_id' => $place->id]) }}"><button type="button" class="btn btn-outline btn-info">Export</button></a>
						@endcan
						<table class="col-lg-12 table table-striped table-bordered table-hover datatable2">
							<thead>
								<tr>
									<th colspan="6">
										{{ $place->name }}
									</th>
								</tr>
								<tr>
									<th>Humidité</th>
									<th>Température</th>
									<th>Remarque</th>
									<th>Date</th>
									<th>Utilisateur</th>
									<th width="10%">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($places_w_infos[$place->id] as $info)
								<tr class="{{ $info->is_today ? "bg-green disabled" : "" }}">
									<td style="color: {{ $info->humid_color }}">{{ $info->humidity }} %</td>
									<td style="color: {{ $info->temp_color }}">{{ $info->temperature }} °C</td>
									<td>{{ $info->note }}</td>
									<td data-order="{{ $info->date_timestamp }}">{{ $info->date }}</td>
									<td>{{ $info->user->name }}</td>
									<td>
										@if($info->registered_today)
										@can('edit')
										<a title="Modifier cette information de lieu" href="{{ route("info.place.edit", ["id" => $info->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
										@endcan
										@can('destroy')
										<a href="{{ route("info.place.destroy", ["id" => $info->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
										@endcan
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						@endforeach
					</div>
				</div>
				<!-- /.tab-pane -->
			</div>
			<!-- /.tab-content -->
		</div>
		<!-- nav-tabs-custom -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- DataTables -->
<script src="{{ config('app.url') }}resources/assets/app/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ config('app.url') }}resources/assets/app/bower_components/datatables.net/js/dataTables.bootstrap.min.js"></script>
<script>
	$(function () {
		$('.datatable1').DataTable({
			"pagingType": "numbers",
			"bFilter": true,
			"bSort": true,
			"language": {
				"lengthMenu": "Afficher  _MENU_  entrées.",
				"zeroRecords": "Pas d'animaux.",
				"info": "Page _PAGE_ sur _PAGES_.",
				"infoEmpty": "Pas d'information disponible.",
				"infoFiltered": "(Filtré depuis un total de _MAX_ entrée(s))",
				"search" : "Recherche : "
			}
		}).order( [[ 0, 'desc' ],[ 5, 'asc']] )
		.draw();    
		$('.datatable2').DataTable({
			"pagingType": "numbers",
			"bFilter": true,
			"bSort": true,
			"language": {
				"lengthMenu": "Afficher  _MENU_  entrées.",
				"zeroRecords": "Pas d'animaux.",
				"info": "Page _PAGE_ sur _PAGES_.",
				"infoEmpty": "Pas d'information disponible.",
				"infoFiltered": "(Filtré depuis un total de _MAX_ entrée(s))",
				"search" : "Recherche : "
			}
		}).order( [[ 3, 'desc' ]] )
		.draw();
	})
</script>
@endsection