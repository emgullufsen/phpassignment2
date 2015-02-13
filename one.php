<?php
if ($_POST['fresh'] == "1"){
    buildtable();
}
elseif ($_POST['del'] == "1") {
}


function buildtable($cats=null, $add=null, $inout=null, $del=null) {
     $conn = new mysqli('localhost', 'emg', 'gullie06', 'uno_db');
    if($conn->connect_error){
        
    }
 
} 
 
 
 
 
 
 /*$name = $_POST['name'];
$category = $_POST['category'];
$length = $_POST['length'];

$conn = new mysqli('localhost','emg','gullie06','uno_db');

if ($conn->connect_error)
{
	die('error: ' . $conn->connect_error);
}

$th = $conn->thread_id;

$stmt = $conn->prepare("INSERT INTO videos (vname, category, length) VALUES (?, ?, ?)");
if (!$stmt->bind_param("ssi", $name, $category, $length))
{
    echo "bind failed : " . $mysqli->error;    
}
else 
{
	echo "Bind Succeeded" . "<br>";
}

if (!$stmt->execute())
{
    echo "error : " . $mysqli->error;
}
else 
{
	echo "insertion succeed with values: " . $name . " , " . $category . " , " . $length . "<br>";
}

$conn->kill($th);
$conn->close();

*/

 