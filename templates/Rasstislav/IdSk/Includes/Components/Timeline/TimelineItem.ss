<% if $Title %>
	<div class="idsk-timeline__content idsk-timeline__content__title-div">
		<div class="idsk-timeline__left-side"></div>
		<div class="idsk-timeline__middle">
			<span class="idsk-timeline__vertical-line"></span>
		</div>
		<div class="idsk-timeline__content__title">
			<h3 class="govuk-heading-m">$Title</h3>
		</div>
	</div>
<% end_if %>
<div class="idsk-timeline__content">
	<div class="idsk-timeline__left-side">
		<span class="govuk-body-m">$Date</span>
		<% if $Time %>
			<br>
			<span class="idsk-timeline__content__time">$Time</span>
		<% end_if %>
	</div>
	<div class="idsk-timeline__middle">
		<span class="idsk-timeline__vertical-line--circle"></span>
	</div>
	<div class="idsk-timeline__content__caption">
		$Content
	</div>
</div>
