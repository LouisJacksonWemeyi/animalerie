@extends('layouts.app')

@section('title', "Expériences")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
				<h2>Expériences pour le protocole "{{ $protocol->title }}"</h2>
				@can('create')
				<a href="{{ route("experience.create", ["protocol_id" => $protocol->id]) }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
				@endcan
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Numéro d'expérience</th>
		                    	<th>Total d'animaux</th>
		                    	<th>Sévérité prévue</th>
		                    	<th>Description</th>
		                    	<th>Créée</th>
		                    	<th>Modifiée</th>
		                    	<th>Options</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($experiences as $experience)
			                    <tr>
			                    	<td>{{ $experience->number }}</td>
			                    	<td>{{ $experience->total_animals }}</td>
			                    	<td>{{ $experience->severity->title }}</td>
			                    	<td>{{ $experience->note }}</td>
			                    	<td>{{ $experience->created->format("d/m/Y") }}</td>
			                    	<td>{{ $experience->modified->format("d/m/Y") }}</td>			                    	
			                    	<td>
			                    		@can('edit')
			                    		<a title="Modifier cette expérience" href="{{ route("experience.edit", ["id" => $experience->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
			                    		@endcan
			                    		@can('destroy')
			                    		<a class="should_confirm_delete" title="Supprimer cette expérience" href="{{ route("experience.destroy", ["id" => $experience->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $experiences->links() }}
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