function addToCart(artworkID) {
	$.ajax({
		url: 'lib/addToCart.php',
		type: 'POST', 
		data: "artworkID=" + artworkID, 
		dataType: 'json', 
		success:
			function(artObjects) {
				var cart = ""; 
				//for(var i = 0; i < artObjects.length; i++) {
					var img = "images/art/works/square-medium/" + artObjects["image"] + ".jpg"; 
			    	var cost = parseInt(artObjects["cost"]).toFixed(2); 

			    	cart += "<div class='media'>"; 
			    	cart += "<a class='pull-left' href='#'>";
			    	cart += "<img class='media-object' src=" + img + " alt='...' width='32'></a>";
			    	cart += "<div class='media-body'>"; 
			    	cart += "<p class='cartText'><a href='display-art-work.php?id=" + artObjects["artistID"] + "'>";
			    	cart += artObjects["title"]; 
			    	cart += "</div>"; 
			    	cart += "</div>"; 
		     	//} 
		     	document.getElementById("demo").innerHTML = cart;
		     	//document.getElementById("subtotal").innerHTML = "Subtotal: <span class='text-warning'>$" + cost + "</span>"; 
		    }
	});

}  
