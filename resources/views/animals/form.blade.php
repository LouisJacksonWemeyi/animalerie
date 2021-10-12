@extends('layouts.app')

@section('title', "Ajouter ligne dans le registre d'animaux")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label>Entrée</label>
						<input type="text" name="number_in" class="form-control" value="{{ $animal->number_in }}">
					</div>
					<div class="form-group">
						<label>Expérience liée</label>
						<select name="experience_id" class="form-control" required>
							@foreach($experiences as $experience)
								<option value="{{ $experience->id }}" {{ $animal->experience_id == $experience->id ? "selected" : "" }}>{{ $experience->number }}</option>
							@endforeach
						</select>
					</div>		
					<div class="form-group">
						<label>Fournisseur</label>
						<select name="supplier_id" class="form-control" required>
							@foreach($suppliers as $supplier)
								<option value="{{ $supplier->id }}" {{ $animal->supplier_id == $supplier->id ? "selected" : "" }}>{{ $supplier->name }}</option>
							@endforeach
						</select>
					</div>						
					<div class="form-group">
						<label>N° livraison</label>
						<input type="text" name="delivery_number" class="form-control" value="{{ $animal->delivery_number }}" required>
					</div>							
					<div class="form-group">
						<label>Espèce</label>
						<select name="specie_id" class="form-control" required>
							@foreach($species as $specie)
								<option value="{{ $specie->id }}" {{ $animal->specie_id == $specie->id ? "selected" : "" }}>{{ $specie->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Souche</label>
						<input type="text" name="strain" class="form-control" value="{{ $animal->strain }}" required="">
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