<?
include 'connection.php';
session_start();
$table = $query_builder->table('user_details');
$chng_password = md5($_POST['chng_password']);
$confirm_password = md5($_POST['confirm_password']);

if($chng_password == $confirm_password)
{
    $update_password = $table->update()
        ->set('password', $chng_password)
        ->where('email', $_SESSION['otp_email'])
        ->execute();
    if($update_password)
    {
        error_log('email='.$_SESSION['otp_email']);
        error_log('hiii');
        $mssg="Password Changed.";
        header('Location:reset_password.php?response_id=1');
    }
}else{
    $mssg="Password not matched";
    header('Location:reset_password.php?response_id=2');
}
?>