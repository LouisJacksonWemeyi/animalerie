@extends('layouts.app')

@section('title', "Ajouter/éditer un protocole")

@section('content')
<div class="row">
	<div class="col-md-3 col-lg-3"></div>
	<div class="col-md-6 col-lg-6">
		<div class="box box-primary">
		    <div class="box-body">
				<form action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group {{ $errors->get('title') ? "has-error" : "" }}">
						<label>Titre</label>
						<textarea name="title" rows="3" class="form-control" required>{{ old('title') ? old('title') : $protocol->title }}</textarea>
						<p class="help-block">{{ $errors->first('title') }}</p>
					</div>
					<div class="form-group hidden {{ $errors->get('title') ? "has-error" : "" }}">
						<label>Titre</label>
						<textarea name="title_old" rows="3" class="form-control" required>{{ old('title') ? old('title') : $protocol->title }}</textarea>
						<p class="help-block">{{ $errors->first('title') }}</p>
					</div>

					<div class="form-group {{ $errors->get('ethical_number') ? "has-error" : "" }}">
						<label>N° éthique</label>
						<input type="text" name="ethical_number" class="form-control" value="{{ old('ethical_number') ? old('ethical_number') : $protocol->ethical_number }}" required>
						<p class="help-block">{{ $errors->first('ethical_number') }}</p>
					</div>
					<div class="form-group hidden {{ $errors->get('ethical_number') ? "has-error" : "" }}">
						<label>N° éthique</label>
						<input type="text" name="ethical_number_old" class="form-control" value="{{ old('ethical_number') ? old('ethical_number') : $protocol->ethical_number }}" required>
						<p class="help-block">{{ $errors->first('ethical_number') }}</p>
					</div>

					<div class="form-group  {{ $errors->get('total_animals') ? "has-error" : "" }}">
						<label>Total des animaux</label>
						<input type="number" step="1" name="total_animals" class="form-control" value="{{ old('total_animals') ? old('total_animals') : $protocol->total_animals }}">
						<p class="help-block">{{ $errors->first('total_animals') }}</p>
					</div>
					<div class="form-group hidden {{ $errors->get('total_animals') ? "has-error" : "" }}">
						<label>Total des animaux</label>
						<input type="number" step="1" name="total_animals_old" class="form-control" value="{{ old('total_animals') ? old('total_animals') : $protocol->total_animals }}">
						<p class="help-block">{{ $errors->first('total_animals') }}</p>
					</div>


					<div class="form-group {{ $errors->get('date_beginning') ? "has-error" : "" }}">
						<label>Date de début</label>
						<input type="date" name="date_beginning" class="form-control" value="{{ old('date_beginning') ? old('date_beginning') : $protocol->value_beginning }}">
						<p class="help-block">{{ $errors->first('date_beginning') }}</p>
					</div>
					<div class="form-group hidden {{ $errors->get('date_beginning') ? "has-error" : "" }}">
						<label>Date de début</label>
						<input type="date" name="date_beginning_old" class="form-control" value="{{ old('date_beginning') ? old('date_beginning') : $protocol->value_beginning }}">
						<p class="help-block">{{ $errors->first('date_beginning') }}</p>
					</div>

					<div class="form-group {{ $errors->get('date_end') ? "has-error" : "" }}">
						<label>Date de fin</label>
						<input type="date" name="date_end" class="form-control" value="{{ old('date_end') ? old('date_end') : $protocol->value_end}}">
						<p class="help-block">{{ $errors->first('date_end') }}</p>
					</div>
					<div class="form-group hidden {{ $errors->get('date_end') ? "has-error" : "" }}">
						<label>Date de fin</label>
						<input type="date" name="date_end_old" class="form-control" value="{{ old('date_end') ? old('date_end') : $protocol->value_end}}">
						<p class="help-block">{{ $errors->first('date_end') }}</p>
					</div>

					<div class="form-group {{ $errors->get('application_domain_id') ? "has-error" : "" }}">
						<label>Domaine d'application</label>
						<select class="form-control" name="application_domain_id">
							@foreach($domains as $domain)
						    	<option value="{{ $domain->id }}" {{ $domain->hasToBeSelected($protocol->application_domain_id, old('application_domain_id')) }}>{{ $domain->title }}</option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('application_domain_id') }}</p>
					</div>	
					<div class="form-group hidden {{ $errors->get('application_domain_id') ? "has-error" : "" }}">
						<label>Domaine d'application</label>
						<select class="form-control" name="application_domain_id_old">
							@foreach($domains as $domain)
						    	<option value="{{ $domain->id }}" {{ $domain->hasToBeSelected($protocol->application_domain_id, old('application_domain_id')) }}>{{ $domain->title }}</option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('application_domain_id') }}</p>
					</div>

					<div class="form-group {{ $errors->get('severity_id') ? "has-error" : "" }}">
						<label>Classe de sévérité</label>
						<select class="form-control" name="severity_id">
							@foreach($severities as $severity)
						    	<option value="{{ $severity->id }}" {{ $severity->hasToBeSelected($protocol->severity_id, old('severity_id')) }}>{{ $severity->title }}</option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('severity_id') }}</p>
					</div>
					<div class="form-group hidden {{ $errors->get('severity_id') ? "has-error" : "" }}">
						<label>Classe de sévérité</label>
						<select class="form-control" name="severity_id_old">
							@foreach($severities as $severity)
						    	<option value="{{ $severity->id }}" {{ $severity->hasToBeSelected($protocol->severity_id, old('severity_id')) }}>{{ $severity->title }}</option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('severity_id') }}</p>
					</div>

					<div class="form-group {{ $errors->get('agrement_id') ? "has-error" : "" }}">
						<label>Agrément</label>
						<select class="form-control" name="agrement_id">
							@foreach($agrements as $agrement)
						    	<option value="{{ $agrement->id }}" {{ $agrement->hasToBeSelected($protocol->agrement_id, old('agrement_id')) }}>{{ $agrement->name }}</option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('agrement_id') }}</p>
					</div>
					<div class="form-group hidden {{ $errors->get('agrement_id') ? "has-error" : "" }}">
						<label>Agrément</label>
						<select class="form-control" name="agrement_id_old">
							@foreach($agrements as $agrement)
						    	<option value="{{ $agrement->id }}" {{ $agrement->hasToBeSelected($protocol->agrement_id, old('agrement_id')) }}>{{ $agrement->name }}</option>
						    @endforeach
						</select>
						<p class="help-block">{{ $errors->first('agrement_id') }}</p>
					</div>
					
					<div class="form-group {{ $errors->get('uploaded') ? "has-error" : "" }}">
					  	<label>
					    	Fichier du protocole chargé sur ownCloud ?
					  	</label><br/>
					    <input type="checkbox" value="1" name="uploaded" {{ $protocol->uploaded == true ? "checked" : ""}}>
					    <p class="help-block">{{ $errors->first('uploaded') }}</p>
					</div>					
					<div class="form-group {{ $errors->get('acceptation_email') ? "has-error" : "" }}">
					  	<label>
					    	E-mail d’acceptation chargé sur ownCloud ?
					  	</label><br/>
					    <input type="checkbox" value="1" name="acceptation_email" {{ $protocol->acceptation_email == true ? "checked" : ""}}>
					    <p class="help-block">{{ $errors->first('acceptation_email') }}</p>
					</div>
					<div class="form-group {{ $errors->get('accepted') ? "has-error" : "" }}">
					  	<label>
					    	Attestation du protocole chargé sur ownCloud ?
					  	</label><br/>
					    <input type="checkbox" value="1" name="accepted" {{ $protocol->accepted == true ? "checked" : ""}}>
					    <p class="help-block">{{ $errors->first('accepted') }}</p>
					</div>
					<div class="form-group {{ $errors->get('retrospective_study') ? "has-error" : "" }}">
					  	<label>
					    	Etude rétrospective complétée chargée sur ownCloud ?
					  	</label><br/>
					    <input type="checkbox" value="1" name="retrospective_study" {{ $protocol->retrospective_study == true ? "checked" : ""}}>
					    <p class="help-block">{{ $errors->first('retrospective_study') }}</p>
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