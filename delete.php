<?php
include_once('conn.php');
$id = $_GET['id'];
$query = "DELETE FROM new_form  WHERE id = '$id'";
$data = mysqli_query($conn,$query);

if($data){
    echo "<script> alert('delete successfully.')</script>";
    header("location:view.php?msg=@");
}else{
    echo"failed to delete";
}
?>