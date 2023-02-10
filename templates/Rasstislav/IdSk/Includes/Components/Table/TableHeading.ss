<% if $Title || $Body %>
	<div class="idsk-table__heading">
		<div>
			<% if $Title %>
				<h2 class="govuk-heading-l govuk-!-margin-bottom-4">$Title</h2>
			<% end_if %>
			<% if $Body %>
				<p class="govuk-body">$Body</p>
			<% end_if %>
		</div>
		<%-- TODO: <div class="idsk-table__heading-extended">
			<div class="govuk-form-group">
				<div class="govuk-radios govuk-radios--inline">
					<div class="govuk-radios__item">
						<input class="govuk-radios__input" type="radio" name="radio-priklad-3-1" id="radio-priklad-3-1" value="sk" checked="">
						<label class="govuk-label govuk-radios__label" for="radio-priklad-3-1">Slovensko</label>
					</div>
					<div class="govuk-radios__item">
						<input class="govuk-radios__input" type="radio" name="radio-priklad-3-2" id="radio-priklad-3-2" value="cz">
						<label class="govuk-label govuk-radios__label" for="radio-priklad-3-2">Česko</label>
					</div>
				</div>
			</div>
		</div> --%>
	</div>
<% end_if %>
