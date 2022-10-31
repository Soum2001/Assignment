<!DOCTYPE html>
<html lang="en">
<head>
   <style>
    .user_dropdown{
        margin-left:991px;
    }
    </style>
</head>
<body>
    
</body>
</html>
<?
session_start();
// if($_SESSION['login_id']=="")
// {
//     $Msg="Input valid credential to login";
//     header("location:index.php?err_response=".$Msg);
//     exit();
// }
include 'connection.php';
$table = $query_builder->table('user_details');
$user_details=$table->select()->get();

?>
<div class="user_dropdown" id="user_dropdown">
    <select class="select_user">
        <option>--select--</option>
        <?foreach ($user_details as $data)
        {?>
        <option value="<?echo $data['id']?>"><?echo $data['user_name']?></option>
        <?}?>
    </select>
</div>