@extends('layouts.app')

@section('title', "Unités")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			@can('create')
		    <div class="panel-heading">
		        <a href="{{ route("unit.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		    </div>
		    @endcan
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Nom</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($units as $unit)
			                    <tr>
			                    	<td>{{ $unit->name }}</td>
			                    	<td>
			                    		@can('edit')
			                    		<a title="Modifier cette unité" href="{{ route("unit.edit", ["id" => $unit->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		@endcan
			                    		@can('destroy')
			                    		<a class="should_confirm_delete" title="Supprimer cette unité" href="{{ route("unit.destroy", ["id" => $unit->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $units->links() }}
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