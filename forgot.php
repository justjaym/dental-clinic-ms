<?php
include("includes/functions.php");
$id = $_GET['email'];
$result =  get_one("select id from tbl_userinfo where email = '$id' ")->id ?? 0;
$message = "<h1>Welcome to PCDMS!</h1>";
$message .= "reset password link: http://$_SERVER[HTTP_HOST]/dentalv2/reset_password.php?id=$result";
send_mail($id, $message);
echo $result;
