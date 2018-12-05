<?php  
	include 'lib/artByArtist.php'; 	
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 3</title>

    <!-- Bootstrap core CSS  -->    
    <link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet"> 
    <!-- Custom styles for this template -->
    <link href="bootstrap3_defaultTheme/theme.css" rel="stylesheet">
    	<script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
    <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script> 
    <script src="addToCart.js"></script> 
  </head>

<?php include 'includes/art-header.inc.php'; ?>
 <body>
 <div class="container">

      <div class="page-header">
         <h2>View Cart</h2>
      </div>
         
      <table class="table table-condensed">
         <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Amount</th>
         </tr>

         <?php
         	$art_items = []; 
         	$ids = artByArtist::getArtworkIDs(); 
         	foreach($ids as $id) {
         		array_push($art_items, artByArtist::getArtByWorkID($id)); 
         	} 
         ?>
		 <script>
		 	var cart = getCart();
		 	var subtotal = 0; 
		 	var string = ""; 
		 	var art = <?php echo json_encode($art_items)?>; 
		 	for(var i = 0; i < art.length; i++) {
		 		if(cart[art[i]["artworkID"]] != undefined){
		 			string += outputCartRow(art[i]["image"], art[i]["title"], cart[art[i]["artworkID"]], art[i]["cost"]); 
		 			subtotal += art[i]["cost"] * cart[art[i]["artworkID"]]; 
		 		}	
		 	}
		 	document.write(string); 
		 </script>

         <tr class="success strong">
            <td colspan="4" class="moveRight">Subtotal</td>
            <td >
				<script>document.write("$" + subtotal.toFixed(2));</script>
			</td>
         </tr>
         <tr class="active strong">
            <td colspan="4" class="moveRight">Tax</td>
            <td >
				<script>
					var tax = subtotal * 0.10; 
					document.write("$" + tax.toFixed(2));
				</script>
			</td>
         </tr>  
         <tr class="strong">
            <td colspan="4" class="moveRight">Shipping</td>
            <td>
				<script>
					var shipping = 100; 
					if(subtotal > 2000 || subtotal == 0) {
						shipping = 0; 
					}
					document.write("$" + shipping.toFixed(2));
				</script>
			</td>
         </tr> 
         <tr class="warning strong text-danger">
            <td colspan="4" class="moveRight">Grand Total</td>
            <td>
				<script>
					var total = subtotal + tax + shipping; 
					document.write("$" + total.toFixed(2));
				</script>
			</td>
         </tr>    
         <tr >
            <td colspan="4" class="moveRight"><button type="button" class="btn btn-primary" >Continue Shopping</button></td>
            <td><button onclick="clearCart(); location.reload(); " type="button" class="btn btn-success" >Checkout</button></td>
         </tr>
      </table>         

	</div>  <!-- end container -->
	<?php	include 'includes/art-footer.inc.php'; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

 	
  </body>
</html>

<script>

</script>