
<% loop Images %>
  <a class="fancybox" data-fancybox-group="gallery" href="$Image.Filename">
    $Image.SetSize(250,250)
  </a>
<% end_loop %>
