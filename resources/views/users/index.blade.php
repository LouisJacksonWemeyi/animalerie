@extends('layouts.app')

@section('title', "Utilisateurs")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				@can('create')
			    <a href="{{ route("user.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
			    @endcan
			</div>
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Nom</th>
		                    	<th>Email</th>
		                    	<th>Rang</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($users as $user)
			                    <tr>
			                    	<td>{{ $user->name }}</td>
			                    	<td>{{ $user->email }}</td>
			                    	<td>{{ $user->rank->name }}</td>
			                    	<td>
			                    		@can('update')
										{!! $user->activated !!}
			                    		<a title="Modifier ce membre" href="{{ route("user.edit", ["id" => $user->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		@endcan
			                    		@can(false)
			                    		<a class="should_confirm_delete" title="Supprimer ce membre" href="{{ route("user.destroy", ["id" => $user->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
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