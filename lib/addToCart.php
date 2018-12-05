<?php
session_start(); 
	include('artByArtist.php'); 
  $exists = false; 
  	 
     if(isset($_POST["artworkID"])) {
        if(!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = []; 
         }
         if(!array_key_exists($_POST["artworkID"], $_SESSION["cart"])) {
            $_SESSION["cart"][$_POST["artworkID"]] = 1; 
         }
         else {
            $_SESSION["cart"][$_POST["artworkID"]] += 1; 
            $exists = true; 
         }
          echo json_encode(array(artByArtist::getArtByWorkID($_POST["artworkID"]), $exists)); 
     }

     if(isset($_GET["action"]) && $_GET["action"] == "CART") {
        if(!isset($_SESSION["cart"])) { 
          $_SESSION["cart"] = []; 
        }
        echo json_encode($_SESSION["cart"]); 
     }

      if(isset($_GET["action"]) && $_GET["action"] == "CLEAR") {
        session_destroy(); 
     }
	
?>