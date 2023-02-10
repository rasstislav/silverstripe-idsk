<% if $MoreThanOnePage %>
	<div class="idsk-pagination">
		<% if $NotFirstPage %>
			<a href="$PrevLink" class="idsk-button idsk-button--secondary"><% if $PrevTitle %>$PrevTitle<% else %>&lt;<% end_if %></a>
		<% end_if %>
		<% loop $PaginationSummary(2) %>
			<% if $CurrentBool %>
				<span aria-current="true" class="idsk-button idsk-button--events-none">$PageNum</span>
			<% else %>
				<% if $Link %>
					<a href="$Link" class="idsk-button idsk-button--secondary">$PageNum</a>
				<% else %>
					<span class="idsk-button idsk-button--transparent idsk-button--events-none">...</span>
				<% end_if %>
			<% end_if %>
		<% end_loop %>
		<% if $NotLastPage %>
			<a href="$NextLink" class="idsk-button idsk-button--secondary"><% if $NextTitle %>$NextTitle<% else %>&gt;<% end_if %></a>
		<% end_if %>
	</div>
<% end_if %>
