@extends('layouts.app')

@section('title', "Cages")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <a href="{{ route("agrement.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Nom</th>
		                    	<th>Déscription</th>
		                    	<th>Options</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($agrements as $agrement)
			                    <tr>
			                    	<td><a href="{{ asset("storage/app/$agrement->valid_file") }}" target="_blank">{{ $agrement->name }}</a></td>
			                    	<td>{{ $agrement->description }}</td>
			                    	<td class="center">{!! $agrement->check !!}</td>
			                    	<td>{{ $agrement->validity_date->format("d/m/Y") }}</td>
			                    	<td>{{ $agrement->created->format("d/m/Y") }}</td>
			                    	<td>{{ $agrement->modified->format("d/m/Y") }}</td>
			                    	<td>{{ $agrement->user->name }}</td>
			                    	<td>
			                    		@foreach($agrement->species as $specie)
			                    		{{ $specie->name }}<br />
			                    		@endforeach
			                    	</td>
			                    	<td>
			                    		<a href="{{ route("agrement.edit", ["id" => $agrement->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
			                    		<a class="should_confirm_delete" href="{{ route("agrement.destroy", ["id" => $agrement->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
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