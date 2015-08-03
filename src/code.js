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
	//console.log(JSON.stringify(m));
	request.send(JSON.stringify(m));
	//console.log(m);
	request.onreadystatechange = function(){
		if (request.readyState === 4){
			if(request.status === 200){
				if(request.responseText != "success")
				{
					console.log("alert");
					alert(request.responseText);
				}
				else{
					display_movies("Fiction");
				}
			}
			else{
				console.log("alert3");
				alert("Error! " + request.status);
			}
		}
	}
}


function display_movies(searchCategory){
	var request = new XMLHttpRequest();
	request.open("POST", "getmovie.php", true);
	request.send(JSON.stringify({'category':searchCategory}));
	//console.log(JSON.stringify({'category':searchCategory}));
	request.onreadystatechange = function(){
		if (request.readyState === 4){
			if(request.status === 200){
				if(request.responseText != "success")
				{
					console.log("alert4");
					console.log(request);
				}
				else{
					console.log(request);
				}
			}
			else{
				console.log("alert2");
				alert("Error! " + request.status);
			}
		}
	}
}