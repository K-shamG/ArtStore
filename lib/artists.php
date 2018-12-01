<?php

class artists {
	public $id; 
	public $name; 
	public $life; 
	public $nationality; 
	public $moreInfo; 
	public $details;
	public $image; 
	
	function __construct($id, $name, $life, $nationality, $moreInfo, $details ) {
		$this->id = $id; 
		$this->name = $name; 
		$this->life = $life; 
		$this->nationality = $nationality; 
		$this->moreInfo = $moreInfo; 
		$this->details = $details;
	}
	
	public static function getArtistObject() {
		$servername = "localhost";
		$username = "testuser2";
		$password = "mypassword";
		$dbname = "art";

		$id = 1; 
		if (isset($_GET["id"])) {
			$id = $_GET["id"]; 
		}
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		mysqli_set_charset($conn, "utf8");
		$sql = "SELECT * from artists WHERE (ArtistId = " . $id . ")";
		$result =  $conn->query($sql);
		
		if (!$result) {
			trigger_error('Invalid query: ' . $conn->error);
		}
		
		$artistObject; 
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$name = $row["FirstName"] . " " . $row["LastName"]; 
				$date = $row["YearOfBirth"] . " - " . $row["YearOfDeath"]; 
				$artistObject = new artists(
					$row["ArtistID"], 
					$name, 
					$date, 
					$row["Nationality"], 
					$row["ArtistLink"], 
					$row["Details"]
				); 
				return $artistObject; 
			}
		} else {
			echo "0 results";
		}
		$conn->close();	
	}
	
	public static function getID() {
		$artistObject = self::getArtistObject(); 
		$trimmed = trim(trim($artistObject->id));
		return $trimmed; 
	}

	public static function getArtistName() {
		$artistObject = self::getArtistObject(); 
		echo $artistObject->name; 
	}
	
	public static function getDate() {
		$artistObject = self::getArtistObject(); 
		echo $artistObject->life; 
	}
	
	public static function getNationality() {
		$artistObject = self::getArtistObject(); 
		echo $artistObject->nationality; 
	}
	
	public static function getMoreInfo() {
		$artistObject = self::getArtistObject(); 
		echo "<a href='" . $artistObject->moreInfo . "'>$artistObject->moreInfo</a>"; 
	}
	
	public static function getDetails() {
		$artistObject = self::getArtistObject(); 
		echo $artistObject->details; 
	}
	
	public static function getImage() {
		$artistObject = self::getArtistObject(); 
		echo $artistObject->id; 
	}
}


?>