// Globals
var countApartmentComplex = 0;

function bindRemoveApartmentComplexButtons() {
    $('.removeThisApartmentComplex').on('click', function(e){
        e.preventDefault();
        $(this).closest('tr.apartmentcomplex-line').remove();
    });
}

$(function(){

    $(document).on('click', '#addApartmentComplex', function(e) {
        e.preventDefault();

        var divTemplate = $("#apartmentcomplex-template").html();

        var $select = $('#search_apartmentcomplex');
        var select = $('#search_apartmentcomplex')[0].selectize;

        var apartmentcomplex_id = $select.val();
        var apartmentcomplex_name = select.getItem(apartmentcomplex_id).html();

        var error = false;

        $('.apartmentcomplex-list').each(function(){
            if ($(this).val() == apartmentcomplex_id) {
                error = true;
            }
        });

        if (error) {
            return false;
        }

        countApartmentComplex = $('.apartmentcomplex-line').size();

        var template = _.template(divTemplate);
        $('#apartmentcomplex-table tbody').append(template({
            apartmentComplex: {id: apartmentcomplex_id, name: apartmentcomplex_name},
        }));

        bindRemoveApartmentComplexButtons();

        select.clearOptions();
    });

    $('#search_apartmentcomplex').selectize({
        plugins: ['remove_button'],
        maxItems: 1,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        create: false,
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: base_url + '/apartmentcomplex/apartmentcomplexes/search',
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
        }
    });

    $("#addApartmentComplex").attr('disabled', true);
    $('#search_apartmentcomplex')[0].selectize.on('change', function(e){
        var v = + ($('#search_apartmentcomplex').val());
        if(v > 0) {
            $("#addApartmentComplex").attr('disabled', false);
        } else {
            $("#addApartmentComplex").attr('disabled', true);
        }
    });

    bindRemoveApartmentComplexButtons();

});