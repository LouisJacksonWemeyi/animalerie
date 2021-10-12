@extends('layouts.app')

@section('title', "Couleurs")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			@can('create')
		    <div class="panel-heading">
		        <a href="{{ route("color.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		    </div>
		    @endcan
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Couleur</th>
		                    	<th>Nom</th>
		                    	<th>Exemple fond</th>
		                    	<th>Exemple texte</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($colors as $color)
			                    <tr>
			                    	<td>{{ $color->color }}</td>
			                    	<td>{{ $color->alias }}</td>
			                    	<td style="background-color: {{ $color->color }};">Exemple</td>
			                    	<td style="color: {{ $color->color }};">Exemple</td>
			                    	<td>
			                    		@can('edit')
			                    		<a title="Modifier cette couleur" href="{{ route("color.edit", ["id" => $color->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		@endcan
			                    		@can('destroy')
			                    		<a class="should_confirm_delete" title="Supprimer cette couleur" href="{{ route("color.destroy", ["id" => $color->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $colors->links() }}
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