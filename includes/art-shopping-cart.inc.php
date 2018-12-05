<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title">Cart </h3>
   </div>
   <div class="panel-body">
      <div id="demo"></div>
      <div id="demo2"></div>
      <strong class="cartText">Subtotal: <span id ="subtotal" class="text-warning"></span></strong>
      <?php
        $art_items = []; 
        $ids = artByArtist::getArtworkIDs(); 
        foreach($ids as $id) {
          array_push($art_items, artByArtist::getArtByWorkID($id)); 
        } 
       ?> 
      <script>
        var cart = getCart();
        var string = ""; 
        var subtotal = 0; 
        var string = ""; 
        var art = <?php echo json_encode($art_items)?>; 
        for(var i = 0; i < art.length; i++) {
          if(typeof cart[art[i]["artworkID"]] == 'number'){
              var img = "images/art/works/square-medium/" + art[i]["image"] + ".jpg"; 
              string += "<div class='media'>"; 
              string += "<a class='pull-left' href='#'>";
              string += "<img class='media-object' src=" + img + " alt='...' width='32'></a>";
              string += "<div class='media-body'>"; 
              string += "<p class='cartText'><a href='display-art-work.php?id=" + art[i]["artistID"] + "'>";
              string += art[i]["title"]; 
              string += "</div>"; 
              string += "</div>"; 
              subtotal += art[i]["cost"] * cart[art[i]["artworkID"]]; 
          } 
        }
        document.getElementById("demo").innerHTML = string;
         document.getElementById("subtotal").innerHTML = "$" + subtotal; 
      </script>         
      
      <div>
      <a href="display-cart.php"><button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span> Edit</button><a>
      <button onclick="clearCart(); addToCart(0);"type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-arrow-right"></span> Checkout</button>
      </div>
   </div>

</div>    