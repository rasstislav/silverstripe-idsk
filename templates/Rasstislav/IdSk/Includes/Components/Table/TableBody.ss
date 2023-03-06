<table class="idsk-table">
	<thead class="idsk-table__head">
		<tr class="idsk-table__row">
			$Header
		</tr>
	</thead>
	<tbody class="idsk-table__body">
		<% if $Body %>
		    $Body
		<% else_if $EmptyMessage %>
			<% template 'Rasstislav/IdSk/Includes/Components/Table/TableRow' %>
                <% set Cells %>
                	<% include Rasstislav/IdSk/Includes/Components/Table/TableCell Value=$EmptyMessage %>
                <% end_set %>
            <% end_template %>
		<% end_if %>
	</tbody>
</table>
