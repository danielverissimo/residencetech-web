@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('residencetech/apartmentcomplex::apartmentcomplexes/common.title') }}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
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
								<a class="tip" href="{{ route('admin.residencetech.apartmentcomplex.apartmentcomplexes.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
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
								<a href="{{ route('admin.residencetech.apartmentcomplex.apartmentcomplexes.delete', $item->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
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
					<li class="active" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">{{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>

								<div class="form-group{{ Alert::onForm('name', ' has-error') }}">

                                    <label for="name" class="control-label">
                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/model.general.name_help') }}}"></i>
                                        {{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/model.general.name') }}}
                                    </label>

                                    <input type="text" required class="form-control" name="name" id="name" placeholder="{{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/model.general.name') }}}" value="{{{ input()->old('name', $item->name) }}}">

                                    <span class="help-block">{{{ Alert::onForm('name') }}}</span>

                                </div>

								<div class="form-group{{ Alert::onForm('description', ' has-error') }}">

                                    <label for="description" class="control-label">
                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/model.general.description_help') }}}"></i>
                                        {{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/model.general.description') }}}
                                    </label>

                                    <textarea class="form-control" name="description" id="description" placeholder="{{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/model.general.description') }}}">{{{ input()->old('description', $item->description) }}}</textarea>

                                    <span class="help-block">{{{ Alert::onForm('description') }}}</span>

                                </div>

								<div class="form-group{{ Alert::onForm('apartmenttype_id', ' has-error') }}">

                                    <label for="apartmenttype_id" class="control-label">
                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/model.general.apartmenttype_id_help') }}}"></i>
                                        {{{ trans('residencetech/apartmentcomplex::apartmentcomplexes/model.general.apartmenttype_id') }}}
                                    </label>

									<select name="apartmenttype_id" class="form-control">

										@foreach ($apartmentTypes as $apartmentType)
											<option value="{{ $apartmentType->id }}" {{ $apartmentType->id == $item->apartmenttype_id  ? ' selected="selected"' : null }}>{{ $apartmentType->type }}</option>
										@endforeach
									</select>

                                    <span class="help-block">{{{ Alert::onForm('apartmenttype_id') }}}</span>

                                </div>


						</fieldset>

					</div>

					{{-- Form: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($item)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
