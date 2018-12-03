<?php  
	session_start(); 
	echo count($_SESSION["cart"]); 
	foreach($_SESSION["cart"] as $artwork => $quantity) {
			echo $artwork; 
			echo $quantity; 
		
	}
	include 'includes/art-data.php'; 
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
			if(count($_SESSION["cart"]) > 0) {
				foreach($_SESSION["cart"] as $artwork => $quantity) {
					echo "<tr>";
					$art = artByArtist::getArtByWorkID($artwork); 
					outputCartRow($art->image, $art->title, $quantity, $art->cost);
					echo "</tr>";
				}
			}
		?>
         <tr class="success strong">
            <td colspan="4" class="moveRight">Subtotal</td>
            <td >
				<?php
					$subtotal = ($quantity1 * $price1) + ($quantity2 * $price2); 
					echo "$" . number_format($subtotal); 
				?>
			</td>
         </tr>
         <tr class="active strong">
            <td colspan="4" class="moveRight">Tax</td>
            <td >
				<?php
					$tax = $subtotal * 0.10;
					echo "$" . number_format($tax); 
				?>
			</td>
         </tr>  
         <tr class="strong">
            <td colspan="4" class="moveRight">Shipping</td>
            <td>
				<?php
					$shipping = 100; 
					if($subtotal > 2000) {
						$shipping = 0;
					}
					echo "$" . number_format($shipping); 
				?>
			</td>
         </tr> 
         <tr class="warning strong text-danger">
            <td colspan="4" class="moveRight">Grand Total</td>
            <td>
				<?php
					echo "$" . number_format($subtotal + $tax + $shipping);
				?>
			</td>
         </tr>    
         <tr >
            <td colspan="4" class="moveRight"><button type="button" class="btn btn-primary" >Continue Shopping</button></td>
            <td><button type="button" class="btn btn-success" >Checkout</button></td>
         </tr>
      </table>         

	</div>  <!-- end container -->
	<?php	include 'includes/art-footer.inc.php'; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
    <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script> 
 
  </body>
</html>

<?php
	function outputCartRow($file, $product, $quantity, $price) {
		$filePath = 'images/art/works/medium/' . $file . '.jpg'; 
		$amount = $price * $quantity; 
		echo "<tr><td><img class='img-thumbnail' src=" . $filePath . " alt='...'></td>" 
		. "<td>" . $product . "</td>"
		. "<td>" . $quantity . "</td>"
		. "<td>$" . number_format($price) . "</td>"
		. "<td>$" . number_format($amount) . "</td></tr>";
	}
?>