function addToCart(artObject) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("demo").innerHTML = "test";

    }
  };
  xhttp.open("GET", ""); 
  xhttp.send(); 
}  
