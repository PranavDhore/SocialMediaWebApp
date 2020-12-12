<?php

	session_start();
	include "includes/db.php";
	include "includes/function.php";

	$message = "";
	$user_session_email = "";
	$user_session_id = "";
	$video_get_id = "";

	if(isset($_GET['id'])){
		
		$video_get_id = $_GET['id'];

		if(isset($_SESSION["session_email"])){
			$message = $_SESSION["session_email"] ." ".$_SESSION["session_id"];
			$user_session_email = $_SESSION["session_email"];
			$user_session_id = $_SESSION["session_id"];
		}else{
			header("Location: signUp.php");
		}
		
	}else{
		header("Location: videos.php");
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
<title>Videos Comments</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./CSS/videosComments.css">
<link rel="stylesheet" href="./CSS/styles.css">
</head>
<body>
<div class="bs-example">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="./landingPage.html" class="navbar-brand nav_brand"><strong>DYPIAN STUDIO</strong></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="./photos.php" class="nav-item nav-link ">Photos</a>
            <a href="./videos.php" class="nav-item nav-link active">Videos</a>
            <a href="./uploadPost.php" class="nav-item nav-link">Upload</a>
            <a href="./profilePage.php" class="nav-item nav-link ">Profile</a>

        </div>
        <form class="form-inline ml-auto">
            <a href="videos.php?sign_out=out" class="btn btn-danger">Sign Out</a>
        </form>
    </div>
</nav>

     <!-- TODO: =============================== Main Card: ===================================== -->
	
	<?php
	
		$fetchVideos = mysqli_query($connection, "SELECT * FROM videos WHERE video_id= $video_get_id ");
		
		 if(!mysqli_num_rows($fetchVideos) == 0){
			 
			 while($row = mysqli_fetch_assoc($fetchVideos)){
				 $id = $row['video_id'];
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
	
	
     <div class="card main-card">
        <div class="card-content">
          <div class="card-body">
            <figure class="image is-48x48">
              <img src="<?php echo $user_image; ?>" class="profile_image_card" alt="Placeholder image">
            </figure>
            <h5 class="card-title"><?php echo $user_firstname; ?> And <?php echo $user_lastname; ?></h5>
  
            <div class="row">
              <div class="col-lg-6">
                <h5 class="card-text"><small class="text-muted">@<?php echo $user_username; ?></small></h5>
              </div>
              <div class="col-lg-6">
                <span class="badge badge_clg_name badge-success"><?php echo $user_college; ?> - <span class="badge badge-pill badge-warning year"><?php echo $user_year; ?></span></span>
              </div>
            </div>
           
            <p class="card-text">Description About The Post.:- <?php echo $discription; ?></p>
            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
          </div>
        </div>
          
        <video width="80%" height="80%" controls class="video-player post_video">
          <source src="<?php echo $location; ?>" type="video/mp4">
        </video>
  
  
       <time datetime="2016-1-1"><small class="text-muted"><?php echo $date; ?></small></time>
       <span class="text-muted clg_name">D.Y.Patil College Of Engineering, Akurdi</span>
       <span class="text-muted clg_name"> 3rd Year</span>
       <article class="media"></article>
      </div>
	
	
	
	<?php
				 }//user While

		 		}//This if Ends
				 
				 
			 }//End of WHile
			 
			 
		 }else{
			 echo "<h1>Sorry No Videos Found</h1>";
		 }
	
	
	?>	
      <!-- TODO: =============================== Main Card: ===================================== -->
  
  	
	<?php
		
		if(isset($_POST['comment'])){
			
			$content = $_POST['content'];
			
			$comment_query = "INSERT INTO comments(comment_post_id,comment_user_id,comment_content,comment_date,comment_type) VALUES('".$video_get_id."','".$user_session_id."','".$content."',now(),'video') ";
			
			$result = mysqli_query($connection,$comment_query);
	
		}
	
	
	?>
  
  
      <!-- TODO: ====================Comment Card=================== -->  
      <div class="card comment-card">
		  
		  <?php
		  	
		  	$query = mysqli_query($connection,"SELECT * FROM comments WHERE comment_post_id = $video_get_id AND comment_type = 'video' ");
		  
		  	 if(!mysqli_num_rows($query) == 0){
				 
				while($row = mysqli_fetch_assoc($query)){
					$user_comment_id = $row['comment_user_id'];
					$comment_content = $row['comment_content'];
					$comment_date = $row['comment_date'];
					
					$userdata = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $user_comment_id ");
					if(!mysqli_num_rows($query) == 0){
						while($row = mysqli_fetch_assoc($userdata)){
							$user_username = $row['user_username'];
							$user_image = $row['user_image'];
							
					?>		
		
		  
          <article class="media">
              <figure class="media-left">
                  <p class="img is-64x64 commented_img">
                      <img src="<?php echo $user_image; ?>" class="comment_profile_image" alt="">
                  </p>
              </figure>
  
              <div class="media-content">
                  <div class="content">
                      <p>
                          <strong><?php echo $user_username; ?></strong>
                          <br>
                          <?php echo $comment_content; ?>
                          <br>
                          <small>Posted On :<?php echo $comment_date; ?></small>
                      </p>
                  </div>
              </div>
          </article>
			  
			<?php	  
			  
			  				}
					
						
					}	//user if
					
				}//comment while	 
					 
				 
			 }else{
				 echo "<p>No Comments On This Post</p>";
			 }//comment if
		  
		  
		  ?>
			  
			  
			  
		  <form action="" method="post"> 
          <div class="row">
              <div class="col-lg-2 comment_image">
                  <img src="./pictures/iconfinder_avatar-370-456322_6415362.png " alt="">
              </div>
              <div class="col-lg-10">
                  <div class="input-group">
                      <input class="form-control" type="text" name="content" aria-label="With textarea" />
                    </div>
              </div>
          </div>
          <input class="btn btn-sm btn-outline-primary  post_comment_button" type="submit" name="comment" value="Post Comment">
         </form>
      </div>
      <!-- TODO: ====================Comment Card=================== -->  
</div>
</body>
</html> 