var newButton = document.getElementById("movieButton");
var newName = document.getElementById("name");
var newCategory = document.getElementById("category");
var newRented = document.getElementById("rented");
var newLength = document.getElementById("length");

function movie(){
	this.name = '';
	this.category = '';
	this.rented = '';
	this.movieLength = '';
	this.id = '';
	this.set_movie = function(nameIn, categoryIn, rentedIn, lengthIn){
		this.name = nameIn;
		this.category = categoryIn;
		this.rented = rentedIn;
		this.movieLength = lengthIn;
	}
}

newButton.onclick = function(){
	var m = new movie;
	m.set_movie(newName.value, newCategory.value, newRented.checked, newLength.value);
	var request = new XMLHttpRequest();
	request.open("POST", "addmovie.php", true);
	console.log(JSON.stringify(m));
	request.send(JSON.stringify(m));
	request.onreadystatechange = function(){
		if (request.readyState === 4){
			if(request.status === 200){
				if(request.responseText != "success")
				{
					alert(request.responseText);
				}
			}
			else{
				alert("Error! " + request.status);
			}
		}
	}
}