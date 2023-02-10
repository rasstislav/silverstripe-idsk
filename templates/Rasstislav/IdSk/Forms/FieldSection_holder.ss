<div <% if $Name %>id="$Name"<% end_if %> class="idsk-table-filter__category<% if $extraClass %> $extraClass<% end_if %>">
	<% if $Title %><div class="idsk-table-filter__title govuk-heading-s">$Title <span class="count"></span></div><% end_if %>
	<button class="govuk-body govuk-link idsk-filter-menu__toggle"
		tabindex="-1"
		data-open-text="Rozbaliť sekciu filtra"
		data-close-text="Zbaliť sekciu filtra"
		data-category-name="$Title"
		aria-label="Rozbaliť sekciu filtra $Title"
		type="button"
	>
		Rozbaliť sekciu filtra
	</button>

	<div class="idsk-table-filter__content">
		<% loop $FieldList %>
			$FieldHolder
		<% end_loop %>
	</div>
</div>
