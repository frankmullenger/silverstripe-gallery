<% require css(gallery/css/flexslider.css) %>
<% require css(gallery/css/gallery.css) %>

<% require javascript(framework/thirdparty/jquery/jquery.js) %>
<% require javascript(gallery/javascript/jquery.flexslider.min.js) %>
<% require javascript(gallery/javascript/gallery.js) %>

<div class="content-container">
    <article>
        <h1>$Title</h1>

        $Gallery

        <div class="content">$Content</div>
    </article>

    $Form
    $PageComments
</div>

<% include SideBar %>
