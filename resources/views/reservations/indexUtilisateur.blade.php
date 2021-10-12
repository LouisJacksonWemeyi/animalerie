@extends('layouts.app')

@section('title', "Réservations")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			
			<div class="panel-heading">
			    <a href="{{ route("reservation.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
			</div>
			
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Début</th>
		                    	<th>Fin</th>
		                    	<th>Quantité</th>
		                    	<th>Fourniture</th>
								<th>Remarques</th>
		                    	<th>Utilisateur</th>
		                    	<th>Lieu</th>
		                    	<th>Créée</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($reservations as $reservation)
			                    <tr>
			                    	<td>{{ isset($reservation->start) ? $reservation->start->format("d/m/Y") : "" }}</td>
			                    	<td>{{ isset($reservation->end) ? $reservation->end->format("d/m/Y") : "" }}</td>
			                    	<td>{{ $reservation->number }}</td>
			                    	<td>{{ $reservation->supply->name }}</td>
									<td>{{ $reservation->Remarques }}</td>
			                    	<td>{{ $reservation->user->name }}</td>			                    	<td>{{ $reservation->place->name }}</td>
			                    	<td>{{ $reservation->created->format("d/m/Y") }}</td>
			                    	<td>
			                    		@can('titulaire_reservation',$reservation)
			                    		<a title="Modifier cette reservation" href="{{ route("reservation.edit", ["id" => $reservation->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		@endcan
			                    		@can('destroy')
			                    		<a class="should_confirm_delete" title="Supprimer cette reservation" href="{{ route("reservation.destroy", ["id" => $reservation->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $reservations->links() }}
		        </div>
		        <!-- /.table-responsive -->
		    </div>
		    <!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
@endsection