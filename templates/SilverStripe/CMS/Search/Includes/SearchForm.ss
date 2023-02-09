<form $FormAttributes>
	<% loop $Fields %>
		$Me.setInputType('search').addExtraClass('govuk-!-display-inline-block')
	<% end_loop %>
	<% loop $Actions %>
		$Me.setTemplate(Rasstislav/IdSk/Forms/SearchFormAction)
	<% end_loop %>
</form>
