<?php session_start() ?>
<?php include'cnct.php'?>
<?php 
if(isset($_POST['Login'])){

    $lemail=$_POST['lemail'];
    $lpassword=$_POST['lpassword'];
    $sql="select * from logindetails where email='$lemail'";
    $result=mysqli_query($conn,$sql);
    $email_count=mysqli_num_rows($result);
    if($email_count){
      // echo "$email_count";
        // fetch data to check password
        $user_data=mysqli_fetch_assoc($result);
        // echo "$user_data";
        $db_password=$user_data['password'];
        $_SESSION['name']=$user_data['name'];
        $num=$user_data['num'];
        $_SESSION['num']=$num;
        $sender=$user_data['email'];
        $_SESSION['sender']=$sender;
        // storing the username in server using session
        // to verify the byncrpt pass and normal one we has to use verify funct
        $pass_decode = password_verify($lpassword, $db_password);

        if($pass_decode){
          header("location: notes.php");
        }
        else
        {
          ?> 
          <script>
          alert("Check your credentials");
          </script>
          <?php
        }
    }
    else{
      ?> 
          <script>
          alert("check mail address or create an acc");
          </script>
          <?php

    }
}
// else{
//     echo "failed.".mysqli_error($conn);
// }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="signin.css" class="css">
    <title>Login</title>
  </head>
  <body>
  <h1 id="head" class="headdown">Login!!</h1>
      <div class="container">
      <form action="login.php" method="POST">
      <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-1 col-form-label my-8"><h5>Email-</h5></label>
    <div class="col-sm-5 ">
      <input type="email" class="form-control my-8" id="inputEmail3" required name="lemail">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-1 col-form-label"><h5>Password-</h5></label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="inputPassword3" required name="lpassword">
    </div>
  </div>
  <h5>New user??<a href="signin.php">Signup</a></h5>
  <button id="btn" class="btn btn-primary" name="Login">Login</button>
</form>
      </div>

      

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>