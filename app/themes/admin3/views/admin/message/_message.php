<script type="text/template" id="message">
    <div data-status="<%= status %>" data-mid="<%= id %>" class="message <%= status %> new">
        <div class="header">
            <div class="arrow"></div>
            <div class="date"><%= date %></div>
            <div class="name"><%= name %></div>
            <p><%= excerpt %></p>
            <div class="status"><%= status %></div>
            
            <span class="icon icon-close"></span>
        </div>
        <div class="detail">
            <div class="head">At <%= time %>, <b><%= name %></b> said:</div>
            <p><%= body %></p>
            
            <ul class="info">
                <% if(email != ''){ %><li>Email: <a href="mailto:<%= email %>"><%= email %></a></li> <% } %>
                <% if(phone != null){ %><li>Phone: <%= phone %></li><% } %>
            </ul>
            
        </div>
        
    </div>
</script>