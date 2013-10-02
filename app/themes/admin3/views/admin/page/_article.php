<script type="text/template" id="article">
    <a href="<%= url %>" class="article new">
        <img src="http://www.placekitten.com/40/40" />
        <div class="title"><%= title %></div>
        <div class="byline"><%= date %> | <%= author %></div>
        <p><%= body %></p>
        
        <ul class="info">
            <li class="status<%= status %>"><span class="icon icon-checkmark"></span> Published</li>
            <li class="nav-item"><span class="icon icon-menu"></span> Nav</li>
        </ul> 
    </a>
</script>