<?
include 'connection.php';
$table = $query_builder->table('user_details');
$id = $_POST['id'];
$state=$_POST['state'];
$resp = array();
$results = $table->update()
        ->set('active',$state)
        ->where('id', $id)
        ->execute();

if($results){
    $resp['success']=1;
    $resp['msg']="Status changed";
}else{
    $resp['success']=0;
    $resp['msg']="Invalid data";
}

echo json_encode($resp);
?>
