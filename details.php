<!DOCTYPE html>
<style>
      .card{
        position: relative;
        left: 210px;
      }
</style>
</html>

<?php 
require("functions/functions.php");

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = trim($_GET['id']);

    $is_page_set = 1;

    $sermon = getSermon($id);

}else{
    $is_page_set= 0;
}
    
?>
<!DOCTYPE html>
<html lang="en">
<?php include('includes/header.php'); ?>
<div class="container center">
    
    <div>
        <?php
            if($is_page_set == 0){
                getSermons();
            }else{
                if(!$sermon){
                    header("location: add.php");
                }

                //show a particulat sermon detais
                echo " <div class='row'>
                <div class='col s12 m6'>
                  <div class='card orange darken-1'>
                    <div class='card-content white-text'>
                      <span class='card-title'>{$sermon['title']}</span>
                      <p></p>
                    </div>
                    <div class='card-action'>
                    <audio controls>
                    <source src='{$sermon['audio']}'>
                  </audio
                    </div>
                  </div>
                </div>
              </div>";
            }
               
        ?>

               

    </div>



</div>

<?php include('includes/footer.php') ; ?>