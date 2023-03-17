<% if $UseButtonTag %>
	<button $addExtraClass('idsk-button submit-table-filter').AttributesHTML>
		<% if $ButtonContent %>$ButtonContent<% else %><span>$Title.XML</span><% end_if %> (<span class="count">0</span>)
	</button>
<% else %>
	<input $addExtraClass('idsk-button submit-table-filter').AttributesHTML />
<% end_if %>
