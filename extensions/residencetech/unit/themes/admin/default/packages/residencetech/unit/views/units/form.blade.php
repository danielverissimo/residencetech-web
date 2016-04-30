@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('residencetech/unit::units/common.title') }}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}
{{ Asset::queue('selectize', 'selectize/js/selectize.js', 'jquery') }}
{{ Asset::queue('selectize', 'selectize/css/selectize.css', 'styles') }}
{{ Asset::queue('unit', 'residencetech/unit::js/script.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script>
	var base_url = '{{ URL::toAdmin("") }}';

	$(function()
	{

		var $selectOwner = $('#owner_search').selectize({
			valueField: 'id',
			labelField: 'name',
			searchField: ['id','name'],
			options: [],
			render: {
				option: function(item, escape) {
					return '<div>' + escape(item.name) + '</div>';
				}
			},
			load: function(query, callback) {

				this.clear();
				this.clearOptions();

				if (!query.length) return callback();
				$.ajax({
					url: base_url + '/people/people/findPeopleOnComplex',
					type: 'GET',
					data: {
						q: query
					},
					error: function() {
						callback();
					},
					success: function(res) {
						callback(res);
					}
				});
			},
			onChange: function(value) {
				if (!value) return;
			}
		});

		var selectize = $selectOwner[0].selectize;


		@if ($owner)
			selectize.addOption({id:{{ $owner->id }}, name: '{{ $owner->name  }}'}); //option can be created manually or loaded using Ajax
			selectize.addItem({{$owner->id}});
		@endif

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
								<a class="tip" href="{{ route('admin.residencetech.unit.units.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
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
								<a href="{{ route('admin.residencetech.unit.units.delete', $item->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
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
					<li class="active" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">{{{ trans('residencetech/unit::units/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('residencetech/unit::units/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>

								<div class="form-group{{ Alert::onForm('name', ' has-error') }}">

                                    <label for="name" class="control-label">
                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('residencetech/unit::units/model.general.name_help') }}}"></i>
                                        {{{ trans('residencetech/unit::units/model.general.name') }}}
                                    </label>

                                    <input type="text" class="form-control" required name="name" id="name" placeholder="{{{ trans('residencetech/unit::units/model.general.name') }}}" value="{{{ input()->old('name', $item->name) }}}">

                                </div>

								<div class="form-group{{ Alert::onForm('block_id', ' has-error') }}">

                                    <label for="block_id" class="control-label">
                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('residencetech/unit::units/model.general.block_id_help') }}}"></i>
                                        {{{ trans('residencetech/unit::units/model.general.block_id') }}}
                                    </label>

									<select required name="block_id" class="form-control">
										<option value="">Selecione uma opção</option>
										@foreach ($blocks as $block)
											<option value="{{ $block->id }}" {{ $block->id == $item->block_id  ? ' selected="selected"' : null }}>{{ $block->name}}</option>
										@endforeach
									</select>

                                    <span class="help-block">{{{ Alert::onForm('block_id') }}}</span>

                                </div>

								<div class="form-group{{ Alert::onForm('owner_id', ' has-error') }}">

                                    <label for="owner_id" class="control-label">
                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('residencetech/unit::units/model.general.owner_id_help') }}}"></i>
                                        {{{ trans('residencetech/unit::units/model.general.owner_id') }}}
                                    </label>

									<select class="selectize" id="owner_search" name="owner_id" required>
										<option></option>
									</select>

                                    <span class="help-block">{{{ Alert::onForm('owner_id') }}}</span>

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
