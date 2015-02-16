<?php
ini_set('display_errors', 'On');
require '/nfs/stak/students/g/gullufse/public_html/phpassignment2/information.php';

if($_POST['callingfunction'] == 'fresh2'){
	
	$mi1 = new mysqli($lh, $username, $password, $db);
	if ($mi1->connect_error){
		echo "noconnect" . mysqli_connect_error() . $mi1->errno;
	}
	
	$th1 = $mi1->thread_id;
	
	$vname = $_POST['vname'];
	$category = $_POST['category'];
	$length = intval($_POST['length']);
	
	$stmt = $mi1->prepare("INSERT INTO videos (vname, category, length) VALUES (?,?,?)");
	$stmt->bind_param("ssi", $vname, $category, $length);
	
	$stmt->execute();
	$stmt->close();
}
elseif($_POST['callingfunction'] == 'delone'){
	$mi3 = new mysqli($lh, $username, $password, $db);
	if ($mi3->connect_error){
		echo "noconnect" . mysqli_connect_error() . $mi1->errno;
	}
	
	$th3 = $mi3->thread_id;
	
	$id = intval($_POST['delrowid']);
	
	if ($_POST['rented'] == 0){
		$stmt = $mi3->prepare("UPDATE videos SET rented=1 WHERE id=?");
		$stmt->bind_param("i",$id);
		
		$stmt->execute();
		$stmt->close();
	}
	else{
		$stmt = $mi3->prepare("UPDATE videos SET rented=0 WHERE id=?");
		$stmt->bind_param("i",$id);
		
		$stmt->execute();
		$stmt->close();
	}
	
	$mi3->kill($th3);
	$mi3->close();
}

buildtable($lh, $username, $password, $db);

function buildtable($lh, $un, $pass, $db) {
    $mi2 = new mysqli($lh, $un, $pass, $db);
    if ($mi2->connect_error){
        echo "noconnect" . mysqli_connect_error() . $mi2->errno;
        return;
    }
    
    $th2 = $mi2->thread_id;
    
    if (isset($_POST['filter'])) {
    	if ($_POST['filter'] == 'allmovies'){
    		$query = 'select * from videos';
    		$result = $mi2->query($query);
    	}
    	else{
    		$fil = $_POST['filter'];
    		$qu = "SELECT * FROM videos WHERE category='" . $fil . "'";
    		$result = $mi2->query($qu);
    	}
    }
    else
    {
    	$query = 'select * from videos';
    	$result = $mi2->query($query);
    }

    echo '<table>';
    while ($row = $result->fetch_assoc()){
    	echo '<tr id="' . $row['id'] . '"><td>' . $row['id'] . '</td><td>' . $row['vname'] . '</td><td>' . $row['category'] . '</td><td>' . $row['length']; 
    	if ($row['rented'] == 0){
    		echo '<td id="crit1">' . '<input type="button" value="Check Out" onclick="delone(' . $row['id'] . ',0)"/></tr>';
    	}
    	else {
    		echo '<td id="crit2">' . '<input type="button" value="Check In" onclick="delone(' . $row['id'] . ',1)"/></tr>';
    	}
    }
    
    $mi2->kill($th2);
    $mi2->close();
}

echo '<select id="selector" onchange="filter()"><option value="allmovies">All Movies</option>';
$mysqli = new mysqli($lh, $username, $password, $db);
if ($mysqli->connect_error){
	echo "noconnect" . mysqli_connect_error() . $mysqli->errno;
}
$q = "SELECT DISTINCT category FROM videos";
$res = $mysqli->query($q);

while ($ent = $res->fetch_assoc()){
	if (isset($_POST['filter'])){
		if ($_POST['filter'] == $ent['category']){
			echo '<option value="' . $ent['category'] . '" selected>' . $ent['category'] . '</option>';
		}
		else{
			echo '<option value="' . $ent['category'] . '">' . $ent['category'] . '</option>';
		}
	}
	else{
		echo '<option value="' . $ent['category'] . '">' . $ent['category'] . '</option>';
	}
}
	
echo '</select>';

$t = $mysqli->thread_id;
$mysqli->kill($t);
$mysqli->close();

?>
