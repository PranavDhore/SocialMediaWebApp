<?php
	include "includes/db.php";
	include "includes/function.php";
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400;500;600;700;800&family=Josefin+Slab:ital,wght@0,400;0,600;1,300;1,400;1,600&family=Muli:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap"
    />

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />

    <link 
    href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <link rel="stylesheet" href="./CSS/signUp.css" />
    <title>Sign Up Page</title>

<!-- <script type="text/javascript" src="SignUp.js"></script> -->

  </head>
  <body>

    <!-- ================================================================================== -->
    
    <div class="nav">
      <div class="nav_brand">
        <a href="./landingPage.html" class="btn btn-success">  BACK</a>
      </div>
    </div>

    <!-- ================================================================================== -->
    <header style="color:aliceblue">Sign Up</header>
    <div class="container">
		
	<?php
		
		$firstname = $lastname = $username = $email = $password = $confirm_password = $college_name = $college_year = "";
		
		if(isset($_POST['signup'])){
			
			 $firstname = test_input($_POST['firstname']);
			 $lastname = test_input($_POST['lastname']);
			 $username = test_input($_POST['username']);
			 $email = test_input($_POST['email']);
			 $password = test_input($_POST['password']);
			 $confirm_password = test_input($_POST['confirm_password']);
			 $college_name = test_input($_POST['college_name']);
			 $college_year = test_input($_POST['college_year']);
			 $user_profile_image = "pictures/profile.png";
			
			if($password == $confirm_password){
				
				
				$dup = mysqli_query($connection,"SELECT * FROM users WHERE user_username = '{$username}' ");
				if(mysqli_num_rows($dup)>0){
					
					echo "<p style='background-color:red; padding:5px; color:#fff;'>Username is Already Taken. Please try to enter diffrent username</p>";
				}else{
			
				$query = "INSERT INTO users(user_firstname,user_lastname,user_username,user_email,user_college,user_year,user_password,user_image) VALUES('{$firstname}','{$lastname}','{$username}','{$email}','{$college_name}','{$college_year}','{$password}','{$user_profile_image}' )";
				
				
				
				$result = mysqli_query($connection,$query);
				
				if(!$result){

					die("Error".mysqli_error($connection));

				}else{

					
					header("Location: signIn.php?suc=1");
				}
				}
			}
			
		}
		
		
	?>	
		
      <form id="form" class="form" method="POST" onsubmit="return validate()" action="">
        <div class="form-row ">
          <div class="form-group col-md-12" >
            <label for="inputFirstname" >First Name</label>
            <input
              type="text"
              class="form-control"
              id="inputFirstname"
              placeholder="Enter Your First Name"
			  name="firstname"	   
            />
            <i class="fas fa-check-circle"></i>
			      <i class="fas fa-exclamation-circle"></i>
			      <small>Error message</small>
          </div>

          <div class="form-group col-md-12" >
            <label for="inputLastname" >Last Name</label>
            <input
              type="text"
              class="form-control"
              id="inputLastname"
              placeholder="Enter Your Last Name"
			  name="lastname" 	   
             
            />
            <i class="fas fa-check-circle"></i>
			      <i class="fas fa-exclamation-circle"></i>
			      <small>Error message</small>
          </div>
        </div>


      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="inputUsername" >Username</label>
          <span class="input-group-addon">@</span>
          <input
            type="text"
            class="form-control"
            id="inputUsername"
            placeholder="Enter Your Username"
			name="username"	 
          />
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>
        </div>

        <div class="form-group col-md-12">
          <label for="inputEmail" >Email Address</label>
          <input
            type="email"
            class="form-control"
            id="inputEmail"
            placeholder="Enter Your Email Address"
			name="email"	 
          />
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>
        </div>
      </div>

        <div class="form-row">
          <div class="form-group col-md-12 col-sm-12">
            <label for="inputCollegeName" >College Name</label>
            <select class="custom-select mr-sm-2" name="college_name" id="inputCollegeName" >
              <option selected>Choose...</option>
              <option value="D. Y. Patil Dnyanshanti School">D. Y. Patil Dnyanshanti School</option>
              <option value="Y.B Patil Polytechnic,Akurdi, Pune">Y.B Patil Polytechnic,Akurdi, Pune</option>
              <option value="Dr. D. Y. Patil Arts, Commerce and Science Junior College">Dr. D. Y. Patil Arts, Commerce and Science Junior College</option>
              <option value="Dr. D. Y. Patil Institute of Pharmacy, Akurdi, Pune">Dr. D. Y. Patil Institute of Pharmacy, Akurdi, Pune.</option>
              <option value="Dr. D. Y. Patil College of Pharmacy, Akurdi, Pune">Dr. D. Y. Patil College of Pharmacy, Akurdi, Pune</option>
              <option value="D. Y. Patil College of Engineering, Pune">D. Y. Patil College of Engineering, Pune</option>
              <option value="Dr. D. Y. Patil Institute of Engineering, Management and Research, Pune">Dr. D. Y. Patil Institute of Engineering, Management and Research, Pune</option>
              <option value="Dr. D.Y. Patil College of Architecture, Akurdi, Pune">Dr. D.Y. Patil College of Architecture, Akurdi, Pune</option>
              <option value="Dr. D. Y. Patil College of Applied Arts  Crafts, Akurdi, Pune">Dr. D. Y. Patil College of Applied Arts  Crafts, Akurdi, Pune</option>
              <option value="Dr. D. Y. Patil College of Agriculture Business Management , Akurdi, Pune">Dr. D. Y. Patil College of Agriculture Business Management , Akurdi, Pune</option>
              <option value="D .Y. Patil Institute of Master Computer Applications and Management, Akurdi, Punr">D .Y. Patil Institute of Master Computer Applications and Management, Akurdi, Punr</option>
            </select>
            <i class="fas fa-check-circle"></i>
			      <i class="fas fa-exclamation-circle"></i>
			      <small>Error message</small>
          </div>

          <div class="form-group col-md-12 col-sm-12" >
            <label for="inputCollegeYear" >College Year</label>
            <!--    <input type="number" class="form-control" id="inputCollegeYear" placeholder="Enter Your Year"> -->
            <select class="custom-select mr-sm-2" name="college_year" id="inputCollegeYear" >
              <option selected>Choose...</option>
              <option value="1st Year">1st Year</option>
              <option value="2nd Year">2nd Year</option>
              <option value="3rd Year">3rd Year</option>
              <option value="4th Year">4th Year</option>
            </select>
            <i class="fas fa-check-circle"></i>
			      <i class="fas fa-exclamation-circle"></i>
			      <small>Error message</small>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12 ">
            <label for="inputSignupPassword" class="email" >Password</label>
            <input
              type="password"
              class="form-control"
              id="inputSignupPassword"
              placeholder="Enter Your Password"
			  name="password"	   
            />
            <i class="fas fa-check-circle"></i>
			      <i class="fas fa-exclamation-circle"></i>
			      <small>Error message</small>
          </div>

          <div class="form-group col-md-12">
            <label for="inputSignupConfirmPassword" class="email" >Confirm Password</label>
            <input
              type="password"
              class="form-control"
              id="inputSignupConfirmPassword"
              placeholder="Confirm Your Password"
			  name="confirm_password"	   
            />
            <i class="fas fa-check-circle"></i>
			      <i class="fas fa-exclamation-circle"></i>
			      <small>Error message</small>
          </div>
        </div>
        
        <div class="row">
          <div class="submit_button col-md-3" >
            <button type="submit" name="signup" class="btn btn-md btn-outline-light">Submit</button>
          </div>
          <div class=" col-md-9" >
            <strong><P class= "change">If Already Registered? Then <a href="signIn.php">Sign In</a></P> </strong>
          </div>
        </div>

      </form>
    </div>

    <script src="./Js/signUp.js"></script>
  </body>
</html>
