{{-- Tab: Reply --}}
<div role="tabpanel" class="tab-pane fade" id="feedback-tab">

    <fieldset>

        <div class="row">

            <div class="col-md-12">

                {{-- Replies --}}
                <div class="form-group{{ Alert::onForm('feedback', ' has-error') }}">

                    <label for="replyData" class="control-label">
                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('residencetech/ocurrence::ocurrences/form.reply.title_help') }}}">
                        </i>
                        {{{ trans('residencetech/ocurrence::ocurrences/form.reply.title') }}}
                    </label>

                    <textarea class="form-control" name="replyData" id="replyData" placeholder="{{{ trans('residencetech/ocurrence::ocurrences/form.reply.title_help') }}}..."></textarea>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">
                <button id="reply-btn" data-original-title="Reply" data-toggle="tooltip" class="btn btn-primary pull-right">
                    <i class="fa fa-reply-all"></i>
                    <span class="visible-xs-inline">Reply</span>
                </button>
            </div>
        </div>

    </fieldset>

    <fieldset>

        <div class="form-group">
            <label for="reply" class="control-label">
                {{{ trans('residencetech/ocurrence::ocurrences/form.replies') }}}
            </label>
        </div>

        <div id="replies_body">
            @if(! $replies->isEmpty())
                @foreach($replies as $reply)
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" readonly>{{$reply->data}}</textarea>
                                <br/>
                                <b>Por {{ $reply->person->name }} - Em {{  $reply->created_at }}</b>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center;" id="no-results">
                    <br>
                    <label class="control-label">
                        {{ trans($langPrefix . 'form.no_results') }}
                    </label>
                </div>
            @endif
        </div>

    </fieldset>

</div>

@section('scripts')
@parent

    <script type="text/template" id="replies-template">

        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <textarea class="form-control" readonly><%= reply.data %></textarea>
                    <br/>
                    <b>Por <%= reply.personName %> - Em <%= reply.created_at %></b>
                </div>
            </div>
        </div>

    </script>

@stop