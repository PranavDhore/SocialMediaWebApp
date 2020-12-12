<?php
	session_start();
	
	include "includes/db.php";
	include "includes/function.php";


	$message = "";
	if(isset($_GET['suc'])){
		if($_GET['suc'] == 1){
			$message = "Successfully Registered, Now You Can Login";
		}
	}



	if(isset($_GET['logout'])){
		
		unset($_SESSION['session_email']);
		unset($_SESSION["session_id"]);
		session_destroy();
		header("Location: signUp.php");
		
	}
	
	
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
      href="https://fonts.googleapis.com/css?family=Montserrat"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="./CSS/signIn.css" />
    <title>Sign In Page</title>

    <!-- <script type="text/javascript" src="SignIn.js"></script> -->
  </head>
  <body >


    <div class="nav">
      <div class="nav_brand">
        <a href="./landingPage.html" class="btn btn-success"> BACK</a>
      </div>
    </div>

    <!-- ================================================================================== -->
    <header style="color: aliceblue">Sign In</header>
    <div class="container">
		
		<?php 
		
			if(isset($_POST['login'])){
				$user_email = test_input($_POST['user_email']);
				$user_password =test_input($_POST['user_password']);
				
				
				$query = "SELECT * FROM users WHERE user_email='{$user_email}' AND user_password='{$user_password}' ";
				$result = mysqli_query($connection,$query);
				
				
				if(!$result){
					die("Error ".mysqli_error($connection));
				}else{
					
					while($row = mysqli_fetch_assoc($result)){
						$get_user_email = $row['user_email'];
						$get_user_id = $row['user_id'];
					}
					
					
					
					$_SESSION["session_email"] = $get_user_email;
					$_SESSION["session_id"] = $get_user_id;
					
					header("Location: videos.php");
					
					
				}
				
				
			}
		?>
		
		
      <form id="form" class="form" method="post" onsubmit="return validate()" action="" >
		  <?php echo "<p style='background-color:green; color:#fff;'>$message</p>"; ?>
        <div class="form-group">
          <label for="inputEmail" class="email">Email Address</label>
          <input
            type="email"
            class="form form-control"
            id="inputEmail"
            placeholder="Enter Your Email Address"
			name="user_email"	 
          />
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>
        </div>

        <div class="form-group">
          <label for="signinPassword" class="email">Password</label>
          <input
            type="password"
            class="form form-control "
            id="signinPassword"
            placeholder="Enter Your Password"
			name="user_password"
          />
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>
        </div>

        <div class="row">
          <div class="submit_button col-md-3">
            <button type="submit" name="login" class="btn btn-md btn-outline-light" onclick="validate()">SignIn</button>
          </div>

          <div class="change">
            <strong><p>
              If Not Registered? Then<a href="signUp.php">Sign Up</a>
            </p></strong> 
          </div>
        </div>
      </form>
    </div>
    
    <script src="./Js/signIn.js"></script>
  </body>
</html>
