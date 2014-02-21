<script type="text/template" id="article">
    <a href="<%= url %>" class="article new">
        <%= image %>
        <div class="title"><%= title %></div>
        <div class="byline"><%= date %> | <%= author %></div>
        <p><%= body %></p>
        
        <ul class="info">
            <li class="status<%= status %>"><span class="icon icon-checkmark"></span> Published</li>
        </ul> 
    </a>
</script>