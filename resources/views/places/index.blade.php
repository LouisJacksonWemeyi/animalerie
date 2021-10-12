@extends('layouts.app')

@section('title', "Lieux")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			@can('create')
			<div class="panel-heading">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group {{ $errors->get('name') ? "has-error" : "" }}">
						<label>Nom du lieu</label>
						<input type="text" name="name" class="form-control"  value="{{ old('name') ? old('name') : $place->name }}" required>
						<p class="help-block">{{ $errors->first('name') }}</p>
					</div>												
					<button type="submit" class="btn btn-default">Ajouter</button>
				</form>
			</div>
			@endcan
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Nom</th>
								<th width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($places as $place)
							<tr>
								<td>{{ $place->name }}</td>
								<td>
									@can('edit')
									<a title="Modifier ce lieu" href="{{ route("place.edit", ["id" => $place->id]) }}">
										<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
									</a>
									@endcan
									@can('destroy')
									<a class="should_confirm_delete" title="Supprimer ce lieu" href="{{ route("place.destroy", ["id" => $place->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $places->links() }}
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