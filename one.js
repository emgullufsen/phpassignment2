// Eric Gullufsen

function fresh(num){
	// make AJAX call to one.php (post) passing params indicating we want the table.
	
	var xm = new XMLHttpRequest();
	xm.onreadystatechange = function() {
		if (xm.readyState == 4){
			document.getElementById("stuffs").innerHTML = xm.responseText;
		}
	};
	xm.open("POST", "one.php");
	xm.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	if (num == 1){
		$codicil = 'callingfunction=fresh1';
	}
	else if (num == 2){
		if (!((document.getElementById("name").value != "") && (document.getElementById("length").value != "") && (document.getElementById("category").value != ""))){
			var stringy = "The following fields were left blank:\n";
			var strarr = new Array("name", "length", "category");
			for (var i = 0; i < 3; i++){
				if(document.getElementById(strarr[i]).value == ""){
					stringy += strarr[i] + "\n";
				}
			}
			alert(stringy);
			return;
		}
		
		if (isNaN(document.getElementById("length").value) || (parseInt(document.getElementById("length").value) <= 0)){
			alert('length of movie must be positive integer (minutes)');
			return;
		}
		
		$codicil = 'callingfunction=fresh2&' + 'vname=' + document.getElementById("name").value + '&category=' + document.getElementById("category").value + '&length=' +document.getElementById("length").value; 
	}
	else if (num == 3){
		
		$codicil = 'callingfunction=fresh3';
	}
	
	xm.send($codicil);		
}

function filter() {
	var xm = new XMLHttpRequest();
	xm.onreadystatechange = function() {
		if (xm.readyState == 4){
			document.getElementById("stuffs").innerHTML = xm.responseText;
		}
	};
	xm.open("POST", "one.php");
	xm.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	
	var f = document.getElementById("selector");
	var g = f.options[f.selectedIndex].value; 
	
	$codicil = 'callingfunction=filteron&filter=' + g;
	
	xm.send($codicil);
}

function delone(rowid,rented) {
	rowid = rowid.toString();
	rented = rented.toString();
	var xm = new XMLHttpRequest();
	xm.onreadystatechange = function() {
		if (xm.readyState == 4){
			document.getElementById("stuffs").innerHTML = xm.responseText;
		}
	};
	
	xm.open("POST", "one.php");
	xm.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	
	var codicil = 'callingfunction=delone&delrowid=' + rowid + '&rented=' + rented;
	
	xm.send(codicil);
}
