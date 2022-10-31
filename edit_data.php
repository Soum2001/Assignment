<?php
include 'connection.php';

$id = $_POST['hidden_id'];
$name = $_POST['username'];
//$password=md5($_POST['password']);
$email = $_POST['email'];
$address = $_POST['address'];
$phn_no = $_POST['phn_no'];
$table = $query_builder->table('user_details');
$resp = array();
$results = $table->update()
        ->set('user_name', $name)
        ->set('email', $email)
        ->set('address', $address)
        ->set('phone_no', $phn_no)
        ->where('id', $id)
        ->execute();
if($results){
    $resp['success']=1;
    $resp['msg']="data updated successfully";
}else{
    $resp['success']=0;
    $resp['msg']="Invalid data";
}

echo json_encode($resp);
?>