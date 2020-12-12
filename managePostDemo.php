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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="./CSS/managePostDemo.css">
    <link rel="stylesheet" href="./CSS/styles.css">

    <title>Manage Post</title>
</head>
<body>
<div class="bs-example">

    <!-- =================================== NAVBAR =============================================== -->
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
                <a href="./profilePage.php" class="nav-item nav-link">Profile</a>

            </div>
            <form class="form-inline ml-auto">
                 <a href="videos.php?sign_out=out" class="btn btn-danger">Sign Out</a>
            </form>
        </div>
    </nav>

    <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Post</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
			
		<?php
			$val = 1;
			$query = "SELECT * FROM photos WHERE user_id = $user_session_id";
			$result = mysqli_query($connection,$query);
			
			if($result){
				while($row = mysqli_fetch_assoc($result)){
					$photo_id = $row['photo_id'];
					$location = $row['location'];
					$description = $row['description'];
					
			?>		
		
			
			
          <tr>
            <th scope="row"><?php echo $val++; ?></th>
            <td><img src="<?php echo $location; ?>" alt="..." class="figure-img img-fluid rounded"  width="80%" height="25%"></td>
            <td>
                <p><?php echo $description; ?>
                </p>
            </td>
            <td>
               <a href="managePostDemo.php?photo_delete=<?php echo $photo_id; ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
<?php
       		}//while ENds
			}//if Ends
			
			
		?>
			
			
			<?php
			$val = 1;
			$query = "SELECT * FROM videos WHERE user_id = $user_session_id";
			$result = mysqli_query($connection,$query);
			
			if($result){
				while($row = mysqli_fetch_assoc($result)){
					$video_id = $row['video_id'];
					$location = $row['location'];
					$description = $row['description'];
					
			?>		
			
			

          <tr>
            <th scope="row"><?php echo $val++; ?></th>
            <td> 
                <video  class="embed-responsive embed-responsive-4by3" controls class="video-player">
                    <source src="<?php echo $location; ?>" type="video/mp4">
                </video>
            </td>
            <td> 
                <p><?php echo $description; ?>
                </p>
            </td>
			  <td><a href="managePostDemo.php?video_delete=<?php echo $video_id; ?>"class="btn btn-danger">Delete</a></td>
          </tr>

       
        <?php
       		}//while ENds
			}//if Ends
			
			
		?>

        </tbody>
    </table>
</div>
	
	
	<?php
		//Delete Queries
	
		if(isset($_GET['photo_delete'])){
			
			$query = "DELETE FROM photos WHERE photo_id=$photo_id ";
			$result = mysqli_query($connection,$query);
			if(!$result){
				echo '<script>alert("Sorry Not Deleted")</script>'; 
			}else{
				$query = "DELETE FROM comments WHERE comment_post_id=$photo_id AND comment_type='photo' ";
				$result = mysqli_query($connection,$query);
				if(!$result){
					echo '<script>alert("Sorry Not Deleted")</script>'; 
				}else{
					header("Location:managePostDemo.php");
				}
			}
			
		}
	
	
		if(isset($_GET['video_delete'])){
			
			$query = "DELETE FROM videos WHERE video_id=$video_id ";
			$result = mysqli_query($connection,$query);
			if(!$result){
				echo '<script>alert("Sorry Not Deleted")</script>'; 
			}else{
				$query = "DELETE FROM comments WHERE comment_post_id=$video_id AND comment_type='video' ";
				$result = mysqli_query($connection,$query);	
				header("Location:managePostDemo.php");
				
			}
			
		}
		
	
	
	?>
	
	
    
</body>
</html>