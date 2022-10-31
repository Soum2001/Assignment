<?php
include 'connection.php';
$gallery_tbl= $query_builder->table('galleries');
$resp = array();
if(isset($_POST['set_profilepic_id']))
{
    error_log($_POST['set_profilepic_id']);
    $convert_flag0=$gallery_tbl->update()
    ->set('flag', 0)
    ->where('user_id', $id)
    ->where('type',1)
    ->execute();
    $convert_flag1=$gallery_tbl->update()
    ->set('flag', 1)
    ->where('id',$_POST['set_profilepic_id'] )
    ->where('type',1)
    ->execute();
}
if($convert_flag1){
    $resp['success']=1;
    $resp['msg']="State changed";
}else{
    $resp['success']=0;
    $resp['msg']="Not changed";
}

echo json_encode($resp);
?>