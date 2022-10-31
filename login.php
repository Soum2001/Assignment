<?
include 'connection.php';
// include 'modal.php';
session_start();

$table = $query_builder->table('user_details');
$email = $_POST['email'];
$password = md5($_POST['password']);

$result = $table->select()
->where('email',$email)
->where('password',$password)
->where('active',1)
->get();
$id = $result[0]['id'];
$type = $result[0]['type'];
if($type==1)
{
    $_SESSION['login_id']=$result[0]['id'];
    $_SESSION['role']=$result[0]['role'];
    header('Location:dashboard.php');
}else if($type==2)
{
    $_SESSION['login_id']=$result[0]['id'];
    $_SESSION['role']=$result[0]['role'];
    $_SESSION['type']=$result[0]['type'];
    header('Location:user_profile.php');
}else{
    header('Location:index.php?err_response=0');
    exit;
}

?> 