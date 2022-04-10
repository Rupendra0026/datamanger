<?php
session_start();
?>
<?php
include "cnct.php";
$user=$_SESSION['name'];
$sql="SELECT * FROM `logindetails` WHERE `name`='$user'";
$result=mysqli_query($conn,$sql);
echo "$user";
// while($row=mysqli_fetch_assoc($result))
// {
//    $x=$row['num'];
//    $_SESSION['num']=$x;
//    echo "$x";
//    $y=$_SESSION['num'];
//    echo "<br>$y";
// }
echo $_SESSION['num'];
?>