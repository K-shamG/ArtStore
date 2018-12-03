<?php

class artByArtist {
	const servername = "localhost";
	const username = "testuser2";
	const password = "mypassword";
	const dbname = "art";	
	
	public $artworkID; 
	public $artistID; 
	public $image; 
	public $title; 
	public $description; 
	public $cost; 
	public $excerpt; 
	public $year; 
	public $medium; 
	public $width;
	public $height;
	public $home; 
	
	function __construct($artworkID, $artistID, $image, $title, $cost, $description, $year, $medium, $width, $height, $home) {
		$this->artworkID = $artworkID; 
		$this->artistID = $artistID; 
		$this->image = $image;
		$this->title = $title; 
		$this->cost = $cost; 
		$this->description = $description; 
		$this->year = $year; 
		$this->medium = $medium; 
		$this->width = $width; 
		$this->height = $height; 
		$this->home = $home; 	
	}
	
	public static function getArtObjects() {
		$id = 1; 
		if (isset($_GET["id"])) {
			$id = $_GET["id"]; 
		}
		
		// Create connection
		$conn = new mysqli(self::servername, self::username, self::password, self::dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		mysqli_set_charset($conn, "utf8");
		$sql = "SELECT * from artworks WHERE (ArtistID = " . $id . ")";
		$result =  $conn->query($sql);
		
		if (!$result) {
			trigger_error('Invalid query: ' . $conn->error);
		}
		
		$artObjects = []; 
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$artObject = new artByArtist(
					$row["ArtWorkID"], 
					$row["ArtistID"],
					$row["ImageFileName"],
					$row["Title"], 
					$row["Cost"], 
					$row["Description"], 
					$row["YearOfWork"], 
					$row["Medium"], 
					$row["Width"], 
					$row["Height"], 
					$row["OriginalHome"]
				); 
				array_push($artObjects, $artObject); 
			}
			return $artObjects; 
		} else {
			echo "0 results";
		}
		$conn->close();	
	}

	public static function getArtId() {
		$artObjects = self::getArtObjects(); 
		$ids = []; 
		foreach($artObjects as $art) {
			array_push($ids, $art->artworkID); 
		}
		return $ids;
	}
	
	public static function getImages() {
		$artObjects = self::getArtObjects(); 
		$images = []; 
		foreach($artObjects as $art) {
			array_push($images, $art->image); 
		}
		return $images;
	}
	
	public static function getArtByID() {
		$artworkID = 0; 	
		if (isset($_GET["artworkID"])) {
			$artworkID = $_GET["artworkID"]; 
		}
		else {
			$artworkID = self::getArtId()[0]; 
		}
		$artObjects = self::getArtObjects(); 
		foreach($artObjects as $art) {
			if($art->artworkID == $artworkID) return $art; 
		}
	}
	
	public static function getArtByWorkID($artworkID) {
		$artObject = ""; 
		
		// Create connection
		$conn = new mysqli(self::servername, self::username, self::password, self::dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		mysqli_set_charset($conn, "utf8");
		$sql = "SELECT * from artworks WHERE ArtWorkID = '" . $artworkID . "'";
		$result =  $conn->query($sql);
		
		if (!$result) {
			trigger_error('Invalid query: ' . $conn->error);
		}
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$artObject = new artByArtist(
					$row["ArtWorkID"], 
					$row["ArtistID"],
					$row["ImageFileName"],
					$row["Title"], 
					$row["Cost"], 
					$row["Description"], 
					$row["YearOfWork"], 
					$row["Medium"], 
					$row["Width"], 
					$row["Height"], 
					$row["OriginalHome"]
				); 
			}
		} else {
			return "0 results";
		}
		$conn->close();	
		return $artObject; 
	}

	public static function getArtList($table1, $table2, $listID, $name) {
		$id = 1; 
		if (isset($_GET["id"])) {
			$id = $_GET["id"]; 
		}
		
		$artworkID = 1; 
		if (isset($_GET["artworkID"])) {
			$artworkID = $_GET["artworkID"]; 
		}
		
		// Create connection
		$conn = new mysqli(self::servername, self::username, self::password, self::dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		mysqli_set_charset($conn, "utf8");
		$sql = "SELECT * from " . $table1 . " WHERE (ArtWorkID = " . $id . ")";
		$result =  $conn->query($sql);
		
		if (!$result) {
			trigger_error('Invalid query: ' . $conn->error);
		}
		
		$list = [];  
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				array_push($list, $row[$listID]);
			}			
		} else {
			echo "0 results";
		}		
		
		$names = []; 
		foreach($list as $id) {
			$sql = "SELECT * from " . $table2 . " WHERE (" . $listID . " = " . $id . ")"; 
			$result =  $conn->query($sql);
			if (!$result) {
				trigger_error('Invalid query: ' . $conn->error);
			}
			
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					array_push($names, $row[$name]);
				}
			} else {
				echo "0 results";
			}
		}
		echo implode(", ", $names);	
		
		$conn->close();	
	}

	public static function getArtJSObject($artistID, $artworkID) {
		$art = self::getArtByWorkID($artistID, $artworkID); 
        return (array) $art; 

	}	
	
}


?>