@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('mobileinn/people::people/common.title') }}
@stop

{{-- Queue assets --}}
{{ Asset::queue('selectize', 'selectize/js/selectize.js', 'jquery') }}
{{ Asset::queue('maskedinput', 'jquery/js/jquery.maskedinput.min.js', 'jquery') }}
{{ Asset::queue('selectize', 'selectize/css/selectize.css', 'styles') }}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}
{{ Asset::queue('moment', 'moment/js/moment.js', 'jquery') }}

{{ Asset::queue('bootstrap-daterange', 'bootstrap/js/daterangepicker.js', 'moment') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script>
	var base_url = '{{ URL::toAdmin("") }}';

	$(function()
	{
		// selectize
		$('select').selectize({
			sortField: "text"
		});

		// masked
		$('#cpf').mask('999.999.999-99');

		$('#telephone').mask('(99) 9999-9999');

		$('#cellphone').mask('(99) ?99999-9999');

		$('#address-zipcode').mask('99999-999');

		// location ajax
		$('#address-country_id').on('change', function(e) {
			var selectized = $("#address-state_id")[0].selectize;
			selectized.disable();
			selectized.clearOptions();
			if ($(this).val()) {
				$.get(base_url+'/locations/states/'+$(this).val()+'/lists', function(data) {
					for (var state in data.states) {
						selectized.addOption({value:data.states[state].id, text:data.states[state].name});
					}
					selectized.enable();
				});
			}
		});

		$('#address-state_id').on('change', function(e) {
			var selectized = $("#address-city_id")[0].selectize;
			selectized.disable();
			selectized.clearOptions();
			$("#city_id").html('');
			if ($(this).val()) {
				$.get(base_url+'/locations/cities/'+$(this).val()+'/lists', function(data) {
					for (var city in data.cities) {
						selectized.addOption({ value: data.cities[city].id, text: data.cities[city].name });
					}
					selectized.enable();
				});
			}
		});

        $('.birthdate').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: 'DD/MM/YYYY'
        });

        /**
         * Password strength score.
         * @param  {String} pass Password string.
         * @return {Integet}     Integer score.
         */
        function scorePassword(pass) {
		    var score = 0;
		    if (!pass)
		        return score;

		    // award every unique letter until 5 repetitions
		    var letters = new Object();
		    for (var i=0; i<pass.length; i++) {
		        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
		        score += 5.0 / letters[pass[i]];
		    }

		    // bonus points for mixing it up
		    var variations = {
		        digits: /\d/.test(pass),
		        lower: /[a-z]/.test(pass),
		        upper: /[A-Z]/.test(pass),
		        nonWords: /\W/.test(pass),
		    }

		    variationCount = 0;
		    for (var check in variations) {
		        variationCount += (variations[check] == true) ? 1 : 0;
		    }
		    score += (variationCount - 1) * 10;

		    return parseInt(score);
		}

		$("#password_confirmation").on("keypress keyup keydown", function() {
	        var pass = $(this).val();

	        var complexity = scorePassword(pass);

	        $('.progress-bar').css('width', complexity+'%').attr('aria-valuenow', complexity);

			$('#progress-label').attr('class', 'label');

			if( $(this).val().length < 6 ){

				$('#progress-label').addClass('label-default');
				$('#progress-label').text('Muito curta');

			}else if(complexity < 20){

				$('#progress-label').addClass('label-danger');
				$('#progress-label').text('Muito fraca');

			}else if(complexity >= 21 && complexity < 40){

				$('#progress-label').addClass('label-warning');
				$('#progress-label').text('Fraca');

			}else if(complexity >= 40 && complexity < 60){

				$('#progress-label').addClass('label-info');
				$('#progress-label').text('Boa');

			}else if(complexity >= 60 && complexity < 80){

				$('#progress-label').addClass('label-primary');
				$('#progress-label').text('Forte');

			}else if(complexity >= 80){

				$('#progress-label').addClass('label-success');
				$('#progress-label').text('Muito Forte');

			}

	    });
	});
