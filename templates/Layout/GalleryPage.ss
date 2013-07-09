<% require css(gallery/css/jquery.ad-gallery.css) %>

<% require javascript(framework/thirdparty/jquery/jquery.js) %>
<% require javascript(gallery/javascript/jquery.ad-gallery.min.js) %>

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
