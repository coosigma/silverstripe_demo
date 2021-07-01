<section class="hero" <% if $Image %> style="background-image: url('$Image.URL');"<% end_if %>>
	<div class="content">
		$Content
    	<% if $CTAButton && $CTAButton.ID %>
		<div class="cta">
        	<a
            	href="$CTAButton.URL"
            	class="cta-link"
					style="$CTAButton.Parameter"
            	target="<% if $CTABattuon.NewTab %>_blank<% else %>_self<% end_if %>">
            	$CTAButton.CTAText
        	</a>
		</div>
    	<% end_if %>
	</div>
</section>
