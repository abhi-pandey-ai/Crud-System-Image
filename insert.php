<?php
    include_once('conn.php');
    
    if(isset($_POST["submit"])) 
    {
        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $folder = "images/".$filename;
        
        $img_type = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $allow_type = array('png','jpg','jpeg');
        if(in_array($img_type, $allow_type)){
            move_uploaded_file($tempname,$folder);
            
            $name        = $_POST["name"];
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

        } else{
            header("location:index.php?msg=3");
            
        }
    }
?>


      
  