<?php 
include_once('conn.php');

if (isset($_POST["submit"])) {
    $id           = $_POST['id'];
    $name         = $_POST['name'];

    if ($_FILES["file"]["name"] !== "") {
        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $folder = "images/" . $filename;
        move_uploaded_file($tempname, $folder);
    } else {
        $folder = $_POST['oldimage'];   
    }

    $email        = $_POST['email'];
    $address      = $_POST['address'];
    $password     = $_POST['password'];
    $confirmpass  = $_POST['confirmPassword'];
    $gender       = $_POST['gender'];
    $caste        = $_POST['caste'];

    $query = "UPDATE new_form SET 
        Name = '$name', 
        Image = '$folder',  
        Email = '$email', 
        Address = '$address', 
        Password = '$password', 
        Confirmpass = '$confirmpass', 
        gender = '$gender', 
        caste = '$caste'   
        WHERE id = '$id'";

    $data = mysqli_query($conn, $query);

    if ($data) {
        header("Location: view.php?msg=2");
    } else {
        echo "Please try again later. Error: " . mysqli_error($conn);
    }
}
?>
