<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title">Cart </h3>
   </div>
   <div class="panel-body">
      <?php
        $cart = ""; 
        $cost = 0; 
        foreach(array_unique($_SESSION["cart"]) as $artworkID) {
            $artObject = artByArtist::getArtByWorkID($artworkID); 
            if($artObject != "0 results") {
                $img = "images/art/works/square-medium/" . $artObject->image . ".jpg"; 
                $cost = number_format($artObject->cost); 

                $cart .= "<div class='media'>"; 
                $cart .= "<a class='pull-left' href='#'>";
                $cart .= "<img class='media-object' src=" . $img . " alt='...' width='32'></a>";
                $cart .= "<div class='media-body'>"; 
                $cart .= "<p class='cartText'><a href='display-art-work.php?id=" . $artObject->artistID . "'>";
                $cart .= $artObject->title; 
                $cart .= "</div>"; 
                $cart .= "</div>"; 
            }

          }
        echo $cart;   
      ?>
      <div id="demo"></div>            
      <strong class="cartText">Subtotal: <span id ="subtotal" class="text-warning">$<?php echo $cost?></span></strong>
      <div>
      <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span> Edit</button>
      <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-arrow-right"></span> Checkout</button>
      </div>
   </div>

</div>    