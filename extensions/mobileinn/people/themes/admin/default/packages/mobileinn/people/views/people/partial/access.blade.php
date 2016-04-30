{{ Asset::queue('apartmentcomplex', 'mobileinn/people::js/apartmentcomplex.js', 'jquery') }}
{{ Asset::queue('underscore', 'underscore/js/underscore.js', 'jquery') }}

{{-- Tab: Access --}}
<div role="tabpanel" class="tab-pane fade" id="access-tab">

    <fieldset>

        <div class="row">

            <div class="col-md-12">

                {{-- Roles --}}
                <div class="form-group{{ Alert::onForm('roles', ' has-error') }}">

                    <label for="roles" class="control-label">
                        <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/users::model.authorization.roles_help') }}}"></i>
                        {{{ trans('platform/users::model.authorization.roles') }}}
                    </label>

                    <select name="roles[]" id="roles" multiple>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}"{{ array_key_exists($role->id, $userRoles) ? ' selected' : null }}>{{ $role->name }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ Alert::onForm('roles') }}}</span>

                </div>

            </div>

        </div>

    </fieldset>

    <fieldset>

        <legend>{{{ trans($langPrefix.'model.access') }}}</legend>

       <div class="row">

        <div class="col-md-5">
            {{-- Password --}}
            <div class="form-group{{ Alert::onForm('password', ' has-error') }}">

                <label for="password" class="control-label">
                    <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans("platform/users::model.authentication.{$mode}.password_help") }}}"></i>
                    {{{ trans("platform/users::model.authentication.{$mode}.password") }}}
                </label>

                <input type="password" class="form-control" name="password" id="password" placeholder="{{{ trans("platform/users::model.authentication.{$mode}.password") }}}"{{ ! $item->exists ? ' required' : null }} data-parsley-trigger="change" data-parsley-minlength="6" data-parsley-equalto="#password_confirmation">

                <span class="help-block">
                    {{{ Alert::onForm('password') }}}
                    {{{ $errors->first('password', ':message') }}}
                </span>

            </div>
        </div>

        <div class="col-md-5">
            {{-- Password Confirmation --}}
            <div class="form-group{{ Alert::onForm('password_confirmation', ' has-error') }}">

                <label for="password_confirmation" class="control-label">
                    <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/users::model.authentication.password_confirmation_help') }}}"></i>
                    {{{ trans("platform/users::model.authentication.password_confirmation") }}}
                </label>

                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{{ trans("platform/users::model.authentication.password_confirmation") }}}"{{ ! $item->exists ? ' required' : null }} data-parsley-trigger="change" data-parsley-equalto="#password">

                <span class="help-block">
                    {{{ Alert::onForm('password_confirmation') }}}
                    {{{ $errors->first('password_confirmation', ':message') }}}
                </span>

            </div>

            <div style="text-align:center">
                <div class="progress progress-striped active">
                   <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>

                <div id="progress-label" class="label"></div>

            </div>

        </div>
    </div>

    </fieldset>

    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="search_apartmentcomplex" class="control-label">{{{ trans($langPrefix.'/form.apartmentcomplex_name') }}}</label>
                <input type="text" class="selectize" id="search_apartmentcomplex" value="">
            </div>
        </div>
        <div class="col-md-2">
            <br />
            <a href="#" class="btn btn-primary" id="addApartmentComplex">
                <i class="fa fa-plus"></i>
                {{ trans($langPrefix.'form.add') }}
            </a>
        </div>
    </div>


    <table class="table" id="apartmentcomplex-table">
        <thead>
        <tr>
            <th>
                <span>{{ trans($langPrefix.'form.apartmentcomplexes') }}</span>
            </th>
            <th class="text-right">
                <span>{{ trans($langPrefix.'form.action') }}</span>
            </th>
        </tr>
        </thead>
        <tbody>
        @if ($allApartmentComplex)
            @foreach ($allApartmentComplex as $key => $value)
                <tr class="apartmentcomplex-line">
                    <td>
                        <input type="hidden" name="apartment_complexes[{{$key}}]" class="apartmentcomplex-list" value="{{ eloquent_get($value, 'id') }}"/>
                        {{ eloquent_get($value, 'name') }}
                    </td>
                    <td class="text-right">
                        <a href="#" class="btn btn-default removeThisApartmentComplex">
                            <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <script type="text/template" id="apartmentcomplex-template">
        <tr class="apartmentcomplex-line">
            <td>
                <input type="hidden" name="apartment_complexes[<%= countApartmentComplex %>]" class="apartmentcomplex-list" value="<%= apartmentComplex.id %>"/>
                <%= apartmentComplex.name %>
            </td>
            <td class="text-right">
                <a href="#" class="btn btn-default removeThisApartmentComplex">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>

    </script>

</div>