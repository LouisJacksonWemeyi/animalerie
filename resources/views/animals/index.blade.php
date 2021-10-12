@extends('layouts.app')

@section('title', "Entrées des animaux")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			    <a href="{{ route("animal.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
			</div>
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Entrée</th>
		                    	<th>N° livraison</th>
		                    	<th>Espèce</th>
		                    	<th>Fournisseur</th>
		                    	<th>Expérience</th>
		                    	<th>Utilisateur</th>
		                    	<th>Souche</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($animals as $animal)
			                    <tr>
		                    		<td>{{ $animal->number_in }}</td>
		                    		<td>{{ $animal->delivery_number }}</td>
		                    		<td>{{ $animal->specie->name }}</td>
		                    		<td>{{ $animal->supplier->name }}</td>
		                    		<td>{{ $animal->experience->number }}</td>
		                    		<td>{{ $animal->user->name }}</td>
		                    		<td>{{ $animal->strain }}</td>
			                    	<td>
			                    		@if($animal->user->id == Auth::id())
			                    		<a title="Modifier cette entrée" href="{{ route("animal.edit", ["id" => $animal->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		<a class="should_confirm_delete" title="Supprimer cette entrée" href="{{ route("animal.destroy", ["id" => $animal->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    		@endif()
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            	{{ $animals->links() }}
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