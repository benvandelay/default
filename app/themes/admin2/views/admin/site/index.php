   <div class="content-wrap">
       
       <div class="content-header">
           
           <h1>Update Content: This is a Title</h1>
           
       </div>
       
       <div class="content-inner">
           <div class="sidebar-right">
               <div class="sidebar-item">
                   <h2>Categories</h2>
                   <ul>
                       <li>This is one</li>
                       <li>This is another</li>
                   </ul>
               </div>
           </div>
            
               <div class="sortable-item">
                   <div class="placeholder h1">
                       <div class="handle">
                           <span class="icon move"></span>
                       </div>
                       
                       <div class="controls">
                           <span class="icon delete"></span>
                       </div>
                       <textarea placeholder="Insert a Title" class="input expanding"></textarea>
                   </div>
                   
                   <div class="insert">
                       <div class="insert-inner">
                           <div class="line"></div>
                           <span class="icon"></span>
                       </div>
                       <div class="insert-items">
                           <span class="add-placeholder" data-type="h1">Header</span>
                           <span class="add-placeholder" data-type="text">Text</span>
                           <span class="add-placeholder" data-type="image">Image</span>
                       </div>
                   </div>
               </div>
               
               <div class="sortable-item">
                   <div class="placeholder text">
                       <div class="handle">
                           <span class="icon move"></span>
                       </div>
                       
                       <div class="controls">
                           <span class="icon delete"></span>
                       </div>
                       <textarea class="input nicedit" id="nicedit-1"><p>Insert some text..</p></textarea>     
                   </div>
                   
                   <div class="insert">
                       <div class="insert-inner">
                           <div class="line"></div>
                           <span class="icon"></span>
                       </div>
                       <div class="insert-items">
                           <span class="add-placeholder" data-type="h1">Header</span>
                           <span class="add-placeholder" data-type="text">Text</span>
                           <span class="add-placeholder" data-type="image">Image</span>
                       </div>
                   </div>
               </div>
               
               <div class="sortable-item">
                   <div class="placeholder image">
                       <div class="handle">
                           <span class="icon move"></span>
                       </div>
                       
                       <div class="controls">
                           <span class="icon delete"></span>
                       </div>
                       
                       <h2>Select an Image</h2>
                       <a href="#">Upload New Image</a>
                       
                       <img class="select-image" src="http://www.placekitten.com/80/80" />
                       <img class="select-image" src="http://www.placekitten.com/80/80" />
                       <img class="select-image" src="http://www.placekitten.com/80/80" />
                       <img class="select-image" src="http://www.placekitten.com/80/80" />
                          
                   </div>
                   
                   <div class="insert">
                       <div class="insert-inner">
                           <div class="line"></div>
                           <span class="icon"></span>
                       </div>
                       <div class="insert-items">
                           <span class="add-placeholder" data-type="h1">Header</span>
                           <span class="add-placeholder" data-type="text">Text</span>
                           <span class="add-placeholder" data-type="image">Image</span>
                       </div>
                   </div>
               </div>
                   
       </div> 
   </div>
  
<script type="text/html" id="text-template">
    <div class="sortable-item">
        <div class="placeholder">
           <div class="handle">
               <span class="icon move"></span>
           </div>
           
           <div class="controls">
               <span class="icon delete"></span>
           </div>
           <textarea class="input nicedit force-focus" id="<%= id %>">Insert some new text...</textarea>     
       </div>
       <div class="insert">
           <div class="insert-inner">
               <div class="line"></div>
               <span class="icon"></span>
           </div>
           <div class="insert-items">
               <span class="add-placeholder" data-type="h1">Header</span>
               <span class="add-placeholder" data-type="text">Text</span>
               <span class="add-placeholder" data-type="image">Image</span>
           </div>
       </div>
   </div>
</script>
   
<script type="text/html" id="h1-template">
    <div class="sortable-item">
        <div class="placeholder h1">
           <div class="handle">
               <span class="icon move"></span>
           </div>
           
           <div class="controls">
               <span class="icon delete"></span>
           </div>
           <textarea placeholder="Insert some text..." class="input expanding force-focus"></textarea>
       </div>
       <div class="insert">
           <div class="insert-inner">
               <div class="line"></div>
               <span class="icon"></span>
           </div>
           <div class="insert-items">
               <span class="add-placeholder" data-type="h1">Header</span>
               <span class="add-placeholder" data-type="text">Text</span>
               <span class="add-placeholder" data-type="image">Image</span>
           </div>
       </div>
   </div>
</script>

<script type="text/html" id="image-template">
    <div class="sortable-item">
       <div class="placeholder image">
           <div class="handle">
               <span class="icon move"></span>
           </div>
           
           <div class="controls">
               <span class="icon delete"></span>
           </div>
           
           <input class="input force-focus" /> 
              
       </div>
       
       <div class="insert">
           <div class="insert-inner">
               <div class="line"></div>
               <span class="icon"></span>
           </div>
           <div class="insert-items">
               <span class="add-placeholder" data-type="h1">Header</span>
               <span class="add-placeholder" data-type="text">Text</span>
               <span class="add-placeholder" data-type="image">Image</span>
           </div>
       </div>
   </div>
</script>  