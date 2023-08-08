<?php
include('config/db.php');
//write query for all satabase content
$sql ='SELECT * FROM membership ORDER BY created_at';
//make query $get results
$result = mysqli_query($conn, $sql);
//fetch the resulting rows as an array
$memberships = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free spaces in the DB and memory
mysqli_free_result($result);
//close connection
mysqli_close($conn);
//print_r($membership);

?>
<!DOCTYPE html>
 
<body>
    


<?php include('includes/header.php'); ?>

<h4 class="center grey-text"> Membership Dashboard </h4>
<div class="container">
    <div class="row">
        <?php foreach($memberships as $membership){  ?>
            <div class="col s4 md2 ">
                <div class="card z-depth-2">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($membership['fullname']);?></h6>
                        <h6><?php echo htmlspecialchars($membership['kin_phone']);?></h6>
                    </div>
                    <div class="card-action right-align">
                        
                        <a class="brand-text" href="mdetail.php?id=<?php echo $membership['id']?>" >More info</a>

                    </div>
                </div>
            </div>
    <?php } ?>    
    </div>

</div>

<?php include('includes/footer.php');?>__