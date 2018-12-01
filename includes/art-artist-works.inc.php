<?php 


?>

<h3>Art by <?php artists::getArtistName(); ?></h3>  

<div class="row">
<?php 
	$artWorks = artByArtist::getArtObjects();  
	$i = 0; 
	foreach($artWorks as $artWork) {
		$string = "<div class='col-md-3'>"; 
		  $string .= "<div class='thumbnail'>";
			 $string .= "<img src='images/art/works/square-medium/" . $artWork->image . ".jpg' title='' alt='' class='img-thumbnail img-responsive'>"; 
			 $string .= "<div class='caption'>";
				$string .= "<a class='btn btn-primary btn-xs' href='display-art-work.php?id=" . $artWork->artistID . "&artworkID=" . $artWork->artworkID . "'><span class='glyphicon glyphicon-info-sign'></span> View</a>"; 
				$string .= "<button type='button' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-gift'></span> Wish</button>";
				$string .= "<button type='button' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</button>";
			 $string .= "</div>";
		  $string .= "</div>  ";                 
	   $string .= "</div>";
	   echo $string; 
	   $i++; 
	}
	 ?>

</div>  <!-- end artist's works row -->