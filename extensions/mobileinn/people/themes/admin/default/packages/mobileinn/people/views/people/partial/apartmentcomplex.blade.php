{{ Asset::queue('apartmentcomplex', 'mobileinn/people::js/apartmentcomplex.js', 'jquery') }}
{{ Asset::queue('underscore', 'underscore/js/underscore.js', 'jquery') }}

{{-- Form: Access --}}
<div role="tabpanel" class="tab-pane fade in" id="access">
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