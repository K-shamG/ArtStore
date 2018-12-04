function addToCart(artworkID) {
	if(artworkID == 0) {
		document.getElementById("demo").innerHTML = "";
		document.getElementById("subtotal").innerHTML = "$0"; 
	}
	else {
		$.ajax({
			url: 'lib/addToCart.php',
			type: 'POST', 
			data: "artworkID=" + artworkID, 
			dataType: 'json', 
			success:
				function(response) {
					var artObjects = response[0]; 
					var exists = response[1]; 
					var cart = ""; 
					if(!exists) {
						var img = "images/art/works/square-medium/" + artObjects["image"] + ".jpg"; 
				    	cart += "<div class='media'>"; 
				    	cart += "<a class='pull-left' href='#'>";
				    	cart += "<img class='media-object' src=" + img + " alt='...' width='32'></a>";
				    	cart += "<div class='media-body'>"; 
				    	cart += "<p class='cartText'><a href='display-art-work.php?id=" + artObjects["artistID"] + "'>";
				    	cart += artObjects["title"]; 
				    	cart += "</div>"; 
				    	cart += "</div>"; 
			     	 
			     		document.getElementById("demo").innerHTML = cart;
			     	}
			     	var new_cost = +artObjects["cost"] + +document.getElementById("subtotal").innerHTML.slice(1);
			     	document.getElementById("subtotal").innerHTML = "$" + new_cost; 
			    }
		});

	}

}  
