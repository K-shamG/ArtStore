<?php
session_start(); 
	include('artByArtist.php'); 
	$exists = false; 

  	if(!isset($_SESSION["cart"])) {
  		$_SESSION ['cart'] = array ();
  	}
  	
  	if(!isset($_SESSION["cart"][$_POST["artworkID"]])) {
  		$_SESSION["cart"][$_POST["artworkID"]] = 1; 
  	}
  	else {
  		$_SESSION["cart"][$_POST["artworkID"]] += 1; 
  		$exists = true; 
  	}
  	 
  	
	echo json_encode(array(artByArtist::getArtByWorkID($_REQUEST["artworkID"]), $exists)); 
  	
?>