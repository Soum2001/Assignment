<?
include 'connection.php';
session_start();
$otp=$_POST['otp'];

$resp=array('status'=>'');
error_log($otp);
// if($otp==$_SESSION['otp']){
if($otp==$_SESSION['otp']){

    $resp['status']='SUCCESS';
}
else{
    $resp['status']='FAILURE';
}
echo json_encode($resp);
?>