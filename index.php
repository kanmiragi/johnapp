   <?php
   session_start();
   if(!isset($_SESSION['user'])){
       header('Location: login.php');
   } 
    //connect to DB
    include_once('config/db.php');
//write query for all satabase content
$sql ='SELECT * FROM sermon ORDER BY created_at';
//make query $get results
$result = mysqli_query($conn, $sql);
//fetch the resulting rows as an array
$sermons = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free spaces in the DB and memory
mysqli_free_result($result);
//close connection
mysqli_close($conn);
//print_r($sermons); 
//print_r(explode(',' , $sermons[0]['bible_reference']));
 ?>
<!DOCTYPE html>
 
<body>
    


<?php include('includes/header.php'); ?>
<h4 class="center grey-text"> Sermons </h4>
<div class="container">
    <div class="row">
        <?php foreach($sermons as $sermon):  ?>
            <div class="col s4 md2 ">
                <div class="card z-depth-2">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($sermon['title']);?></h6>
                        <h6><?php echo htmlspecialchars($sermon['bible_reference']);?></h6>
                    </div>
                    <div class="card-action right-align">
                        <a href="details.php?id=<?php echo $sermon['id']?>" class="brand-text">More info</a>
                    </div>
                </div>
            </div>
    <?php endforeach; ?>    
    </div>

</div>
<?php include('includes/footer.php');?>