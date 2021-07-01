<section class="two-column">
    <div class="left <% if $ImagePosition == 'Left' %> image-wrapper<% else %> content-wrapper<% end_if %>">
		 <% if $ImagePosition == 'Right' %>
			<div class="content">
				$Content
			</div>
		<% else %>
        <% if $Image %>
        <img class="image" src="$Image.URL" />
        <% end_if %>
		<% end_if %> 
    </div>
    <div class="right <% if $ImagePosition == 'Right' %> image-wrapper<% else %> content-wrapper<% end_if %>">
		 <% if $ImagePosition == 'Left' %>
			<div class="content">
				$Content
			</div>
		<% else %>
        <% if Image %>
        <img class="image" src="$Image.URL" />
        <% end_if %>
		<% end_if %>
    </div>
</section>