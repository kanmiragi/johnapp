
<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link rel="stylesheet" href="style.css">

<body>
    


<?php include('includes/header.php'); ?>

<?php

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();
        
         if(empty($username) OR empty($email) OR empty($password) OR empty($repeatPassword)) {
          array_push($errors, "All fields are required");
        }
      //  if(empty($_POST['title'])){
         //   $errors['title'] = 'Please include a title';
        //   }else{
            $username = $_POST['username'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $username)){
               // $errors['username'] = 'Username must be Letters and spaces only';
               array_push($errors, 'Username must be letters');
            }
           
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, 'Email entry is not Valid.');
        }
        if(strlen($password)<8) {
            array_push($errors, 'Password must be 8 characters long');
        }
        if($password!==$repeatPassword){
            array_push($errors, 'The passwords do not match.');
        }
        include('config/db.php');
        $sql = "SELECT * FROM registration WHERE email = '$email' ";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        if($rowcount>0){
            array_push($errors, 'Email already exists');
        }

        if(count($errors)>0){
            foreach($errors as $error){
              echo "<div class='alert alert-danger'>$error</div> ";
            }
        }else{
            //data is inserted once there is not error
          $sql = "INSERT INTO registration (username, email, password) VALUES (?,?,?)";
          $stmt = mysqli_stmt_init($conn) ;
          $prepare = mysqli_stmt_prepare( $stmt,$sql);
          if($prepare){
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordhash);
             mysqli_stmt_execute($stmt);
           echo "<div class='red-text'><h6>Registration successful</h6></div>";
        }else{
          die('Something went wrong');
        }
        }
    
    }
?>
<form action="registration.php" method="POST" class="white"  >
    <label for="username">Username</label>
    <input type="text" name="username">

    <label for="email"> Email Address</label>
    <input type="email" name="email">

    <label for="password">Password</label>
    <input type="password" name="password">

    <label for="repeatPassword">Repeat Password</label>
    <input type="password" name="repeatPassword">
 
    <input type="submit" name="submit" value="submit" class="btn brand z-depth-0" >
       
</form>
<?php include('includes/footer.php');?>