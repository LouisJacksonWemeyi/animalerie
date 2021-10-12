@extends('layouts.app')

@section('title', "Contacts")

@section('content')
<!-- /.row -->
<div class="row">
	<div class="col-md-6 col-lg-12">
		<div class="box-body">
			@can('create')
			<a type="button" href="{{ route("category_contact.create") }}" class="btn btn-primary pull-right">Ajouter une catégorie</a>
			@endcan
		</div>
		    <div class="box-body">
		    		<div class="box-body">
		    			<div class="box-group" id="accordion">
		    				<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
		    				@foreach($categories as $key => $category)
		    				<div class="panel box">
		    					<div class="box-header with-border">
		    						<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}">
		    							<h4 class="box-title"><i class="fa fa-arrow-right"></i> {{ $category->name }}</h4>
		    						</a>
									@can('delete')
		    						<a class="should_confirm_delete pull-right" title="Supprimer cette catégorie de contacts" href="{{ route("category_contact.destroy", ["id" => $category->id]) }}">
		    							<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i>
		    							</button>
		    						</a>
		    						@endcan
		    						@can('update')
		    						<a class="pull-right" title="Modifier cette catégorie de contacts" href="{{ route("category_contact.edit", ["id" => $category->id]) }}">
		    							<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i>
		    							</button>
		    						</a>
		    						@endcan
		    						@can('create')
		    						<a class="pull-right" title="Ajouter un contact à cette catégorie" href="{{ route("contact.create", ["category_id" => $category->id]) }}">
		    							<button type="button" class="btn btn-outline btn-primary"><i class="fa fa-plus"></i>
		    							</button>
		    						</a>
		    						@endcan
		    					</div>
		    					<div id="collapse{{ $key }}" class="panel-collapse collapse">
		    						<div class="box-body">
		    							@foreach($category->contacts as $contact)
											<div class="box-body" style="border-bottom: 1px solid lightgray;">
												{{ $contact->name }} - 
												<a href="mailto:{{ $contact->email }}">{{ $contact->email }}
												</a> - 
												{{ $contact->phone }} -
												{{ $contact->note }}
												@can('delete')
												<a class="should_confirm_delete pull-right" title="Supprimer ce contact" href="{{ route("contact.destroy", ["id" => $contact->id]) }}">
													<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i>
													</button>
												</a>
												@endcan
												@can('update')
												<a class="pull-right" title="Modifier ce contact" href="{{ route("contact.edit", ["id" => $contact->id]) }}">
													<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i>
													</button>
												</a>
												@endcan
											</div>
										@endforeach
									</div>
		    						<div class="box-body">

		    						</div>
		    					</div>
		    				</div>
		    				@endforeach
		    			</div>
		    		</div>
		    		<!-- /.box-body -->
			</div>
			<!-- /.box-body -->
	</div>
</div>
<!-- /.row -->
@endsection