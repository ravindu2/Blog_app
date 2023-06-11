<?php
 session_start();
?>
<?php 
  include_once('inc/conn.php');
?>
<?php

  $postBody = "";
  $query = "SELECT * FROM tbl_post";
  $showpost = mysqli_query($conn, $query);

  if($showpost){
    if(mysqli_num_rows($showpost)  > 0){

      while($post = mysqli_fetch_assoc($showpost)){
        $postBody .= "<div id = 'main_div'>";
          
            $postBody .= "<h1 id = 'title'>";
              $postBody .= "{$post['Post_title']}";
            $postBody .= "</h1>";

            $postBody .= "<div id = 'body'>";
               $postBody .= "{$post['Post_body']}";
            $postBody .= "</div>";

            $postBody .= "<div id = 'body'>";
                $postBody .="<small>";
                   $postBody .= "created at{$post['Create_at']}";
                $postBody .="</small>";
            $postBody .= "</div>";

        $postBody .= "</div>";
      }

    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugin/bootstrap.min.css">
    <script src="plugin/jquery.min.js"></script>
    <script src="plugin/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <style>
      #main_div{
        border: 1px solid #fff;
        margin-bottom: 10px;
        padding: 10px;
        color: #fff;
      }
    </style>
    <title>Blogapp</title>
</head>
<body> 
  <?php include_once('inc/navbar.php') ?>    

  <?php 
    if(isset($_SESSION['User_Fname'])){
      echo $_SESSION['User_Fname'];
    }
    else{
      echo "Session not created";
    }

  ?>

  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron mt-4">
                <h4 id="jumbo-header">Welcome to my Blogapp</h4>
            </div>
        </div>
    </div>
  </div>


  <div class="container">
    <div class="row">
        <div class="col-md-12">
          <div>
            <?php
             echo $postBody;
            ?>
          </div>
        </div>
    </div>
  </div>
  
</body>
</html>