@extends('layouts.app')

@section('title', "ownCloud")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box box-primary">
		    <div class="box-body">
		    	{!! nl2br($text->text) !!}
		    	@can('edit')
		    	<a class="pull-right" href="{{ route("text.edit", ["id" => $text->id]) }}">
		    		<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i>
		    		</button>
		    	</a>
		    	@endcan
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
		<div class="panel panel-default">
			@can('create')
			<div class="panel-heading">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group col-lg-6 {{ $errors->get('title') ? "has-error" : "" }}">
						<label>Titre</label>
						<input type="text" name="title" class="form-control"  value="{{ old('title') ? old('title') : $link->title }}" required>
						<p class="help-block">{{ $errors->first('title') }}</p>
					</div>						
					<div class="form-group col-lg-6 {{ $errors->get('url') ? "has-error" : "" }}">
						<label>Lien</label>
						<input type="url" name="url" class="form-control"  value="{{ old('url') ? old('url') : $link->url }}" required>
						<p class="help-block">{{ $errors->first('url') }}</p>
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
								<th>Titre</th>
								<th>Lien</th>
								<th width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($links as $link)
							<tr>
								<td>{{ $link->title }}</td>
								<td><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></td>
								<td>
									@can('edit')
									<a title="Modifier ce lien" href="{{ route("link.edit", ["id" => $link->id]) }}">
										<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button>
									</a>
									@endcan
									@can('destroy')
									<a class="should_confirm_delete" title="Supprimer ce lien" href="{{ route("link.destroy", ["id" => $link->id]) }}"><button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i></button></a>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $links->links() }}
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