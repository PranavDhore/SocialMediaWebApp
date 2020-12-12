<?php
	session_start();
	include "includes/db.php";
	include "includes/function.php";

	$message = "";
	$user_session_email = "";
	$user_session_id = "";
	$user_profile_image = "";
	if(isset($_SESSION["session_email"])){
		$message = $_SESSION["session_email"] ." ".$_SESSION["session_id"];
		$user_session_email = $_SESSION["session_email"];
		$user_session_id = $_SESSION["session_id"];
	}else{
		header("Location: signUp.php");
	}


	//Temporary if Loop To signOut
	if(isset($_GET['sign_out'])){
		
		unset($_SESSION['session_email']);
		session_destroy();
		header("Location: signUp.php");
		
	}

?>



<?php //UPDATE PROFILE

		
				
				if(isset($_POST['add_photo'])){
					
				
					
					$maxsize = 5242880; // 5MB
					$name = $_FILES['file']['name'];
					$target_dir = "pictures/";
					$target_file = $target_dir . $_FILES["file"]["name"];
					// Select file type
		     		$photoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					// Valid file extensions
					$extensions_arr = array("png","jpg","jpeg");
					
					   if( in_array($photoFileType,$extensions_arr) ){
						   
						

			  // Check file size
			  if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
				echo "File too large. File must be less than 5MB.";
			  }else{
				  
				  
				// Upload
				if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
					
					
					
				  // Insert record
				  $query = "UPDATE users SET user_image = '$target_file' WHERE user_id = $user_session_id ";

				  $result = mysqli_query($connection,$query);
				if($result){
					
				}else{
					echo "Unable to Upload";
				}	
				  
				}
			  }

		   }else{
			  echo "Invalid file extension.";
		   }
					
					
					
				}
			
			
			?>


	



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="./CSS/profilePage.css">
<link rel="stylesheet" href="./CSS/styles.css">

</head>
<body>
	

	
	
    <div class="bs-example">

    <!-- ================================= NAVBAR ================================================= -->
        
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="./landingPage.html" class="navbar-brand nav_brand"><strong>DYPIAN STUDIO</strong></a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav">
              <a href="./photos.php" class="nav-item nav-link ">Photos</a>
              <a href="./videos.php" class="nav-item nav-link">Videos</a>
              <a href="./uploadPost.php" class="nav-item nav-link">Upload</a>
              <a href="./profilePage.php" class="nav-item nav-link active">Profile</a>

          </div>
          <form class="form-inline ml-auto">
              <a href="videos.php?sign_out=out" class="btn btn-danger">Sign Out</a>
          </form>
      </div>
  </nav>

    <!-- ================================================================================== -->
        
        <div class="card mb-3" style="max-width: 600px;">
            <div class="row">
              <div class="col-md-12 ">
                <class class="view overlay zoom">
					<?php
						$query = "SELECT * FROM users WHERE user_id = $user_session_id ";
						$result = mysqli_query($connection,$query);
						if($result){
							while($row = mysqli_fetch_assoc($result)){
								$user_profile_image = $row['user_image'];
							}
						}
					
					?>
                  <img src="<?php echo $user_profile_image; ?>" class="card_img profile_image" alt="...">
                  <button type="button" class="btn btn-primary modal_button" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-camera-retro fa-2x"></i>
                  </button>
                </class>
              </div>
             
			<?php
				
				$query = "SELECT * FROM users WHERE user_id = $user_session_id ";
				$result = mysqli_query($connection,$query);
				
				if($result){
					while($row = mysqli_fetch_assoc($result)){
						$user_firstname = $row['user_firstname'];
						$user_lastname = $row['user_lastname'];
						$user_username = $row['user_username'];
						$user_email = $row['user_email'];
						$user_college = $row['user_college'];
						$user_year = $row['user_year'];
						$user_profile_image = $row['user_image'];
						
					}
				}
				
				
			?>	
				
      
              <div class="col-md-12">
                <div class="card-body">
                  <h4 class="card-title fname"><?php echo $user_firstname; ?> and <?php echo $user_lastname; ?></h4>
                  <h5 class="card-text username">@<?php echo $user_username; ?></h5>
                  <p class="card-text email"><?php echo $user_email; ?></p>
                  <p class="card-text clgName"><?php echo $user_college; ?></p>
                  <span class="badge badge-pill badge-info year"><?php echo $user_year; ?></span>
                  <p></p>
                  <a href="./managePostDemo.php" class=" card_button btn btn-success">Manage Posts</a>
                  <a href="./UpdateProfile.php" class="btn btn-info card_button ">Edit Profile</a>
                  <a href="signIn.php?logout=out" class="btn btn-danger card_button ">LOGOUT</a>
                </div>
              </div>
            </div>
          </div> <!--Row Div end-->
    </div> <!--Top div bs-example end-->
          



 <!-- ================================== The Modal Image Preview =================================== -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Profile Image</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">	
          <img src="<?php echo $user_profile_image; ?>" class="modal_image" alt="...">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myUpdateModal" >Update Profile Image</button>
        </div>
        </div>
      </div>
  </div>

    <!-- =========================== The Modal  Update Image ====================== -->
  <div class="modal fade" id="myUpdateModal">
      <div class="modal-dialog">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Select Profile Photo</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
	
          <div class="modal-body">
            <form action="profilePage.php" method="post" enctype="multipart/form-data">
              <label for="myfile">Select a file:</label>
              <input type="file" id="myfile" name="file"><br><br>
              <input type="submit" name="add_photo" class="btn btn-success">
            </form>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
          
        </div>
      </div>
  </div>

  
</body>
</html>