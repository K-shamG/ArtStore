<?php 


?>

<h3>Art by <?php artists::getArtistName(); ?></h3>  

<div class="row">
<?php 
	$artWorks = artByArtist::getArtObjects();  
	$i = 0; 
	foreach($artWorks as $artWork) {
		echo "<div class='col-md-3'>"; 
		  echo  "<div class='thumbnail'>";
			 echo  "<img src='images/art/works/square-medium/" . $artWork->image . ".jpg' title='' alt='' class='img-thumbnail img-responsive'>"; 
			 echo  "<div class='caption'>";
				echo  "<a class='btn btn-primary btn-xs' href='display-art-work.php?id=" . $artWork->artistID . "&artworkID=" . $artWork->artworkID . "'><span class='glyphicon glyphicon-info-sign'></span> View</a>"; 
				echo  "<button type='button' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-gift'></span> Wish</button>";
				echo  "<button type='button' onclick='addToCart($artWork->artworkID);' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</button>";
			 echo  "</div>";
		  echo  "</div>  ";                 
	   echo  "</div>";
	   $i++; 
	}
	 ?>

</div>  <!-- end artist's works row -->