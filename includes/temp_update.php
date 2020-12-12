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
				  $query = "UPDATE users SET user_image = $target_file WHERE user_id=$user_session_id";

				  mysqli_query($connection,$query);
				  $message = "<h1>Update successfully.</h1>";
				}
			  }

		   }else{
			  echo "Invalid file extension.";
		   }
					
					
					
				}
			
			
			?>