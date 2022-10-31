<?
include 'connection.php';
$active_cond=$_POST['active_con'];
$id=$_POST['id'];
error_log('state_id'.$id);
$table = $query_builder->table('user_details');
$resp = array();
$results = $table->update()
        ->set('active', $active_cond)
        ->where('id', $id)
        ->execute();
if($results){
    $resp['success']=1;
    $resp['msg']="State changed";
}else{
    $resp['success']=0;
    $resp['msg']="Not changed";
}

echo json_encode($resp);
?>