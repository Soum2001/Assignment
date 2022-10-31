<?
session_start();
include 'connection.php';
$name = $_POST['user_name'];
$password=md5($_POST['passcode']);
$email=$_POST['mailid'];
$address=$_POST['addres'];
$phn_no=$_POST['phnno'];
$table = $query_builder->table('user_details');
$resp=array();
$check_email=$table->select()->where('email',$email)->get();
if($check_email)
{
    $resp['success']=0;
    $resp['msg']="This user already exist";
}else{
    $inserted_data = $table->insert(
        [
            ['user_name' => $name,'address'=>$address,'phone_no'=>$phn_no,'email' => $email,'password'=>$password,'role'=>'user','type'=>2,'active'=>1]
        ]
    )->execute();

    //$id=$connection->lastInsertId();
    //$_SESSION['id']=$id;

    if($inserted_data){
        $resp['success']=1;
        $resp['msg']="User Registered successfully";
    }else{
        $resp['success']=0;
        $resp['msg']="Not inserted";
    }
}
echo json_encode($resp);
?>
