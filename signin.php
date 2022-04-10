<?php include 'cnct.php' ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Signin</title>
    <link rel="stylesheet" href="signin.css" class="css">
  </head>
  <body>
      <!-- php to read the values -->
      <?php
      if(isset($_POST['submit'])){
          $username=mysqli_real_escape_string($conn,$_POST['username']);
          $email=$_POST['email'];
          $contact=mysqli_real_escape_string($conn,$_POST['contact']);
          $password=$_POST['password'];
          $cpassword=$_POST['cpassword'];
        //   $sql=INSERT INTO `login` (`sn`, `username`, `contact`, `password`, `cpassword`) VALUES (NULL, '$username', '$contact', '$password', '$cpassword');
        //   $result=mysqli_query($conn,$sql);
        //   if($result){
        //       echo "success";
        //   }
        //   else{
        //       echo "error due to".mysqli_error($conn);
        //   }
        $pass=password_hash("$password", PASSWORD_DEFAULT);
        $cpass=password_hash("$cpassword", PASSWORD_DEFAULT);
        $emailquery= "select * from logindetails where email='$email'";
        $result=mysqli_query($conn,$emailquery);
        $emailcount= mysqli_num_rows($result);
        if($emailcount>0)
        {
            ?> 
                    <script>
                    alert("email already exsits");
                    </script>
                    <?php
        }
        else
        {
            if($password===$cpassword)
            {
                $insertquery="INSERT INTO `logindetails` (`num`, `name`, `email`, `contact`, `password`, `cpassword`) VALUES (NULL, '$username', '$email', '$contact', '$pass', '$cpass')";
                $insertcheck=mysqli_query($conn,$insertquery);
                if($insertcheck){
                    ?> 
                    <script>
                    alert("registered successfuly");
                    </script>
                    <?php
                }
                else
                {
                    echo "failed bsc..".mysqli_error($conn);
                    ?> 
                    <script>
                    alert("failed to register");
                    </script>
                    <?php
                }

            }
            else
            {
                ?> 
                <script>
                    alert("password and conform password are not same");
                    </script>
                    <?php
            }
        }
      }
      ?>
    
        <h1 id="head" >Sign up</h1>
        <div class="container" id="edit">
    <form action="signin.php" method="POST">
  <div class="row mb-3 my-5">
    <label for="inputEmail3" class="col-sm-1 col-form-label"><h5>username-</h5></label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" name="username" required >
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-1 col-form-label"><h5>Email-</h5></label>
    <div class="col-sm-5">
      <input type="email" class="form-control" id="inputEmail3" required name="email">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-1 col-form-label"><h5>Contact-</h5></label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputPassword3" required name="contact">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-1 col-form-label"><h5>Password-</h5></label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="inputPassword3" required name="password">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-1 col-form-label"><h5>Conform Password-</h5></label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="inputPassword3" required name="cpassword">
    </div>
  </div>
  <h5>already had an account?? <a href="login.php">Login</a></h5>
  <button type="submit" id="btn"class="btn btn-primary my-5" name="submit">Sign in</button>
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