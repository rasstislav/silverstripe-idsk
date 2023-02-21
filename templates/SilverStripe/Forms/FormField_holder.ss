<div id="$HolderID" class="govuk-form-group<% if $DimensionClass %> $DimensionClass<% end_if %><% if $extraClass %> $extraClass<% end_if %>">
	<div class="govuk-label idsk-label-wrapper">
		<% if $Title %><label class="text-truncate" for="$ID">$Title</label><% end_if %>
		<% if $RightTitle %><% if $Title %>&nbsp;<% end_if %><i class="font-icon-help-circled" tabindex="0" title="$RightTitle"></i><% end_if %>
	</div>
	<% if $Description %>
		<span id="$ID-hint" class="govuk-hint">
			$Description
		</span>
	<% end_if %>
	<% if $Message %>
		<span id="$ID-message" class="$MessageType">
			<% if $MessageType == 'govuk-error-message' %><span class="govuk-visually-hidden">Error:</span> <% end_if %>$Message
		</span>
	<% end_if %>
	$Field
</div>
