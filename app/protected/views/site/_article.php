<script type="text/template" id="article">
    <div class="article new <%= img_class %>" data-id="<%= id %>">
        <a class="main" href="<%= url %>">
            <div class="overlay"><span class="icon icon-eye"></span></div>
            <%= image %>
            <h1><%= title %></h1>
            <div class="date"><%= date %></div>
            <p><%= body %></p>
        </a>
    </div>
</script>