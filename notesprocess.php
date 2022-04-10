
<?php
session_start();
// this line is to make sure that after logout the usercant go back
if(!isset($_SESSION['name'])){
    header("location:login.php");
}
$title="";
$description="";
$update=false;
$sno=0;
// connecting data
$servername="localhost";
$username="root";
$password="";
$database="inputdata";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    echo "not connected due to.".mysqli_error();
}
?>
<?php
if(isset($_POST['save'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $passcode=$_SESSION['num'];
    $sql="INSERT INTO userdata (`title`, `description`,`usercode`) VALUES ('$title', '$description','$passcode')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "added succesfully";
    }
    $_SESSION['message']="note has been saved successfully";
    $_SESSION['msg_type']="success";
    header("location: notes.php");
    $saved=true;
}
?>
<?php
if(isset($_GET['delete'])){
    $sno=$_GET['delete'];
//    echo "$sno";
   $mydel="DELETE FROM userdata WHERE `userdata`.`sno` = $sno";
   $myresult=mysqli_query($conn,$mydel);
   if($myresult){
       echo "deleted";
   }
   else{
       echo "error due to ..";
   }
   $_SESSION['message']="note has been deleted successfully";
   $_SESSION['msg_type']="danger";
   header("location: notes.php");
}
?>
<!-- edit -->
<?php
if(isset($_GET['edit'])){
    $sno=$_GET['edit'];
    $update=true;
    $result="SELECT * FROM `userdata` WHERE `sno`=$sno";
    $check=mysqli_query($conn,$result);
    if($check){
        $row=mysqli_fetch_assoc($check);
        // $title=$row['title'];
        // $description=$row['description'];
    }
    else{
        echo "found error".mysqli_error();
    } 

}
?>
<?php
if(isset($_POST['update'])){
    $sno=$_POST['sno'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $sql="UPDATE userdata SET `title` = '$title', `description` = '$description' WHERE `userdata`.`sno` = $sno";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "updated";
    }
    else
    {
        echo "error".mysqli_error($conn);
    }
    $_SESSION['message']="note has been updated successfully";
    $_SESSION['msg_type']="success";
    header("location: notes.php");
 }
?>