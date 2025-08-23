<?php
	include_once('conn.php');
    
	$actionUrl = "insert.php";
	$btnName = "Insert";
    $image = "";
	$name = "";
	$email = "";
	$address = "";
	$password = "";
	$confirmpass = "";
	$gender = "";
	$caste = "";
	

	if (isset($_GET['id'])) {

		$id = $_GET['id'];
		$actionUrl = "update.php";
		$btnName = "Update";

		$query = "SELECT * FROM new_form WHERE id=$id";
		$data = mysqli_query($conn,$query);
		$result = mysqli_fetch_assoc($data);

		// echo "<pre>";
		// print_r($result);die();
		
		$image =  $result['Image'];
		$name =  $result['Name'];
		$email = $result['Email'];
		$address = $result['Address'];
		$password = $result['Password'];
		$confirmpass = $result['Confirmpass'];
		$gender = $result['gender'];
		$caste = $result['caste'];
	} 
?>    
<!doctype html>
<html lang="en">
  <head>
	  
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  
	 
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	  
	  <link rel= "stylesheet" href="style.css">
    <title>Index Page</title>
    
  </head>
  <body>
    <div class="container-fluid bg-dark text-light py-5">
		<section class="container my-2 bg-dark w-50 text-light p-2">
			<form class="row g-3 p-3" name="id" method="POST" action="<?php echo $actionUrl ?>" onsubmit="return checkfunction()" enctype="multipart/form-data">

				<div class="mb-3">
					<?php
					    
						if (isset($_GET['id'])) {
							echo'<img src="'.$image.'" height="100" width="100">';
						}
					?>
					
					<br><label for="file" class="form-label">Upload-image</label>
					<input type="file" class="form-control" id="file" name="file"  value="<?php echo $file; ?>" >
					<span id="fileErr"></span>
				</div>

				<div class="mb-3">
					<label for="name" class="form-label">Name</label>
					<input type="text" class="form-control" id="name" name="name" maxlength="40" value="<?php echo $name; ?>" placeholder="Enter Your Name" >
					<span id="nameErr"></span>
				</div>

				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Your Email">
					<span id="emailErr"></span>
				</div>

				<div class="mb-3">
					<label for="address" class="form-label">Address</label>
					<input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" placeholder="Enter Your Address">
					<span id="addressErr"></span>
				</div>

				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>" placeholder="*******">
					<span id="passwordErr"></span>
				</div>
				
				<div class="mb-3">
					<label for="confirmPassword" class="form-label">ComfirmPassword</label>
					<input type="text" class="form-control" id="confirmPassword" name="confirmPassword"value="<?php echo $confirmpass; ?>"  placeholder="*******">
					<span id="confirmPasswordErr"></span>
				</div>

				<div class="mb-3">
				<label for="gender" class="form-label">Gender</label>
				<select class="form-select" id="gender" name="gender">
					<option value="" disabled selected>Select Gender</option>
					<option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
					<option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?> >Female</option>
					<option value="Other" <?php if ($gender == 'Other') echo 'selected'; ?> >Other</option>
				</select>
				<span id="genderErr"></span>
				</div>


				<div class="mb-3">
					<label class="form-label">Caste</label>

					<input type="radio" id="general" name="caste" value="General" <?php if ($caste == 'General') echo 'checked'; ?> >
					<label for="general" class="ms-2"  >General</label>

					<input type="radio" id="obc" name="caste" value="Obc" class="ms-3" <?php if ($caste == 'Obc') echo 'checked'; ?>  >
					<label for="obc" class="ms-2" >Obc</label>

					<input type="radio" id="sc" name="caste" value="Sc" class="ms-3" <?php if ($caste == 'Sc') echo 'checked'; ?>  >
					<label for="sc" class="ms-2" >Sc</label>

					<input type="radio" id="st" name="caste" value="St" class="ms-3" <?php if ($caste == 'St') echo 'checked'; ?> >
					<label for="st" class="ms-2">St</label><br>

					<span id="casteErr"></span>
				</div>
					<?php
						if (isset($_GET['id'])) {
							echo'<input type="hidden"  id="id" name="id" value="'. $id.'">';
						}
					?>
					
				<div class="d-flex justify-content-between">
					<a href="view.php" class="btn btn-danger" style="width: 100px;">View</a>
					<button type="submit" name="submit"  class="btn btn-primary" style="width: 100px;"><?php echo $btnName; ?></button>
				</div>
          </form>
      </section>
        
        
    </div>
    <script>
			function checkfunction() {
				var file             = document.getElementById('file').value
				var name             = document.getElementById('name').value;
				var email            = document.getElementById('email').value;
				var address          = document.getElementById('address').value;
				var password         = document.getElementById('password').value;
				var confirmPassword  = document.getElementById('confirmPassword').value;
				var gender           = document.getElementById('gender').value;
				var caste            = document.querySelector('input[name="caste"]:checked');
				if(file == "") {
					document.getElementById('fileErr').innerHTML="upload Your iamege";
					return false ; 
				} else {
					document.getElementById('fileErr').innerHTML="";
				} 

				if(name == "") {
					document.getElementById('nameErr').innerHTML="Enter Your Name";
					return false ; 
				} else {
					document.getElementById('nameErr').innerHTML="";
				} 

				if(email == "") {
					document.getElementById('emailErr').innerHTML="Enter your email";
					return false ; 
				} else if(!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
					document.getElementById('emailErr').innerHTML="invalid crediential";
					return false ; 
				} else {
					document.getElementById('emailErr').innerHTML="";
				}
				
				if(address == "") {
					document.getElementById('addressErr').innerHTML  ="Enter your Address";
					return false ;
				} else {
					document.getElementById('addressErr').innerHTML  ="";
				}

				if(password == "") {
					document.getElementById('passwordErr').innerHTML = "Enter your password";
					return false ; 
				}  else {
					document.getElementById('passwordErr').innerHTML = "";
				}

				if(confirmPassword == ""){
					document.getElementById('confirmPasswordErr').innerHTML = "Enter Your Confirm password";
					return false ; 
				} else if(confirmPassword != password){
					document.getElementById('confirmPasswordErr').innerHTML = "Password Does Not Match";
					return false ; 
				} else{
					document.getElementById('confirmPasswordErr').innerHTML = "";
				}

				if(gender == ""){
					document.getElementById('genderErr').innerHTML="Select your Gender";
					return false ; 
				}else{
					document.getElementById('genderErr').innerHTML = "";
				}

				if(caste == null){
					document.getElementById('casteErr').innerHTML="Select your Caste";
					return false ; 
				}else{
					document.getElementById('casteErr').innerHTML = "";
				}
				return true; 
			}
			
	</script>
	
  </body>
</html>