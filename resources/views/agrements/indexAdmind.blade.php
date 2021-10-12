@extends('layouts.app')

@section('title', "Agréments")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">

		      	@can('create')
		        <a href="{{ route("agrement.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		        @endcan
			
		        @can('export')
		        <a href="{{ route("agrements.export") }}"><button type="button" class="btn btn-outline btn-info">Export</button></a>
		        @endcan

		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Numéro</th>
		                    	<th>Description</th>
		                    	<th>Titulaire</th>
		                    	<th>Espèces liées</th>
		                    	<th>Utilisateur(s)</th>
		                    	<th>Options</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($agrements as $agrement)
			                    <tr>
			                    	<td>{{ $agrement->name }}</td>
			                    	<td>{{ $agrement->description }}</td>
			                    	<td>{{ $agrement->user->name }}</td>
			                    	<td>
			                    		@foreach($agrement->species as $specie)
			                    			<div>
			                    				{{ $specie->name }}
			                    				@can('edit')
			                    				<a title="Modifier cette espèce dans cet agrément" href="{{ route("agrement_specie.edit", ["id" => $specie->pivot->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
			                    				@endcan
			                    				@can('delete')
			                    				<a  class="should_confirm_delete" title="Supprimer cet espèce dans cet agrément" href="{{ route("agrement_specie.destroy", ["agrement_id" => $specie->pivot->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
			                    				@endcan
			                    			</div>
			                    		@endforeach
		
			                    		@can('create')
			                    		<div>
			                    			<a href="{{ route('agrement_specie.create',['agrement_id' => $agrement->id]) }}">
			                    				<i class="fa fa-plus"></i>
			                    			</a>
			                    		</div>
			                    		@endcan
			                    	</td>
			                    	<td>
			                    		@foreach($agrement->users as $user)
																<div>
																	{{ $user->name }}
																	@can('delete')
																	<a  class="should_confirm_delete" title="Supprimer cet utilisateur de l'agrément" href="{{ route("agrement_user.destroy", ["agrement_id" => $user->pivot->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
																	@endcan
																</div>
																@endforeach
															@can('create')
															<div>
																<a title="Ajouter un utilisateur de l'agrément" href="{{ route('agrement_user.create',['agrement_id' => $agrement->id]) }}">
																	<i class="fa fa-plus"></i>
																</a>
															</div>
															@endcan
			                    	</td>
			                    	<td>
			                    		@can('edit')
			                    		<a title="Modifier cet agrément"href="{{ route("agrement.edit", ["id" => $agrement->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
			                    		@endcan

			                    		@can('destroy')
			                    		<a class="should_confirm_delete" title="Supprimer cet agrément" href="{{ route("agrement.destroy", ["id" => $agrement->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $agrements->links() }}
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