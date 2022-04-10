<!-- php to connect data -->
<?php 
$servername="localhost";
$username="root";
$password="";
$database="inputdata";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    echo " not connected";
}
?>
<!-- fetching values from the form using post method -->
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST["title"];
    $description=$_POST["description"];
    $sql="INSERT INTO `userdata` (`title`, `description`) VALUES ('$title', '$description')";
    $result=mysqli_query($conn,$sql);
    if(!$result)
    {
        echo "found error due to : ".mysqli_error($conn);
    }
    $alert=true;
}
?>
<!-- edit note -->



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" class="css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <title>Hello, world!</title>
  </head>
  <body>
      <!-- popup when we clicked edit btn -->
      <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
  Edit Note
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <span aria-hidden="true"></span>
          </button>
        </div>
        <form action="finalproject.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
      <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Data packer</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Mynotes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contacts</a>
        </li>
      </ul>
      <form class="d-flex">
        <button class="btn btn-outline-success" type="submit">Logout</button>
      </form>
    </div>
  </div>
</nav>
<!-- alert msg after saving input to db -->
<?php
   if($alert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>hey $user</strong> note added successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
   }
   ?>
<!--  form to enter data -->
<div class="container">
    <h3>Add to make </h3>
<form action="finalproject.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" >Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
</div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
</div>
<!-- input table -->
<div class="container">
    
    <table class="table" id="datatable">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Title</th>
      <th scope="col">description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <!-- fetching data -->
  <?php
$sql="SELECT * FROM `userdata`";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
$n=1;
while($row=mysqli_fetch_assoc($result))
{
  echo "<tr>
  <th scope='row'>". $n."</th>
  <td>" .$row['title']. "</td>
  <td>". $row['description']. "</td>
  <td> <button class='edit btn btn-sm btn-dark' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-danger'name='delete'>Delete</button></td>
</tr>";
$n++;
}
?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <!-- this script is the jquery plugin -->
  <script>
    $(document).ready(function () {
      $('#datatable').DataTable();

    });
  </script>
  <!-- script for edit btn -->
 <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })
 </script>
  </body>
</html>