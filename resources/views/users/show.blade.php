@extends('layouts.app')

@section('title', "Utilisateur")

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ $user->name }}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-4">
			<div class="form-group">
	        	<label>Email</label>
	        	<p class="form-control-static">{{ $user->email }}</p>
	    	</div>
	    </div>		
	    <div class="col-lg-4">
			<div class="form-group">
	        	<label>Agréments</label>
	        	@foreach($user->agrements as $agrement)
	        		<p class="form-control-static">{{ $agrement->name }}</p>
	        	@endforeach
	    	</div>
	    </div>	    
	    <div class="col-lg-4">
			<div class="form-group">
	        	<label>Rang</label>
	        		<p class="form-control-static">{{ $user->rank->name }}</p>
	    	</div>
	    </div>	    
    </div>
	<div class="col-lg-4">
		<form action="" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="form-group">
				<label>Changer votre mot de passe</label>
				<input type="text" name="new_password" class="form-control" required>
			</div>										
			<button type="submit" class="btn btn-default">Changer</button>
		</form>
	</div>
</div>
<!-- /.row -->
@endsection