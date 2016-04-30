{{-- Tab: Permissions --}}
<div role="tabpanel" class="tab-pane fade" id="permissions-tab">

    <fieldset>

        <legend>{{{ trans('platform/users::model.permissions.legend') }}}</legend>

        <div class="row">

            <div class="col-md-12">

                @permissions($permissions)

            </div>

        </div>

    </fieldset>

</div>