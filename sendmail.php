<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
if(!isset($_SESSION['name'])){
    header("location:login.php");
}
?>
<?php
include "cnct.php";
?>
<?php
if(isset($_GET['email'])){
    $sno=$_GET['email'];
    $result="SELECT * FROM `contactdetails` WHERE `sno`=$sno";
    $check=mysqli_query($conn,$result);
    if($check){
        $row=mysqli_fetch_assoc($check);
        $cname=$row['name'];
        $cemail=$row['email'];
        $ccontact=$row['contact'];
        $_SESSION['reciver']=$cemail;
        
    }
    else{
        echo "found error".mysqli_error();
    }
}
?>
<?php
if(isset($_POST['send'])){
    $sendsub=$_POST['sendsub'];
    $sendmsg=$_POST['sendmessage'];
    $_SESSION['sub']=$sendsub;
    $_SESSION['msg']=$sendmsg;
    $to=$_SESSION['reciver'];
    $send=$_SESSION['sender'];
    $note=" <br>this msg was sent by $send  through DATA MANAGER you can contact them personally through the given mail";
    $subject=$_SESSION['sub'];
    $message=$_SESSION['msg'].$note;
    $from= $send;
    if(mail($to,$subject,$message,$from)){
        $done=true;
        ?>
    <script>
        alert ("email has been sent");
    </script>
    <?php
    
    }
    else{
        echo "failed to send".mysqli_error($conn);
    }
    
}
?>
<?php
if($done){
    $_SESSION['message']="Mail has been sent successfully";
    $_SESSION['msg_type']="success";
    header("location: contact.php");
    $sent=true;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Hello, world!</title>
  </head>
  <body class="p-3 mb-2 bg-info text-white">
  <div class="container p-3 mb-2 bg-info text-white ">
  
  <form action="sendmail.php" method="POST"  class="custom-centered">
  <h3 class="my-10 center-block  mb-sm-5">Hello!! <?php echo $_SESSION['name'];?> Add your subject and description!!!</h3>
  <div class="col-lg-5">
  <!-- mb-2 w-50 p-4 row align-items-center -->
    <label for="exampleInputEmail1" class="form-label ">Subject</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sendsub">
  </div>
  <div class="col-lg-5">
    <label for="exampleInputEmail1" class="form-label ">Message</label>
    <input type="text" class="form-control h-25" id="exampleInputEmail1" aria-describedby="emailHelp" name="sendmessage">
  </div>
  <button type="submit" class="btn btn-primary center-block col-lg-5 my-3" name="send">Send</button>
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