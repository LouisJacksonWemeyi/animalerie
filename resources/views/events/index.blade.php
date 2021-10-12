@extends('layouts.app')

@section('title', "Evénements")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			@can('create')
		    <div class="panel-heading">
		        <a href="{{ route("event.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		    </div>
			@endcan
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Titre</th>
		                    	<th>Description</th>
		                    	<th>Date</th>
		                    	<th>Protocole</th>
		                    	<th>Créée</th>
		                    	<th>Modifiée</th>
		                    	<th>Options</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($events as $event)
			                    <tr style="border-left: 10px solid {{ $event->display_color }}">
			                    	<td>{{ $event->title }}</td>
			                    	<td>{{ $event->description }}</td>
			                    	<td>{{ $event->date->format("d/m/Y") }}</td>
			                    	<td>{{ !empty($event->ethical_protocol->title) ? $event->ethical_protocol->title : "Non lié à un protocole."}}</td>
			                    	<td>{{ $event->created->format("d/m/Y") }}</td>
			                    	<td>{{ $event->modified->format("d/m/Y") }}</td>
			                    	<td>
			                    		@can('edit')
			                    		<a title="Modifier cet événement" href="{{ route("event.edit", ["id" => $event->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
			                    		@endcan
			                    		@can('destroy')
			                    		<a class="should_confirm_delete" title="Supprimer cet événement" href="{{ route("event.destroy", ["id" => $event->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $events->links() }}
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