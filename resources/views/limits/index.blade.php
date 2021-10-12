@extends('layouts.app')

@section('title', "Gérer les limites")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<th>Pour</th>
							<th>Extrême basse</th>
							<th>Basse</th>
							<th>Haute</th>
							<th>Extrême haute</th>
							<th>Couleur normale</th>
							<th>Couleur limite</th>
							<th>Couleur extrême limite</th>
							<th width="10%">Actions</th>
						</tr>
						@foreach($limits as $limit)
							<tr>
								<td>{{ trans("display.".$limit->for)}}</td>
								<td>{{ $limit->extrem_down }}</td>
								<td>{{ $limit->down }}</td>
								<td>{{ $limit->up }}</td>
								<td>{{ $limit->extrem_up }}</td>
								<td style="background-color: {{ $limit->normal_color }}">{{ $limit->normal_color }}</td>
								<td style="background-color: {{ $limit->color }}">{{ $limit->color }}</td>
								<td style="background-color: {{ $limit->extrem_color }}">{{ $limit->extrem_color }}</td>
								<td>
									@can('edit')
									<a title="Modifier cette limite" href="{{ route("limit.edit", ["id" => $limit->id]) }}"><button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i></button></a>
									@endcan
								</td>
							</tr>
						@endforeach
					</table>
				</div>
				<!-- /.table-responsive -->
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col-lg-12 -->
</div>
@endsection