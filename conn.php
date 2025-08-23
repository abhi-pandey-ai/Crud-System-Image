<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "all-india";

$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    echo "connection failed".mysqli_error();
}
// else{
//     echo "databse connection successfully";
// }
?>