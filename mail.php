<?php
$to="pa";
$subject="test mail";
$message="hope so its working";
$from="vadlamudirupendra@gmail.com";
if(mail($to,$subject,$message,$from)){
    echo "sent mail";
}
else{
    echo "failed to send";
}
?>