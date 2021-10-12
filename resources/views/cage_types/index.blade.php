@extends('layouts.app')

@section('title', "Types de cages")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <a href="{{ route("cage.type.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Nom</th>
		                    	<th>Capacité</th>
		                    	<th>Options</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($cage_types as $cage_type)
			                    <tr>
			                    	<td>{{ $cage_type->name }}</td>
			                    	<td>{{ $cage_type->capacity }}</td>
			                    	<td>
			                    		<a title="Modifier ce type de cage" href="{{ route("cage.type.edit", ["id" => $cage_type->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
			                    		<a class="should_confirm_delete" title="Supprimer ce type de cage"  href="{{ route("cage.type.destroy", ["id" => $cage_type->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $cage_types->links() }}
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