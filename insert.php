<?php
    include_once('conn.php');
  
    
    if(isset($_POST["submit"])) 
    {
        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $folder = "images/".$filename;
        move_uploaded_file($tempname,$folder);
        
        $name        = $_POST["name"];
        // $file        = $_POST['file'];
        $email       = $_POST["email"];
        $address     = $_POST["address"];
        $password    = $_POST["password"];
        $confirmpass = $_POST["confirmPassword"];
        $gender      = $_POST["gender"];
        $caste       = $_POST["caste"];
        

        $query = "INSERT INTO `new_form` (`Name`, `Image`, `Email`, `Address`, `Password`, `Confirmpass`,`gender`,`caste`) 
            VALUES ('$name', '$folder', '$email', '$address', '$password', '$confirmpass','$gender','$caste')";
        $data = mysqli_query($conn,$query);
        
        if($data) {
            header("location:view.php?msg=1");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    }
?>


      
  