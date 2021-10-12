@extends('layouts.app')

@section('title', "Réinitialisation du mot de passe")

@section('content')
<div class="row">

	<div class="col-lg-12">
		@if(Session::has('danger'))
			<div class="alert alert-danger alert-dismissible">
			    <h4><i class="icon fa fa-times"></i>{{ Session::get('danger') }}</h4>
			</div>
		@endif
		<h1 class="page-header">{{ $user->name }}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
        <div class="container" style="font-size:24px;"><span class="fa-stack  fa-lg"><i class="fa fa-lock fa-2x" style="color:red;"></i></span><span>Mot de passe oublié ?</span> 
        </div>
		<hr>
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

										
					<div class="form-group {{ $errors->get('email') ? "has-error" : "" }}">
						<label>E-mail<small> (Veuillez introduire l'adresse E-mail liée à votre compte)</small></label>
						<input type="email" name="email" class="form-control" value="{{ old('email') ? old('email') : $user->email }}" required>
					    <p class="help-block">{{ $errors->first('email') }}</p>
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