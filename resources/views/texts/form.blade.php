@extends('layouts.app')

@section('title', "Modifier un texte")

@section('content')
	<div class="col-md-6 col-lg-12">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					
					<div class="form-group {{ $errors->get('text') ? "has-error" : "" }}">
						<label>Texte</label>
						<textarea type="text" name="text" class="textarea" 
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;resize: none;">{{ old('text') ? old('text') : $text->text }}</textarea>
						<p class="help-block">{{ $errors->first('text') }}</p>
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