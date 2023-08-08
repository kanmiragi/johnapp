<?php
// Make sure you have the appropriate database connection details in this file
include('config/db.php');


// The following lines are used to keep the responses on the forms.
//$name = $profession = $phone = $email = $kin = $kin_phone = $image = '';
//$errors = array('name' => '', 'profession' => '', 'phone' => '', 'email' => '', 'kin' => '', 'kin_phone' => '', 'image' => '');

if (isset($_POST['submit'])) {
    // Check and sanitize the user inputs
    $name = htmlspecialchars($_POST['fullname']);
    $profession = htmlspecialchars($_POST['profession']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $kin = htmlspecialchars($_POST['kin']);
    $kin_phone = htmlspecialchars($_POST['kin_phone']);
    //accessing images
    $image =  $_FILES['mimage']['name'];
    //accessing image temporary name
    $temp_name =  $_FILES['mimage']['tmp_name'];
    //checking empty condition
    if($name=='' or $profession== '' or $phone== ''
     or $email== '' or $kin== '' or  $kin_phone== '' or 
     $image== ''){
        echo "<div class='red-text'>Please fill all the fields</div>";
       exit();
    }else{
       move_uploaded_file($temp_name, "images/$image");
       //insert query  
        $query = "insert into `membership` (fullname,profession,phone,email,kin,
        kin_phone,mimage,created_at)
       values ('$name', '$profession','$phone', '$email', '$kin', '$kin_phone', '$image', NOW())";
       $result = mysqli_query($conn, $query) ;
       if($result){
        echo "<div class='red-text'>Form completed</div>";
       }
    }



    // Validate the form data
//     if (empty($name)) {
//         $errors['name'] = 'Please include a name';
//     } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
//         $errors['name'] = 'Name must be letters and spaces only';
//     }
//     if (empty($profession)) {
//         $errors['profession'] = 'Please include your profession';
//     } elseif (!preg_match('/^[a-zA-Z\s]+$/', $profession)) {
//         $errors['name'] = 'Name must be letters and spaces only';
//     }
//     $phone = $_POST['phone'];
//     if(preg_match("/^([0-9]{11,13}$/",$phone)) {
//         echo 'Your phone number lenght is incorrect';
//     }else{
//         echo 'invalid phone number';
//     }
//     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
//         array_push($errors, 'Email entry is not Valid.');
//     }
//     if (empty($kin)) {
//         $errors['kin'] = 'Please include next of kin';
//     } elseif (!preg_match('/^[a-zA-Z\s]+$/', $kin)) {
//         $errors['kin'] = 'Name must be letters and spaces only';
//     }
//         $kin_phone = trim($_POST[phone]);
//         $ph = '/^[0-9]{10,10}$/';
//     if(preg_match($ph,$kin_phone)) {
//     }else{
//         echo 'invalid phone number';
//     }


//     // Validate other form fields in a similar manner...
//     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
//         array_push($errors, 'Email entry is not Valid.');
//     }

//     // Handle the uploaded image (if any)
//     if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
//         $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
//     }

//     // If there are no errors, save the data to the database
//     if (array_filter($errors)) {
//         echo 'There are errors in the form';
//     } else {
//         // Prepare the SQL query with placeholders to prevent SQL injection
//         $query = "INSERT INTO `membership` (`name`,`profession`,`phone`,`email`,`kin`,`kin_phone`,`image`, `created_at`) 
//         VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
// $stmt = mysqli_prepare($conn, $query);
// mysqli_stmt_bind_param($stmt, "ssssss", $name, $profession, $phone, $email, $kin, $kin_phone, $image);
//         // Execute the prepared statement
//         if (mysqli_stmt_execute($stmt)) {
//             echo 'Form data saved successfully';
//         } else {
//             echo 'Error saving form data: ' . mysqli_error($conn);
//         }

//         // Close the statement
//         mysqli_stmt_close($stmt);
//     }
}
?>

<!DOCTYPE html>
<html>
<body>
    <?php include('includes/header.php'); ?>

    <section class="container grey-text"></section>
    <h4 class="center">Membership register</h4>
    <form action="membership.php" method="POST" class="white" enctype="multipart/form-data">

        <!-- Rest of the form fields -->
        <label for="">Full Name</label>
<input type="text" name="fullname" required="required">
<div class="red-text"> </div>
 

<label for="">Profession</label>
<input type="text" name="profession" required="required">
<div class="red-text"></div>

<label for="">Phone number</label>
<input type="text" name="phone" required="required">
<div class="red-text"></div>

<label for="">email</label>
<input type="text" name="email" required="required" >
<div class="red-text"></div>

<label for="">Next of Kin</label>
<input type="text" name="kin" required="required" >
<div class="red-text"></div>

<label for="">Phone number of Next of Kin</label>
<input type="text" name="kin_phone" required="required" " >
<div class="red-text"></div>

<label for="">Upload Passport-size image</label>
<input type="file" name="mimage" id="file" >
<div class="center red-text"></div>
   
<input type="submit" name="submit" value="submit" class="btn brand z-depth-0" >

</form>


    </form>

    <?php include('includes/footer.php'); ?>
</body>
</html>