var newButton = document.getElementById("movieButton");
var newName = document.getElementById("name");
var newCategory = document.getElementById("category");
var newRented = document.getElementById("rented");
var newLength = document.getElementById("length");
var videoTable = document.getElementById("videos");
var removeAll = document.getElementById("removeAll");
var searchMenu = document.getElementById("searchOption");

var currentSearch = '*';
display_movies(currentSearch);

function movie(){
	this.name = '';
	this.category = '';
	this.rented = '';
	this.movieLength = '';
	this.id = '';
	this.set_movie = function(idIn, nameIn, categoryIn, rentedIn, lengthIn){
		this.id = idIn;
		this.name = nameIn;
		this.category = categoryIn;
		this.rented = rentedIn;
		this.movieLength = lengthIn;
	}
	this.make_html = function(){
		var tr = document.createElement("tr");
		var removeBtn = document.createElement("button");
		var rentBtn = document.createElement("button");
		removeBtn.className = "btn btn-danger";
		var myID = this.id;
		removeBtn.onclick = function(){
			delete_Movie(myID);
			display_movies(currentSearch);
		}
		var myRented = this.rented;
		rentBtn.onclick = function(){
			toggle_rented(myID, myRented);
			display_movies(currentSearch);
		}
		removeBtn.innerHTML = "Remove Movie";
		rentBtn.innerHTML = "Rent Movie";
		var nameCell = document.createElement("td");
		var categoryCell = document.createElement("td");
		var lengthCell = document.createElement("td");
		nameCell.innerHTML = this.name;
		categoryCell.innerHTML = this.category;
		lengthCell.innerHTML = this.movieLength;
		if(this.rented == false){
			rentBtn.innerHTML = "Availble";
		}
		else{
			rentBtn.innerHTML = "Checked Out";
		}
		var removeCell = document.createElement("td");
		removeCell.appendChild(removeBtn);
		var rentBtnCell = document.createElement("td");
		rentBtnCell.appendChild(rentBtn);
		tr.appendChild(rentBtnCell);
		tr.appendChild(nameCell);
		tr.appendChild(categoryCell);
		tr.appendChild(lengthCell);
		tr.appendChild(removeCell);
		videoTable.appendChild(tr);
	}
}

searchMenu.onchange = function(){
	if(searchMenu.value == "All"){
		var toSearch = "*";
	}
	else{
		var toSearch = searchMenu.value;
	}
	display_movies(toSearch);
}

newButton.onclick = function(){
	var m = new movie;
	m.set_movie(0, newName.value, newCategory.value, newRented.checked, newLength.value);
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
					display_movies("*");
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
	while(videoTable.firstChild){
		videoTable.removeChild(videoTable.firstChild);
	}
	currentSearch = searchCategory;
	var request = new XMLHttpRequest();
	request.open("POST", "getmovie.php", true);
	request.send(JSON.stringify({'category':searchCategory}));
	//console.log(JSON.stringify({'category':searchCategory}));
	request.onreadystatechange = function(){
		if (request.readyState === 4){
			if(request.status != 200){
				alert("Error! " + request.status);
			}
			else{
				var toDisplay = JSON.parse(request.responseText);
				//console.log(toDisplay);
				tr = document.createElement("tr");
				var rentedCell = document.createElement("td");
				rentedCell.innerHTML = "Rental Status";
				var nameCell = document.createElement("td");
				nameCell.innerHTML = "Movie Name";
				var categoryCell = document.createElement("td");
				categoryCell.innerHTML = "Category";
				var lengthCell = document.createElement("td");
				lengthCell.innerHTML = "Length of Movie(in minutes)";
				var removeCell = document.createElement("td");
				removeCell.innerHTML = "Remove Movie";
				tr.appendChild(rentedCell);
				tr.appendChild(nameCell);
				tr.appendChild(categoryCell);
				tr.appendChild(lengthCell);
				tr.appendChild(removeCell);
				videoTable.appendChild(tr);
				for(var i=0; i<toDisplay.length; i++){
					var m = new movie();
					m.set_movie(toDisplay[i].id, toDisplay[i].name, toDisplay[i].category, toDisplay[i].rented, toDisplay[i].movieLength );
					m.make_html();
				}
			}
		}
	}
}

function delete_Movie(toDelete){
	var request = new XMLHttpRequest();
	request.open("POST", "removemovie.php", true);
	request.send(JSON.stringify({'toDelete' : toDelete}));
	//console.log(JSON.stringify({'category':searchCategory}));
	request.onreadystatechange = function(){
		if (request.readyState === 4){
			if(request.status === 200){
				if(request.responseText != "success")
				{
					//console.log("alert4");
					//console.log(request);
				}
				else{
					//console.log(request);
				}
			}
			else{
				alert("Error! " + request.status);
			}
		}
	}
}

function toggle_rented(movieID, isRented){
	var request = new XMLHttpRequest();
	request.open("POST", "setRented.php", true);
	console.log(isRented);
	if(isRented == 1){
		var rented = false;
	}
	else{
		var rented = true;
	}
	console.log(rented);
	request.send(JSON.stringify({'id' : movieID, 'rentStatus': rented}));
	//console.log(JSON.stringify({'category':searchCategory}));
	request.onreadystatechange = function(){
		if (request.readyState === 4){
			if(request.status === 200){
				if(request.responseText != "success")
				{
					//console.log("alert4");
					console.log(request);
				}
				else{
					setTimeout(function(){
						display_movies(currentSearch);
					},500)
					
					//console.log(request);
				}
			}
			else{
				alert("Error! " + request.status);
			}
		}
	}
}

removeAll.onclick = function(){
	var request = new XMLHttpRequest();
	request.open("POST", "deletemovies.php", true);
	//console.log(JSON.stringify(m));
	request.send(JSON.stringify({"verify":"yes, really delete everything"}));
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
					display_movies("*");
				}
			}
			else{
				console.log("alert3");
				alert("Error! " + request.status);
			}
		}
	}
}