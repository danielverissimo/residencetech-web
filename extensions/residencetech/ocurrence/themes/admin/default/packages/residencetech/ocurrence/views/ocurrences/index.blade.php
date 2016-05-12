@extends('firework/common::common/index')

@section('includes')

    @section('grid-filters')
        @include($viewPrefix . 'grid/filters')
    @show


@parent
@include($viewPrefix . '/grid/results')
@stop