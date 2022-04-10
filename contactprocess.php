<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

?>
<?php
$update=false;
$sno=0;
// connecting 
$servername="localhost";
$username="root";
$password="";
$database="inputdata";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    echo "not connected due to".mysqli_error();
}
?>
<!-- getting values from post method and inserting -->
<?php
if(isset($_POST['save'])){
    $cname=$_POST['cname'];
$cemail=$_POST['cemail'];
$ccontact=$_POST['ccontact'];
    $passcode=$_SESSION['num'];
    $sql="INSERT INTO contactdetails (`name`, `email`,`contact`,`usercode`) VALUES ('$cname', '$cemail','$ccontact','$passcode')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "added succesfully";
    }
    $_SESSION['message']="note has been saved successfully";
    $_SESSION['msg_type']="success";
    header("location: contact.php");
    $saved=true;
}
?>
<!-- delete -->
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(isset($_GET['delete'])){
    $sno=$_GET['delete'];
//    echo "$sno";
   $mydel="DELETE FROM contactdetails WHERE `contactdetails`.`sno` = $sno";
   $myresult=mysqli_query($conn,$mydel);
   if($myresult){
       echo "deleted";
   }
   else{
       echo "error due to ..".mysqli_error();
   }
   $_SESSION['message']="note has been deleted successfully";
   $_SESSION['msg_type']="danger";
   header("location: contact.php");
}
?>

<!-- edit -->
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(isset($_GET['edit'])){
    $sno=$_GET['edit'];
    $update=true;
    $result="SELECT * FROM `contactdetails` WHERE `sno`=$sno";
    $check=mysqli_query($conn,$result);
    if($check){
        $row=mysqli_fetch_assoc($check);
        $cname=$row['name'];
        $cemail=$row['email'];
        $ccontact=$row['contact'];
    }
    else{
        echo "found error".mysqli_error();
    }
}
?>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(isset($_POST['update'])){
    $sno=$_POST['sno'];
    $cname=$_POST['cname'];
    $cemail=$_POST['cemail'];
    $ccontact=$_POST['ccontact'];
    $sql="UPDATE contactdetails SET `name` = '$cname', `email` = '$cemail', `contact` = '$ccontact' WHERE `contactdetails`.`sno` = $sno";
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
    header("location: contact.php");
 }
?>
<!-- email -->
<?php
// in this session sender and reciver where getting called

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
    $to=$_SESSION['reciver'];
    $subject="Your acc has been hacked";
    $message="your money 69000,, has to be sent by evening";
    $send=$_SESSION['sender'];
    $from= $send;
    if(mail($to,$subject,$message,$from)){

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