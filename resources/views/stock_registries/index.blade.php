@extends('layouts.app')

@section('title', "Registre des fournitures")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	
		        <a href="{{ route("stock.registry.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		        
		        
		       <!-- <a href="{{ route("protocols.export") }}"><button type="button" class="btn btn-outline btn-info">Export</button></a>-->
		        
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Entrée</th>
		                    	<th>Sortie</th>
		                    	<th>Fourniture</th>
		                    	<th>Date de péremption</th>
		                    	<th>Remarque</th>
		                    	<th>Utilisateur</th>
		                    	<th>Expérience</th>
		                    	<th>Créée</th>
		                    	<th>Modifiée</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($registries as $registry)
			                    <tr>
			                    	<td>{{ $registry->in }}</td>
			                    	<td>{{ $registry->out }}</td>
			                    	<td>{{ $registry->supply->name }}</td>
			                    	<td>{{ $registry->display_expire }} {!! $registry->expiration_alert !!}</td>
			                    	<td>{{ $registry->note }}</td>
			                    	<td>{{ $registry->user->name }}</td>
			                    	<td>{{ $registry->experience->number }}</td>
			                    	<td>{{ $registry->display_full_created }}</td>
			                    	<td>{{ $registry->display_full_modified }}</td>
			                    	<td>
			                    		
			                    		<a title="Modifier cette entrée/sortie du stock" href="{{ route("stock.registry.edit", ["id" => $registry->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		
			                    		@can('destroy')
			                    		<a class="should_confirm_delete" title="Supprimer cette entrée/sortie du stock" href="{{ route("stock.registry.destroy", ["id" => $registry->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            	{{ $registries->links() }}
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