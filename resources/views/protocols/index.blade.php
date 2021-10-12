@extends('layouts.app')

@section('title', "Protocoles éthiques")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">
		    	@can('create')
		        <a href="{{ route("protocol.create") }}"><button type="button" class="btn btn-outline btn-primary">Ajouter</button></a>
		        @endcan
		        @can('export')
		        <a href="{{ route("protocols.export") }}"><button type="button" class="btn btn-outline btn-info">Export</button></a>
		        @endcan
		    </div>
		    <!-- /.panel-heading -->
		    <div class="panel-body">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr>
		                    	<th>N° agrément</th>
		                    	<th>N° éthique</th>
		                    	<th>Titre</th>
		                    	<th>Résponsable</th>
		                    	<th>Nb animaux accordés</th>
		                    	<th>Domaine</th>
		                    	<th>Début validité</th>
		                    	<th>Fin validité</th>
		                    	<th>Classe de sévérité</th>
		                    	<th style="min-width: 150px;">Utilisateur(s) lié(s)</th>
		                    	<th>Fichier du protocole chargé sur ownCloud ?</th>
		                    	<th>E-mail d’acceptation chargé sur ownCloud ?</th>
		                    	<th>Attestation du protocole chargé sur ownCloud ?</th>
		                    	<th>Protocole modifié ?</th>
		                    	<th>Etude rétrospective complétée chargée sur ownCloud ?</th>
		                    	<th>Actions</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	@foreach($protocols as $protocol)
			                    <tr>
			                    	<td>{{ $protocol->agrement->name }}</td>
			                    	<td>{{ $protocol->ethical_number }}</td>
			                    	<td>{{ $protocol->title }}</td>
		                    		<td>{{ $protocol->user->name }}</td>
			                    	<td>{{ $protocol->total_animals }}</td>
			                    	<td>{{ $protocol->domain->title }}</td>
			                    	<td>{{ $protocol->beginning }}</td>
			                    	<td>{{ $protocol->end }}</td>
			                    	<td>{{ $protocol->severity->title }}</td>
			                    	<td>
			                    		@foreach($protocol->users as $user)
												<div>
													{{ $user->name }}
													@can('destroy')
													<a  class="should_confirm_delete" title="Supprimer cet utilisateur de l'agrément" href="{{ route("protocol_user.destroy", ["protocol_id" => $user->pivot->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
													@endcan
												</div>
											@endforeach
										@can('create')
										<div>
											<a title="Ajouter un utilisateur de l'agrément" href="{{ route('protocol_user.create',['protocol_id' => $protocol->id]) }}">
												<i class="fa fa-plus"></i>
											</a>
										</div>
										@endcan
			                    	</td>
			                    	<td>{!! $protocol->file_uploaded !!}</td>
			                    	<td>{!! $protocol->check_acceptation_email !!}</td>
			                    	<td>{!! $protocol->check_accepted !!}</td>
			                    	<td>
			                    		{!! $protocol->is_modified !!}
			                    		<a title="Historique des modifications de ce protocole" href="{{ route("protocol.archives.index", ["protocol_id" => $protocol->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-primary"><i class="fa fa-eye"></i></button>
			                    		</a>
			                    	</td>
			                    	<td>{!! $protocol->check_retrospective_study !!}</td>
			                    	<td>
			                    		<a title="Voir les expériences de ce protocole" href="{{ route("experiences.index", ["protocol_id" => $protocol->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-primary">Exp.</button>
			                    		</a>
			                    		@can('edit')
			                    		<a title="Modifier ce protocole" href="{{ route("protocol.edit", ["id" => $protocol->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
			                    		</a>
			                    		@endcan
			                    		@can('destroy')
			                    		<a class="should_confirm_delete" title="Supprimer ce protocole" href="{{ route("protocol.destroy", ["id" => $protocol->id]) }}">
			                    			<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button>
			                    		</a>
			                    		@endcan
			                    	</td>
			                    </tr>
		                	@endforeach
		                </tbody>
		            </table>
		            {{ $protocols->links() }}
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