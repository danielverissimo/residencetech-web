<script type="text/template" data-grid="{{ $dataGrid['name'] }}" data-template="results">

    <% _.each(results, function(r) { %>

        <tr data-grid-row>
            <td><input data-grid-checkbox type="checkbox" name="row[]" value="<%= r.id %>"></td>
            @foreach($columns as $key => $column)
            <td>
                <a href="<%= r.edit_uri %>"><%= r.{{ $column }} %></a>
            </td>
            @endforeach
        </tr>

    <% }); %>

</script>
