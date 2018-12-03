<?php
session_start(); 
	include('artByArtist.php');   
  	if(!isset($_SESSION["cart"])) {
  		$_SESSION ['cart'] = array ();
  	}
  	
  	if(!array_key_exists($_POST["artworkID"], $_SESSION["cart"])) {
  		$_SESSION["cart"][$_POST["artworkID"]] = 1; 
  	}
  	else {
  		$_SESSION["cart"][$_POST["artworkID"]] += 1; 
  	}
  	 
  	
	echo json_encode(artByArtist::getArtByWorkID($_REQUEST["artworkID"])); 
  	
?>