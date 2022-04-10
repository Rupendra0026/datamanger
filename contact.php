
<?php require_once('notesprocess.php')?>
<?php include ('cnct.php')?>
<?php 
$saved=false;
$deleted=false;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Data Manager</title>
  </head>
  <body>
    <!-- nav bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Data Manager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="notes.php">Mynotes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php"> <b> Contacts</b></a>
        </li>
      </ul>
      <form class="d-flex">
        <button class="btn btn-outline-success" type="submit"><a class="nav-link" href="logout.php">Logout</a></button>
      </form>
    </div>
  </div>
</nav>
<!-- session msgs -->
<?php 
if(isset($_SESSION['message'])): ?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php
echo $_SESSION['message'];
unset($_SESSION['message']);
?>
</div>
<?php endif?>
</div>
<!-- add notes form -->
<div class="container">
    <h3 class="my-3">Hello!! <?php echo $_SESSION['name'];?> Add to your Contacts</h3>
<form action="contactprocess.php" method="POST">
    <input type="hidden" name="sno" value="<?php echo $sno;?>">
    <?php
    $cname="";
    $cemail="";
    $ccontact="";
    ?>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" >name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cname" value="<?php echo $cname ;?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" >Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cemail" value="<?php echo $cemail ;?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" >Contact Number</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="ccontact" value="<?php echo $ccontact ;?>">
  </div>
<?php if($update==true):
    ?>
  <button type="submit" class="btn btn-primary" name="update">update</button>
  <?php else: ?>
    <button type="submit" class="btn btn-primary" name="save">Save</button>
    <?php endif ?>
</form>
</div>
<?php require_once('contactprocess.php')?>
<div class="container">
    <?php 
    $servername="localhost";
    $username="root";
    $password="";
    $database="inputdata";
    $conn=mysqli_connect($servername,$username,$password,$database);
    $passcode=$_SESSION['num'];
$sql="SELECT * FROM `contactdetails` WHERE `usercode`='$passcode'";
$result=mysqli_query($conn,$sql);
if(!$result){
    echo "not working".mysqli_error($conn);
}
?>
<div class="row justify-content-center container">
    <table class="table"> 
        <thead>
            <tr>
                <th colspan="1">Name</th>
                <th colspan="1">Email</th>
                <th colspan="1">Contact num</th>
                <th colspan="4">action</th>
            </tr>
        </thead>
        <?php 

        while ($row=$result->fetch_assoc()): ?>
         <tr>
            <td ><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td>
          <a href="contact.php?edit=<?php echo $row['sno'];?>" class="btn btn-info">Edit</a>
         <a href="contactprocess.php?delete=<?php echo $row['sno'];?>"class="btn btn-danger">Delete</a>
         <a href="sendmail.php?email=<?php echo $row['sno'];?>" class="btn btn-info">Mail</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div> 
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>