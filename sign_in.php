<?php
 session_start();
?>

<?php 
  include_once('inc/conn.php');
?>
<?php
  if(isset($_POST['submit'])){

    $email = "";
    $password = "";
    $msg = "";

    $email = input_varify($_POST['email']);
    $password = input_varify($_POST['password']);

    $query1 = "SELECT * FROM tbl_user WHERE pwd = '{$password}' AND email = '{$email}' LIMIT 1";

    $showResult = mysqli_query($conn, $query1);

    if($showResult){

      if(mysqli_num_rows($showResult) == 1){

        $user = mysqli_fetch_assoc($showResult);
        $_SESSION['User_Fname'] = $user['Fname'];
        $_SESSION['User_email'] = $user['email'];

        
        header("Location: index.php");
       
      }
      else{

        $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Sorry!</strong> Please check your email or password.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";

      }
    }


  }

  function input_varify($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;

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
    <link rel="stylesheet" href="css/sign_up.css">
    <title>Blogapp</title>
</head>
<body> 
  <?php include_once('inc/navbar.php') ?>    

  <div class="container">
    <div class="row">
        <div class="col-md-12">
         <div class="card mt-4">
          <div class="card-header" id="card-header">
            <h4>Sign In Form</h4>
          </div>
      
        <form action="sign_in.php" method="POST" autocomplete="off">
          <div class="card-body" id="card-body">

          <?php if(!empty($msg)){echo $msg;}?>

            <div class="form-group">
              <label for="">Email</label>
              <input type="text" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Enter your email adress</small>
            </div>

            <div class="form-group">
              <label for="">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Create you own password</small>
            </div>

          </div>
          <div class="card-footer" id="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">Sign In</button>
          </div>
      </form>
         </div>
        </div>
    </div>
  </div>
</body>
</html>