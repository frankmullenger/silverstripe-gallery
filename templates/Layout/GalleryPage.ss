
<% loop Images %>
	<a class="fancybox" data-fancybox-group="gallery" href="$Filename" title="$Caption">
		$SetSize(250,250)
	</a>
<% end_loop %>
