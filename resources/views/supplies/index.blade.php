@extends('layouts.app')

@section('title', "Fournitures")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			
		    <div class="panel-heading">
		        <a href="{{ route("supply.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		    </div>
		    
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Nom</th>
		                    	<th>Stock</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($supplies as $supply)
			                    <tr>
			                    	<td>{{ $supply->name }} {!! $supply->expiration_alert !!}</td>
			                    	<td>
			                    		@if($supply->stock != 0)
			                    		{{ $supply->stock }}
			                    		{{ str_plural($supply->unit->name, $supply->stock) }}
			                    		@else
			                    			Stock vide
			                    		@endif
			                    	</td>
			                    	<td>
			                    		
			                    		<!--<a title="Ajouter une entrée/sortie du stock" href="{{ route("stock.registry.create", ["supply_id" => $supply->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-success"><i class="fa fa-plus"></i> / <i class="fa fa-minus"></i></button>
			                    		</a>-->
			                    		
			                    		
			                    		<a title="Modifier cette fourniture" href="{{ route("supply.edit", ["id" => $supply->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		
			                    		
			                    		<a class="should_confirm_delete" title="Supprimer cette fourniture" href="{{ route("supply.destroy", ["id" => $supply->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    		
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