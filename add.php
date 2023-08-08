<?php
ini_set("display_errors", "on");
include('config/db.php');
if(isset($_POST['save-media'])){
  $maxsize = 104857600; //5MB
  $filename = $_FILES['file']['name'];

  $filenamebox = explode(".", $filename);

  //print_r($filenamebox);
  if(count($filenamebox) > 0){
    $filenameboxlength = count($filenamebox);
    $extensionindex = $filenameboxlength  - 1;
    $extension = $filenamebox[$extensionindex];
    
    $filename = time() . "-". uniqid().".".$extension; 
  }else{
      die("Invalid Audio format!");
  }



  $email = $_POST['email'];
  $title = $_POST['title'];
  $bible_reference = $_POST['bible_reference'];
  $teacher = $_POST['teacher'];
  $target_dir = "uploads/";
  $target_file = $target_dir . $filename;

  //Select file type
  $audioFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  //valid file extension
  $extension_arr = array("mp3","mp4", "wav", "m4a", "wma", "aac");
  //check extension

  //die($target_file);

  if(in_array($audioFileType, $extension_arr)){
    //check file size
    if(($_FILES['file']['size'] >= $maxsize || ($_FILES["file"]['size']) == 0)){
      echo "file is too large. File must be less than 5MB";
    }else {
      if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
        //insert record
       $query = "INSERT INTO `sermon` (`email`, `title`, `bible_reference`, `teacher`, `audio`, `created_at`) VALUES ('$email', '$title', '$bible_reference',
       '$teacher', '$target_file', NOW())"; 
        $result = mysqli_query($conn, $query);

        if($result){
          echo "Upload Complete";
        }else{
          echo mysqli_error($conn);
        }
        
      }
    }
  }else{
      echo "Error";
  }


}


// function get_random_name($num=6){
//   $characters = 'abcdefghijklmnopqrstuvwxy0123456789';
//   $string =  '';
//   $max = strlen($characters) - 1;
//   for($i-0; $i < $num; $i++){
//     $string .=$characters[mt_rand(0, $max)];
//   }
//   return $string;
// }

// function

// if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save-media'])){
//     $uploaddir = "./uploads/";
//     if(isset($_FILES['file']) && $_FILES['file']['error'] ==0){
        
//         $filename = $_FILES['file']['name'];
//         $filetype = $_FILES['file']['type'];
//         $filesize = $_FILES['file']['size'];
//         $newFilename = get_random_name() . "." . pathinfo($filename, PATHINFO_EXTENSION);
//         if(file_exists($uploaddir . $newFilename))   {
//          echo $filename . 'Already exists';
//          } else{ 
//          move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir . $newFilename);
//          echo 'Your files have been uploaded successfully';
//         }
//     }

// }

?>

<!DOCTYPE html>
 
<?php include('includes/header.php') ?>

<section class="container grey-text"></section>
<h4 class="center">Upload a sermon</h4>
<form action="add.php"  method="POST"  class="white" enctype="multipart/form-data" >
    
<div class="container">
         <a href="login.php" class="btn brand z-depth-0">Log Out</a>
    </div>

 <label for="">Email</label>
<input type="text" name="email" required="required">


<label for="">Sermon Title</label>
<input type="text" name="title" required="required" >


<label for="">Bible references and Texts. (Comma seperated) </label>
<input type="text" name="bible_reference" required="required">


<label for="">Teacher/Pastor's Name.</label>
<input type="text" name="teacher" required="required" >


<label for="">Upload Audio File</label>
<input type="file" name="file"/>
<button type="submit" name="save-media" class="btn brand z-depth-0">Save Media</button>

</form>
<?php include('includes/footer.php') ?>



  