<?php
	
	session_start();
	include("includes/db.php");
	include("includes/function.php");

	$message = "";
	$user_session_id = "";
	
	if(isset($_SESSION["session_email"])){
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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Upload Post</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./CSS/uploadPost.css">
<link rel="stylesheet" href="./CSS/styles.css">

</head>
<body>
<div class="bs-example">

    <!-- ==================================== NAVBAR ============================================= -->

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="./landingPage.html" class="navbar-brand nav_brand"><strong>DYPIAN STUDIO</strong></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="./photos.php" class="nav-item nav-link ">Photos</a>
                <a href="./videos.php" class="nav-item nav-link">Videos</a>
                <a href="./uploadPost.php" class="nav-item nav-link active">Upload</a>
                <a href="./profilePage.php" class="nav-item nav-link">Profile</a>
  
            </div>
            <form class="form-inline ml-auto">
                <a href="videos.php?sign_out=out" class="btn btn-danger">Sign Out</a>
            </form>
        </div>
    </nav>

    <!-- ==================================================================================== -->
	
	<?php
    
 
    if(isset($_POST['upload'])){
		
		if($_POST['section'] == "Video"){
		
		   $maxsize = 5242880; // 5MB

		   $name = $_FILES['file']['name'];
		   $title = $_POST['title'];
		   $description = $_POST['description'];
		   $target_dir = "postVideos/";
		   $target_file = $target_dir . $_FILES["file"]["name"];

		   // Select file type
		   $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		   // Valid file extensions
		   $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

		   // Check extension
		   if( in_array($videoFileType,$extensions_arr) ){

			  // Check file size
			  if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
				echo "File too large. File must be less than 5MB.";
			  }else{
				// Upload
				if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){




				  // Insert record
				  $query = "INSERT INTO videos(name,location,title,description,user_id,date) VALUES('".$name."','".$target_file."','".$title."','".$description."','".$user_session_id."',now())";

				  mysqli_query($connection,$query);
				  $message = "<h1>Upload successfully.</h1>";
				}
			  }

		   }else{
			  echo "Invalid file extension.";
		   }
	  }else{
			
			 $maxsize = 5242880; // 5MB

		     $name = $_FILES['file']['name'];
			 $title = $_POST['title'];
		   	 $description = $_POST['description'];
			 $target_dir = "postPhotos/";
			 $target_file = $target_dir . $_FILES["file"]["name"];
				
			 // Select file type
		     $photoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			// Valid file extensions
		     $extensions_arr = array("png","jpg","jpeg");
			
			
			  // Check extension
		   if( in_array($photoFileType,$extensions_arr) ){

			  // Check file size
			  if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
				echo "File too large. File must be less than 5MB.";
			  }else{
				// Upload
				if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){

				  // Insert record
				  $query = "INSERT INTO photos(name,location,title,description,user_id,date) VALUES('".$name."','".$target_file."','".$title."','".$description."','".$user_session_id."',now())";

				  mysqli_query($connection,$query);
				  $message = "<h1>Upload successfully.</h1>";
				}
			  }

		   }else{
			  echo "Invalid file extension.";
		   }
			
			
		}
		
		
		
     } 
     ?>		
	
	

    <div class="container">
        <form class="form" id="form" method="post" onsubmit="return checkInputs()" action="uploadPost.php" enctype="multipart/form-data">
            
          <div class="form-group">
            <label for="inputTitle"><?php echo $message ?> Title  <sup>*</sup></label>
            <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Title Of Your Post">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
          
          <div class="form-group">
                <label for="inputDescription">Description <sup>*</sup></label>
                <input type="text" class="form-control" id="inputDescription" name="description" placeholder="Describe About Your Post">
                <i class="fas fa-check-circle"></i>
			          <i class="fas fa-exclamation-circle"></i>
			          <small>Error message</small>
            </div>

            <div class="form-group">
                <label for="inputFile">Choose A File To Upload <sup>*</sup></label>
                <input type="file" class="form-control-file" name="file" id="inputFile" onchange="return fileValidation()">
                <i class="fas fa-check-circle"></i>
			    <i class="fas fa-exclamation-circle"></i>
			    <small>Error message</small>
            </div>


            <div class="form-group">
                <label for="inputCategory" >Categories</label>
                <!--    <input type="number" class="form-control" id="inputCollegeYear" placeholder="Enter Your Year"> -->
                <select class="custom-select mr-sm-2" name="section" id="inputCategory">
                    <option selected>Choose...</option>
                    <option value="Photo">Photo</option>
                    <option value="Video">Video</option>
                  </select>
            <button type="submit" name="upload" class="btn btn-primary upload_button">Upload</button>
             
        </form>
         <!-- Image preview -->
         <div id="imagePreview"></div> 
    </div>

  
</div>
<script src="./Js/uploadPost.js"></script>
</body>
</html> 