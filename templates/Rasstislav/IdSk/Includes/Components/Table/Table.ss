<div data-module="idsk-table">
	<% include Rasstislav/IdSk/Includes/Components/Table/TableHeading Title=$HeadingTitle, Body=$HeadingBody %>
	$TableFilterForm
	<% include Rasstislav/IdSk/Includes/Components/Table/TableBody Header=$TableHeader, Body=$TableBody %>
	$Pagination
	<% include Rasstislav/IdSk/Includes/Components/Table/TableFooter PrintButton=$FooterPrintButton, Buttons=$FooterButtons, Source=$FooterSource %>
</div>
