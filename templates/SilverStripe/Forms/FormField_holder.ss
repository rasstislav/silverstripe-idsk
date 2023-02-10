<div id="$HolderID" class="govuk-form-group<% if $DimensionClass %> $DimensionClass<% end_if %><% if $extraClass %> $extraClass<% end_if %>">
	<% if $Title %><label class="govuk-label text-truncate" for="$ID">$Title</label><% end_if %>
	$Field
	<%-- TODO:
	<% if $RightTitle %><label class="right" for="$ID">$RightTitle</label><% end_if %>
	<% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
	<% if $Description %><span class="description">$Description</span><% end_if %> --%>
</div>
