<% if $PrintButton || $Buttons || $Source %>
	<div class="idsk-table__meta">
		<div class="idsk-button-group idsk-table__meta-buttons">
			<% if $PrintButton %>
				<button type="button" class="idsk-button idsk-table__meta-print-button" data-module="idsk-button">
					Vytlačiť
				</button>
			<% end_if %>
			$Buttons
		</div>
		<% if $Source %>
			<div class="govuk-body idsk-table__meta-source">
				$Source
			</div>
		<% end_if %>
	</div>
<% end_if %>
