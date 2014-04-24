<script type="text/template" id="article">
    <div class="article new" data-id="<%= id %>">
        <div class="head"><%= date %><%= categories %></div>
        <a class="main" href="<%= url %>">
            <div class="overlay"><span class="icon icon-eye"></span></div>
            <%= image %>
            <h1><%= title %></h1>
            <div class="small-date"><%= date %></div>
            <p><%= body %></p>
        </a>
    </div>
</script>