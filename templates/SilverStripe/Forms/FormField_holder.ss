<div id="$HolderID" class="govuk-form-group<% if $DimensionClass %> $DimensionClass<% end_if %><% if $extraClass %> $extraClass<% end_if %>">
	<div class="govuk-label idsk-label-wrapper">
		<% if $Title %><label class="text-truncate" for="$ID">$Title</label><% end_if %>
		<% if $RightTitle %><% if $Title %>&nbsp;<% end_if %><i class="font-icon-help-circled" tabindex="0" title="$RightTitle"></i><% end_if %>
	</div>
	$Field
	<%-- TODO:
	<% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
	<% if $Description %><span class="description">$Description</span><% end_if %> --%>
</div>
