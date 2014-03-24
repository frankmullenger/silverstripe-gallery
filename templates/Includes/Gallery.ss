<% if $Images %>
    <div class="gallery-holder">
        <div class="gallery flexslider">
            <div class="slides">
                <% loop $Images %>
                    <div class="slide pos-{$Pos} $FirstLast">
                        $GalleryImage
                    </div>
                <% end_loop %>
            </div>
        </div>

        <div class="control flexslider">
            <ul class="slides">
                <% loop $Images %>
                    <li class="slide pos-{$Pos} $FirstLast">
                        $GalleryThumbnail
                    </li>
                <% end_loop %>
            </ul>
        </div>
    </div>
<% end_if %>
