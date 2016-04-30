@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans('platform/admin::general.title') }}}
@stop

{{-- Queue assets: Asset::queue('name-your-asset', 'path-to-asset', array('dependency-name')) --}}

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
<style>
	.apks img {
		width: 100%;
	}
</style>
@stop

{{-- Page content --}}
@section('content')

<div class="jumbotron">

	<div class="container">

		<h1>{{{ trans('mobileinn/admin::general.welcome') }}}</h1>
		<p>{{{ trans('mobileinn/admin::general.welcome_to') }}} {{ Config::get('platform.site.title') }}</p>

	</div>

</div>

@stop
