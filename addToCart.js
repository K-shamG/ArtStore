function addToCart(artworkID) {
	if(artworkID == 0) {
		document.getElementById("demo").innerHTML = "";
		document.getElementById("demo2").innerHTML = "";
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
					var cost = 0; 
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
					}

			     	 cost += parseInt(artObjects["cost"]); 
			     	var old_val = document.getElementById("demo2").innerHTML; 
			     	document.getElementById("demo2").innerHTML = old_val + cart;
			     	var old_cost = document.getElementById("subtotal").innerHTML; 
			     	var new_cost = +old_cost.slice(1) + +cost; 
			     	document.getElementById("subtotal").innerHTML = "$" + new_cost; 
			    }
		});

	}

}

function getCart() {
	var returnVal = []; 
	$.ajax({
			url: 'lib/addToCart.php',
			type: 'GET', 
			data: "action=CART", 
			dataType: 'json',
			async: false, 
			success:
				function(response) {
					returnVal = response; 
			    }
		});
	return returnVal; 

}  

function clearCart() {
	$.ajax({
		url: 'lib/addToCart.php',
		type: 'GET', 
		data: "action=CLEAR", 
		dataType: 'json',
		async: false, 
		success:
			function(response) {
				
		    }
	});
}

function outputCartRow(file, product, quantity, price) {
	var filePath = 'images/art/works/medium/' + file + '.jpg'; 
	var amount = price * quantity; 
	var string = "<tr><td><img class='img-thumbnail' src=" + filePath + " alt='...'></td>" 
	+ "<td>" + product + "</td>"
	+ "<td>" + quantity + "</td>"
	+ "<td>$" + parseInt(price).toFixed(2) + "</td>"
	+ "<td>$" + parseInt(amount).toFixed(2) + "</td></tr>";
	return string; 
}
