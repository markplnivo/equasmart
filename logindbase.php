<?php
$servername="localhost";
$username="root";
$password="";
$dbase="db_equasmart";

$conn = new mysqli($servername,$username,$password,$dbase);

if($conn->connect_error){
	echo "Error Connecting!";
}

?>