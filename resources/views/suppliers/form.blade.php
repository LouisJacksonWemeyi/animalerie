@extends('layouts.app')

@section('title', "Ajouter un fournisseur")

@section('content')
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group">
						<label>Nom</label>
						<input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
					</div>						
					<div class="form-group">
						<label>Contact</label>
						<input type="text" name="contact" class="form-control" value="{{ $supplier->contact }}" required>
					</div>	
					<button type="submit" class="btn btn-default">Valider</button>
				</form>
		    </div>
		    <!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
@endsection