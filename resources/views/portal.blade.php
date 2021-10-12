@extends('layouts.app')

@section('title', "Portail")

@section('content')
<style>
	.animate-spin {
	    -animation: spin 1.5s infinite linear;
	    -webkit-animation: spin2 1.5s infinite linear;
	}

	@-webkit-keyframes spin2 {
	    from { -webkit-transform: rotate(0deg);}
	    to { -webkit-transform: rotate(360deg);}
	}

	@keyframes spin {
	    from { transform: scale(1) rotate(0deg);}
	    to { transform: scale(1) rotate(360deg);}
	}
</style>
<div class="row">
	<div class="col-md-12">

	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-8">
			@can('global-mail')
			<div style="margin-bottom: 20px;">
				<button type="button" class="btn btn-social btn-primary" data-toggle="modal" data-target="#modal-default">
					<i class="fa fa-envelope"></i>
					E-mail global
				</button>
			</div>
			@endcan
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">News</h3>
					@can('create')
					<a type="button" href="{{ route("new.create") }}" class="btn btn-primary pull-right">Ajouter</a>
					@endcan
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="box-group" id="accordion">
						<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
						@foreach($news as $key => $new)
						<div class="panel box" style="border-top-color: {{ $new->display_color }};">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}">
								<div class="box-header with-border">
									<h4 class="box-title">{{ $new->title }}</h4>
								</div>
							</a>
							<div id="collapse{{ $key }}" class="panel-collapse collapse">
								<div class="box-body">{{ $new->content}}</div>
								<div class="box-body">
									@can('destroy')
									<a class="pull-right should_confirm_delete" href="{{ route("new.destroy", ["id" => $new->id]) }}">
										<button type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash-o"></i>
										</button>
									</a>
									@endcan
									@can('edit')
									<a class="pull-right" href="{{ route("new.edit", ["id" => $new->id]) }}">
										<button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i>
										</button>
									</a>
									@endcan
								</div>
							</div>
						</div>
						@endforeach
					</div>
					{{ $news->links() }}
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<div class="col-sm-6 col-md-6 col-lg-4">
			<div id='calendar'></div>
			<div id='calendar2'></div>
		</div>	
	</div>
</div>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Envoyer un mail groupé à tout le monde</h4>
				</div>
				<div class="modal-body">
					<input id="object_mail" class="form-control" rows="3" placeholder="Objet du mail">
					<textarea id="message_mail" class="form-control" rows="3" placeholder="Votre message"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="close_modal">Fermer</button>
					<button type="button" id="send_mail"class="btn btn-primary"><span class="submit-icon fa fa-refresh animate-spin" style="display: none;"></span> <span class="submit-text">Envoyer</span></button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<link rel="stylesheet" href="{{ config('app.url') }}resources/assets/app/plugins/qtip/jquery.qtip.css">
	<link rel='stylesheet' href='{{ config('app.url') }}resources/assets/app/plugins/fullcalendar/fullcalendar.min.css' />
	<script src='{{ config('app.url') }}resources/assets/app/js/lib/moment.min.js'></script>
	<script src='{{ config('app.url') }}resources/assets/app/plugins/fullcalendar/fullcalendar.min.js'></script>
	<script src='{{ config('app.url') }}resources/assets/app/plugins/fullcalendar/locale/fr.js'></script>
	<script src='{{ config('app.url') }}resources/assets/app/plugins/qtip/jquery.qtip.js'></script>
	<script>
		$(function() {

			$("#send_mail").on('click',function(){
				if ($("#object_mail").val() != "" && $("#message_mail").val() != "" ) 
				{
					$('.submit-icon').show();
					$('.submit-text').text('Envoi...');
					$('#send_mail').attr("disabled", true);

					$.ajax({
						url: "{{ route("mails.global.send") }}",
						dataType: "json",
						type: "POST",
						headers: {
	                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                    },
						data:{
							object : $("#object_mail").val(),
							message : $("#message_mail").val()
						},
						success: function(response){
							$('.submit-icon').hide();
							$('.submit-text').text('Envoyer');
							$('#send_mail').attr("disabled", false);

							$("#object_mail").val("");
							$("#message_mail").val("");
							$("#close_modal")[0].click();
						}
					});
				}
			});

			$('#calendar').fullCalendar({
				locale: 'fr',
				dateFormat: 'dd/mm/yy',
				eventSources: [
				{
					url: '{{ route("events.json") }}',
					type: 'POST',
					headers: {
					       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					   },
				}
				],
				eventRender: function(event, element) {
					element.qtip({
						content: event.description
					});
				}
			});

			$('#calendar2').fullCalendar({
				locale: 'fr',
				dateFormat: 'dd/mm/yy',
				defaultDate: moment().add(1, "month"),
				eventSources: [
				{
					url: '{{ route("events.json") }}',
					type: 'POST',
					headers: {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				}
				],
				eventRender: function(event, element) {
					element.qtip({
						content: event.description
					});
				}
			});

		});
	</script>
	@endsection