</script>
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page --}}
@section('page')

<section class="panel panel-default panel-tabs">

	{{-- Form --}}
	<form id="content-form" action="{{ request()->fullUrl() }}" role="form" method="post" data-parsley-validate>

		{{-- Form: CSRF Token --}}
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<header class="panel-heading">

			<nav class="navbar navbar-default navbar-actions">

				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#actions">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<ul class="nav navbar-nav navbar-cancel">
							<li>
								<a class="tip" href="{{ route('admin.mobileinn.people.people.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
									<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
								</a>
							</li>
						</ul>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $item->exists ? $item->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($item->exists)
								<li>
									<a href="{{ route('admin.mobileinn.people.people.delete', $item->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
										<i class="fa fa-trash-o"></i> <span class="visible-xs-inline">{{{ trans('action.delete') }}}</span>
									</a>
								</li>
							@endif

							<li>
								<button class="btn btn-primary navbar-btn" data-toggle="tooltip" data-original-title="{{{ trans('action.save') }}}">
									<i class="fa fa-save"></i> <span class="visible-xs-inline">{{{ trans('action.save') }}}</span>
								</button>
							</li>

						</ul>

					</div>

				</div>

			</nav>

		</header>

		<div class="panel-body">

			<div role="tabpanel">

				{{-- Form: Tabs --}}
				<ul class="nav nav-tabs" role="tablist">
					<li class="active" role="presentation">
						<a href="#general" aria-controls="general" role="tab" data-toggle="tab">
							{{{ trans('mobileinn/people::people/common.tabs.general') }}}
						</a>
					</li>
					<li role="access">
						<a href="#access-tab" aria-controls="access" role="tab" data-toggle="tab">
							{{{ trans('mobileinn/people::people/common.tabs.access') }}}
						</a>
					</li>
					<li role="permissions">
						<a href="#permissions-tab" aria-controls="permissions" role="tab" data-toggle="tab">
							{{{ trans('mobileinn/people::people/common.tabs.permissions') }}}
						</a>
					</li>
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>
							<legend>{{{ trans('mobileinn/people::people/model.general.legend.general') }}}</legend>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group{{ Alert::onForm('name', ' has-error') }}">
										<label for="name" class="control-label">
											<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('mobileinn/people::people/model.general.name_help') }}}"></i>
											{{{ trans('mobileinn/people::people/model.general.name') }}}
										</label>

										<input type="text" class="form-control" name="name" id="name" required placeholder="{{{ trans('mobileinn/people::people/model.general.name') }}}" value="{{{ input()->old('name', $item->name) }}}">

										<span class="help-block">{{{ Alert::onForm('name') }}}</span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group{{ Alert::onForm('email', ' has-error') }}">
										<label for="email" class="control-label">
											<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('mobileinn/people::people/model.general.email_help') }}}"></i>
											{{{ trans('mobileinn/people::people/model.general.email') }}}
										</label>

										<input type="email" class="form-control" name="email" id="email" required placeholder="{{{ trans('mobileinn/people::people/model.general.email') }}}" value="{{{ input()->old('email', $item->email) }}}">

										<span class="help-block">{{{ Alert::onForm('email') }}}</span>
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group{{ Alert::onForm('gender', ' has-error') }}">
										<label for="gender" class="control-label">
											<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('mobileinn/people::people/model.general.gender_help') }}}"></i>
											{{{ trans('mobileinn/people::people/model.general.gender') }}}
										</label>

		                                <select name="gender" id="gender" required>
		                                	<option value=""></option>

		                                	@foreach(config('mobileinn-person.gender') as $gender)
		                                		<option value="{{ $gender }}" {{ (input()->old('gender', $item->gender) == $gender) ? 'selected="selected"' : '' }}>{{{ trans('mobileinn/people::people/model.general.gender_values.'.$gender) }}}</option>
											@endforeach
		                                </select>

										<span class="help-block">{{{ Alert::onForm('gender') }}}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group{{ Alert::onForm('birthdate', ' has-error') }}">
										<label for="birthdate" class="control-label">
											<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('mobileinn/people::people/model.general.birthdate_help') }}}"></i>
											{{{ trans('mobileinn/people::people/model.general.birthdate') }}}
										</label>

										<input type="text" class="form-control birthdate" name="birthdate" id="birthdate" placeholder="{{{ trans('mobileinn/people::people/model.general.birthdate') }}}" value="{{{ input()->old('birthdate', $item->birthdate ? $item->birthdate->format('d/m/Y') : '') }}}">

										<span class="help-block">{{{ Alert::onForm('birthdate') }}}</span>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group{{ Alert::onForm('cpf', ' has-error') }}">
										<label for="cpf" class="control-label">
											<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('mobileinn/people::people/model.general.cpf_help') }}}"></i>
											{{{ trans('mobileinn/people::people/model.general.cpf') }}}
										</label>

										<input type="text" class="form-control" name="cpf" id="cpf" placeholder="{{{ trans('mobileinn/people::people/model.general.cpf') }}}" value="{{{ input()->old('cpf', $item->cpf) }}}">

										<span class="help-block">{{{ Alert::onForm('cpf') }}}</span>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group{{ Alert::onForm('telephone', ' has-error') }}">

										<label for="telephone" class="control-label">
											<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('mobileinn/people::people/model.general.telephone_help') }}}"></i>
											{{{ trans('mobileinn/people::people/model.general.telephone') }}}
										</label>

										<input type="text" class="form-control" name="telephone" id="telephone" placeholder="{{{ trans('mobileinn/people::people/model.general.telephone') }}}" value="{{{ input()->old('telephone', $item->telephone) }}}">

										<span class="help-block">{{{ Alert::onForm('telephone') }}}</span>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group{{ Alert::onForm('cellphone', ' has-error') }}">
										<label for="cellphone" class="control-label">
											<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('mobileinn/people::people/model.general.cellphone_help') }}}"></i>
											{{{ trans('mobileinn/people::people/model.general.cellphone') }}}
										</label>

										<input type="text" class="form-control" name="cellphone" id="cellphone" placeholder="{{{ trans('mobileinn/people::people/model.general.cellphone') }}}" value="{{{ input()->old('cellphone', $item->cellphone) }}}">

										<span class="help-block">{{{ Alert::onForm('cellphone') }}}</span>
									</div>
								</div>
							</div>
						</fieldset>

						<fieldset>
							<legend>{{{ trans('mobileinn/people::people/model.general.legend.address') }}}</legend>

							<div class="row">
								<div class="col-md-8">
									<div class="form-group{{ Alert::onForm('address.street', ' has-error') }}">
										<label for="address-street" class="control-label">
											{{{ trans('mobileinn/people::people/model.general.address.street') }}}
										</label>

										<input type="text" class="form-control" name="address[street]" id="address-street" placeholder="{{{ trans('mobileinn/people::people/model.general.address.street') }}}" value="{{{ input()->old('address.street', eloquent_get($item, 'address.street')) }}}">

										<span class="help-block">{{{ Alert::onForm('address.street') }}}</span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group{{ Alert::onForm('address.number', ' has-error') }}">
										<label for="address-number" class="control-label">
											{{{ trans('mobileinn/people::people/model.general.address.number') }}}
										</label>

										<input type="text" class="form-control" name="address[number]" id="address-number" placeholder="{{{ trans('mobileinn/people::people/model.general.address.number') }}}" value="{{{ input()->old('address.number', eloquent_get($item, 'address.number')) }}}">

										<span class="help-block">{{{ Alert::onForm('address.number') }}}</span>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-4">
									<div class="form-group{{ Alert::onForm('address.complement', ' has-error') }}">
										<label for="address-complement" class="control-label">
											{{{ trans('mobileinn/people::people/model.general.address.complement') }}}
										</label>

										<input type="text" class="form-control" name="address[complement]" id="address-complement" placeholder="{{{ trans('mobileinn/people::people/model.general.address.complement') }}}" value="{{{ input()->old('address.complement', eloquent_get($item, 'address.complement')) }}}">

										<span class="help-block">{{{ Alert::onForm('address.complement') }}}</span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group{{ Alert::onForm('address.neighborhood', ' has-error') }}">
										<label for="address-neighborhood" class="control-label">
											{{{ trans('mobileinn/people::people/model.general.address.neighborhood') }}}
										</label>

										<input type="text" class="form-control" name="address[neighborhood]" id="address-neighborhood" placeholder="{{{ trans('mobileinn/people::people/model.general.address.neighborhood') }}}" value="{{{ input()->old('address.neighborhood', eloquent_get($item, 'address.neighborhood')) }}}">

										<span class="help-block">{{{ Alert::onForm('address.neighborhood') }}}</span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group{{ Alert::onForm('address.zipcode', ' has-error') }}">
										<label for="address-zipcode" class="control-label">
											{{{ trans('mobileinn/people::people/model.general.address.zipcode') }}}
										</label>

										<input type="text" class="form-control" name="address[zipcode]" id="address-zipcode" placeholder="{{{ trans('mobileinn/people::people/model.general.address.zipcode') }}}" value="{{{ input()->old('address.zipcode', eloquent_get($item, 'address.zipcode')) }}}">

										<span class="help-block">{{{ Alert::onForm('address.neighborhood') }}}</span>
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col-md-4">
									{{-- Country --}}
									<div class="form-group{{ $errors->first("address.country_id", ' has-error') }}">
										<label for="address-country_id" class="control-label">{{ trans('mobileinn/people::people/model.general.address.country') }}</label>

										<select name="address[country_id]" id="address-country_id" required>
											<option value=""></option>
											@foreach ($countries as $country)
											<option value="{{ $country->id }}" {{ (Input::old("address.country_id", eloquent_get($item, 'address.country_id')) == $country->id ? ' selected="selected"' : null) }}>
												{{ $country->name }}
											</option>
											@endforeach
										</select>

										<span class="help-block">{{{ $errors->first("address.country_id", ':message') }}}</span>
									</div>
								</div>

								<div class="col-md-4">
									{{-- States --}}
									<div class="form-group{{ $errors->first("address.state_id", ' has-error') }}">
										<label for="address-state_id" class="control-label">{{ trans('mobileinn/people::people/model.general.address.state') }}</label>

										<select name="address[state_id]" id="address-state_id" required>
											<option value=""></option>
											@foreach ($states as $state)
												<option value="{{ $state->id }}" {{ (Input::old("address.state_id", eloquent_get($item, 'address.state_id')) == $state->id ? ' selected="selected"' : null) }}>
													{{ $state->name }}
												</option>
											@endforeach
										</select>

										<span class="help-block">{{{ $errors->first("address.state_id", ':message') }}}</span>
									</div>
								</div>

								<div class="col-md-4">
									{{-- Cities --}}
									<div class="form-group{{ $errors->first("address.city_id", ' has-error') }}">
										<label for="address-city_id" class="control-label">{{ trans('mobileinn/people::people/model.general.address.city') }}</label>

										<select name="address[city_id]" id="address-city_id" required>
											<option value=""></option>
											@foreach ($cities as $city)
												<option value="{{ $city->id }}" {{ Input::old("address.city_id", eloquent_get($item, 'address.city_id')) == $city->id ? ' selected="selected"' : null }}>
													{{ $city->name }}
												</option>
											@endforeach
										</select>

										<span class="help-block">{{{ $errors->first("address.city_id", ':message') }}}</span>
									</div>
								</div>
							</div>
						</fieldset>
					</div>

					@include($viewPrefix.'partial/access')

					@include($viewPrefix.'partial/permissions')

				</div>
			</div>
		</div>
	</form>
</section>
@stop
