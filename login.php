<!DOCTYPE html>
<html lang="en">

    <title>Document</title>
    <?php include('includes/header.php');?>
<div class="container">
    <?php
    include('config/db.php');
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM registration WHERE username = '$username'";
        $resukt = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($resukt, MYSQLI_ASSOC);
        if($user){
           if(password_verify($password, $user['password'])){
            $_SESSION['user'] = 'yes';
            echo 'Welcome home,' . $username;
            header('Location: add.php');
          
           die();
        }else{
            echo "<div class='red-text'><h6>Password does not match</h6></div>" ;
        }
        }else{
        echo " <div class='red-text'><h6>Username address is not registered</h6></div>";   
          }
    }
    ?>
<form action="login.php" method="POST" class="white">

<label for="">Username</label>
<input type="text" name="username" >
<label for="">Password</label>
<input type="password" name="password">
<input type="submit" name="login" value="login" class="btn brand z-depth-0" >


</form>
</div>

    <?php include('includes/footer.php');?>