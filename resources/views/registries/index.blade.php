@extends('layouts.app')

@section('title', "Registre des animaux")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div><b>Numéro d'agrément</b> : {{ $agrement->name }}</div>
				<div><b>Espèce</b> : {{ $specie->name }}</div>
			</div>
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>Date d'entrée</th>
		                    	<th>Nombre</th>
		                    	<th>Souche</th>
		                    	<th>Fournisseur</th>
		                    	<th>N° bon de livraison/commande</th>
		                    	<th>Responsable</th>
		                    	<th>N° éthique</th>
		                    	<th>N°expérience/domaine d'application/classe de sévérité </th>
		                    	<th>Nombre actuel</th>
		                    	<th>Fin de manip</th>
		                    	<th>Nombre utilisé dans le protocole</th>
		                    	<th>Nombre non utilisé dans le protocole</th>
		                    	<th>Classe de sévérité réelle observée</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($registries as $registry)
		                		@if($registry->experience->ethical_protocol->agrement_id == $agrement->id)
			                    <tr>
		                    		<td>{{ $registry->created->format("d/m/Y") }}</td>
		                    		<td>{{ $registry->number_in }}</td>
		                    		<td>{{ $registry->strain }}</td>
		                    		<td>{{ $registry->supplier->name }}</td>
		                    		<td>{{ $registry->delivery_number }}</td>
		                    		<td>{{ $registry->user->name }}</td>
		                    		<td>{{ $registry->experience->ethical_protocol->ethical_number }}</td>
		                    		<td>
		                    			{{ $registry->experience->number }} / 
		                    			{{ $registry->experience->ethical_protocol->domain->title }} / 
		                    			{{ $registry->experience->severity->title }}
		                    		</td>
		                    		<td> {{ $registry->number_in - $registry->number_out }} / {{ $registry->number_in }}</td>
		                    		<td>{{ $registry->experience->ethical_protocol->end }}</td>
		                    		<td>{{ $registry->experience->ethical_protocol->used_animals }}</td>
		                    		<td>{{ $registry->experience->ethical_protocol->unused_animals }}</td>
		                    		<td>{{ $registry->experience->real_severity->title }}</td>
			                    </tr>
		                		@endif
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $registries->links() }}
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