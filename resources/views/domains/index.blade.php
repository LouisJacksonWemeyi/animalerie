@extends('layouts.app')

@section('title', "Domaines d'application")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			@can('create')
			<div class="panel-heading">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group {{ $errors->get('title') ? "has-error" : "" }}">
						<label>Nom du domaine</label>
						<input type="text" name="title" class="form-control" value="{{  old('title') ? old('title') : '' }}" required>
						<p class="help-block">{{ $errors->first('title') }}</p>
					</div>							
					<button type="submit" class="btn btn-default">Ajouter</button>
				</form>
			</div>
			@endcan
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
							@foreach($domains as $domain)
							<tr>
								<td>{{ $domain->title }}</td>
								<td>
									@can('edit')
			                    	<a title="Modifier ce domaine" href="{{ route("domain.edit", ["id" => $domain->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
			                    	@endcan
			                    	@can('destroy')
									<a class="should_confirm_delete" title="Supprimer ce domaine" href="{{ route("domain.destroy", ["id" => $domain->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $domains->links() }}
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