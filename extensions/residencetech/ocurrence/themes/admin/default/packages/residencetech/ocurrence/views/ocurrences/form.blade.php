@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('residencetech/ocurrence::ocurrences/common.title') }}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}
{{ Asset::queue('ckeditor', 'ckeditor/js/ckeditor.js', 'jquery') }}

@section('scripts-before-compileds')
	@parent
	<script type="text/javascript">
		var CKEDITOR_BASEPATH = '{{URL::to('/') }}/themes/admin/default/assets/ckeditor/js/';
	</script>
@stop

{{-- Inline scripts --}}
@section('scripts')
@parent

<script type="text/javascript">
	CKEDITOR.replace('data', {
		on: {
			change : function(){
				var data = this.getData();
			},
			focus: function(){

			}
		}
	});

	$('#reply-btn').click(function(event){

		event.preventDefault();
        event.stopPropagation();

        var ocurrence_id = '{{$item->id}}';
        $.ajax({
			type: 'POST',
			url: '/admin/ocurrence/ocurrences/create_reply',
			data: {
				ocurrence_id: ocurrence_id,
            	data: $('#replyData').val()
			},
			success: function(response)
			{

				var div = $("#replies-template");
				var divTemplate = div.html();

				var template = _.template(divTemplate);
		        $('#replies_body').prepend(template({
		            reply: response,
		        }));

		        $('#no-results').remove();
		        $('#replyData').val('');
			},
			error: function(response)
			{
				// alertify.error(response.responseText);
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
	<form id="content-form" action="{{ request()->fullUrl() }}" role="form" method="post" data-parsley-validate data-media-form>

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
								<a class="tip" href="{{ route('admin.residencetech.ocurrence.ocurrences.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
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
								<a href="{{ route('admin.residencetech.ocurrence.ocurrences.close', $item->id) }}" class="tip" data-action-close data-toggle="tooltip" data-original-title="{{{ trans('action.close') }}}" type="close">
									<i class="fa fa-times-circle-o "></i>
									<span class="visible-xs-inline">{{{ trans('action.close') }}}</span>
								</a>
							</li>
							<li>
								<a href="{{ route('admin.residencetech.ocurrence.ocurrences.delete', $item->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
									<i class="fa fa-trash-o"></i>
									<span class="visible-xs-inline">{{{ trans('action.delete') }}}</span>
								</a>
							</li>
							@endif

							<li>
								<button class="btn btn-primary navbar-btn" data-toggle="tooltip" data-original-title="{{{ trans('action.save') }}}">
									<i class="fa fa-save"></i>
									<span class="visible-xs-inline">{{{ trans('action.save') }}}</span>
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
							{{{ trans('residencetech/ocurrence::ocurrences/common.tabs.general') }}}
						</a>
					</li>
					@if($item->exists)
						<li role="feedback">
							<a href="#feedback-tab" aria-controls="feedback" role="tab" data-toggle="tab">
								{{{ trans('residencetech/ocurrence::ocurrences/common.tabs.feedback') }}}
							</a>
						</li>
					@endif
				</ul>

				<div class="tab-content">

					{{-- Form: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general">

						<fieldset>

								<div class="form-group">
									<input type="checkbox" name="anonym" value="true"> Ocorrência Anônima
								</div>

								<div class="form-group{{ Alert::onForm('data', ' has-error') }}">

                                    <label for="data" class="control-label">
                                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('residencetech/ocurrence::ocurrences/model.general.data_help') }}}"></i>
                                        {{{ trans('residencetech/ocurrence::ocurrences/model.general.data') }}}
                                    </label>

                                    <textarea class="form-control" name="data" id="data" placeholder="{{{ trans('residencetech/ocurrence::ocurrences/model.general.data') }}}">{{{ input()->old('data', $item->data) }}}</textarea>

                                    <span class="help-block">{{{ Alert::onForm('data') }}}</span>

                                </div>

						</fieldset>

						<fieldset>

							<label for="data" class="control-label">
								{{{ trans('residencetech/ocurrence::ocurrences/form.files_updated') }}}:
							</label>

							<div class="form-group">
								@widget('firework/media::media.index', [$item, 'ocurrences'])
							</div>

						</fieldset>

					</div>

					@if($item->exists)
						@include($viewPrefix.'partial/replies')
					@endif

				</div>

			</div>

		</div>

	</form>

</section>
@stop
