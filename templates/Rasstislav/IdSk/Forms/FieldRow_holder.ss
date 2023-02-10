<div <% if $Name %>id="$Name"<% end_if %> class="govuk-grid-row idsk-table-filter__filter-inputs<% if $extraClass %> $extraClass<% end_if %>">
	<% loop $FieldList %>
		$FieldHolder
	<% end_loop %>
</div>
