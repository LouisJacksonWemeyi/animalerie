@extends('layouts.app')

@section('title', "Fournisseurs")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			@can('create')
		    <div class="panel-heading">
		        <a href="{{ route("supplier.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		    </div>
		    @endcan
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Nom</th>
		                    	<th>Contact</th>
		                    	<th>Créé</th>
		                    	<th>Modifié</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($suppliers as $supplier)
			                    <tr>
			                    	<td>{{ $supplier->name }}</td>
			                    	<td>{{ $supplier->contact }}</td>
			                    	<td>{{ $supplier->created->format("d/m/Y") }}</td>
			                    	<td>{{ $supplier->modified->format("d/m/Y") }}</td>
			                    	<td>
			                    		<a title="Modifier ce fournisseur" href="{{ route("supplier.edit", ["id" => $supplier->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		<a class="should_confirm_delete" title="Supprimer ce fournisseur" href="{{ route("supplier.destroy", ["id" => $supplier->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $suppliers->links() }}
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