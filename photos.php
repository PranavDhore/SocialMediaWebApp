<?php
	session_start();
	include "includes/db.php";
	include "includes/function.php";

	$message = "";
	$user_session_email = "";
	$user_session_id = "";
	
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


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Photos Post</title>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="CSS/photos.css">
<link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
<div class="bs-example">

    <!-- ==================================== NAVBAR ============================================== -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="./landingPage.html" class="navbar-brand nav_brand"><strong>DYPIAN STUDIO</strong></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="./photos.php" class="nav-item nav-link active">Photos</a>
                <a href="./videos.php" class="nav-item nav-link">Videos</a>
                <a href="./uploadPost.php" class="nav-item nav-link">Upload</a>
                <a href="./profilePage.php" class="nav-item nav-link">Profile</a>

            </div>
            <form class="form-inline ml-auto">
                <a href="videos.php?sign_out=out" class="btn btn-danger">Sign Out</a>
            </form>
        </div>
    </nav>


    <!-- ===================================== MAIN CARD ============================================= -->
	
		<?php
		
		 $fetchPhotos = mysqli_query($connection, "SELECT * FROM photos ORDER BY photo_id DESC");
		 
		 if(!mysqli_num_rows($fetchPhotos) == 0){
			 
			 while($row = mysqli_fetch_assoc($fetchPhotos)){
				 $id = $row['photo_id'];
				 $name = $row['name'];	 
				 $location = $row['location'];
				 $title = $row['title'];
				 $discription = $row['description'];
				 $video_user_id = $row['user_id'];
				 $date = $row['date'];
				 
				 $query = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $video_user_id ");
				  if (!mysqli_num_rows($query) == 0){

					 while($row=mysqli_fetch_assoc($query)){

						 $user_firstname = $row['user_firstname'];
						 $user_lastname = $row['user_lastname'];
						 $user_username = $row['user_username'];
						 $user_college = $row['user_college'];
						 $user_year = $row['user_year'];
						 $user_image = $row['user_image'];
						 
						 
		?>
	
	
	
    <div class="card">
        <div class="card-content">
          <div class="card-body">
            <figure class="image">
              <img src="<?php echo $user_image; ?>" class="profile_image_card" alt="Placeholder image">
            </figure>
            <h5 class="card-title"><?php echo $user_firstname; ?>  <?php echo $user_lastname; ?></h5>
  
            <div class="row">
              <div class="col-lg-6">
                <h5 class="card-text"><small class="text-muted">@<?php echo $user_username; ?></small></h5>
              </div>
              <div class="col-lg-6">
                <span class="badge badge_clg_name badge-success"><?php echo $user_college; ?> - <span class="badge badge-pill badge-warning year"><?php echo $user_year; ?></span></span>
              </div>
            </div>
           
            <p class="card-text">Description About The Post.:- <?php echo $discription; ?></p>
			  <h3 class="card-text"><?php echo $title; ?></h3>  
           </div>
        </div>

        <!-- ================ IMAGE TAG ==================== -->
        <figure class="image is-20x20 card_image">
          <img class="card-img-bottom bottom_image" src="<?php echo $location; ?>" alt="Card image cap" height="30%" width="80%">
       </figure>
  
       <a class="btn btn-sm btn-outline-primary comment-button" href="photosComments.php?id=<?php echo $id; ?>">
        <img src="pictures/commentImg.jpg" alt="..." class="comment_img">
        Comments
       </a>
  
       <time datetime="2016-1-1"><small class="text-muted"><?php echo $date; ?></small></time>
       <span class="text-muted clg_name">D.Y.Patil College Of Engineering, Akurdi</span>
       <span class="text-muted clg_name"> 3rd Year</span>
      </div>
	
	
	
		<?php
				 }//user While

		 		}//This if Ends
				 
				 
			 }//End of WHile
			 
			 
		 }else{
			 echo "<h1>Sorry No Videos Found</h1>";
		 }
	
	
	?>


    <!-- ===================================== MAIN CARD ============================================= -->
    

</div>
</body>
</html> 