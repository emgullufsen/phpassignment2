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
		$codicil = 'callingfunction=fresh2&' + 'vname=' + document.getElementById("name").value + '&category=' + document.getElementById("category").value + '&length=' +document.getElementById("length").value; 
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
