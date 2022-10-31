<?
include 'connection.php';
session_start();
$table = $query_builder->table('user_details');
$otp_email = $_POST['otp_email'];
$result = $table->select()
->where('email',$otp_email )
->get();
if($result)
{
  $_SESSION['otp_email']=$result[0]['email'];
  header('Location:send_otp.php');
}
else{
  $errorMsg=  "You are not registered user or Put a valid mail id.";
  header('Location:forget_password.php?response_id=0');
}
?>