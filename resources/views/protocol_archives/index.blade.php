@extends('layouts.app')

@section('title', "Archives d'un protocole")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
			<h3>Pour le protocole "{{ $protocol->title }}"</h3>
			@can('create')
		    <a href="{{ route("protocol.archive.create", ['protocol_id' => $protocol->id]) }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		    @endcan
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Date</th>
		                    	<th>Remarque</th>
		                    	<th>Utilisateur</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($archives as $archive)
			                    <tr>
			                    	<td>{{ $archive->date }}</td>
			                    	<td>{{ $archive->note }}</td>
			                    	<td>{{ $archive->user->name }}</td>

			                    	<td>
			                    		@can('edit')
			                    		<a title="Modifier ce protocole" href="{{ route("protocol.archive.edit", ["id" => $archive->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		@endcan
			                    		@can('destroy')
			                    		<a class="should_confirm_delete" title="Supprimer ce protocole" href="{{ route("protocol.archive.destroy", ["id" => $archive->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $archives->links() }}
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