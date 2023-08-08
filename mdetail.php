<?php
include('config/db.php');
if(isset($_POST['delete'])){
  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
  $sql = " DELETE FROM membership WHERE id = $id_to_delete ";
  if(mysqli_query($conn,$sql)){
header('Location: adminindex.php');
  } {
    echo 'query error: ' . mysqli_error($conn);
  }
}

//check GET request id parameter
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    //create sql statement
    $sql = " SELECT * FROM membership WHERE id = $id";
    //get query results
    $result = mysqli_query($conn, $sql);
    //fetch result from an array
    $membership = mysqli_fetch_assoc($result);
    //free memory space
    mysqli_free_result($result);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('includes/header.php'); ?>
<div class="container center">
    <?php if($membership ): ?>
        <h4> <?php echo htmlspecialchars($membership['fullname']); ?> </h4>
        <p> <?php echo htmlspecialchars($membership['profession']);?> </p>
        <p> Phone: <?php echo htmlspecialchars($membership['phone']); ?> </p>
        <p> <?php echo htmlspecialchars($membership['email']); ?> </p>
        <p> Next of Kin: <?php echo htmlspecialchars($membership['kin']); ?> </p>
        <p>Next-of-kin's Phone number: <?php echo htmlspecialchars($membership['kin_phone']);?> </p>
        <p> <?php echo '<img src="data:image;base64,'.base64_encode($membership['mimage']).'" alt="Image" style="width: 100px; height: 100px;"> ' ; ?> </p>
        <p> <?php echo date($membership['created_at']) ?> </p>
<!--  Delete form -->
      <form action="mdetail.php" method="POST">
       <input type="hidden" name="id_to_delete" value="<?php echo $membership['id']?>" >
        <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">

      </form>

        <?php else: ?>
            <?php endif ?>
</div>

<?php include('includes/footer.php');?>