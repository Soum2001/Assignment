<?
include 'connection.php';
$img_upload = $query_builder->table('img_upload');
if(isset($_POST['set_profilepic_id']))
{
    error_log("========================================================>>>>>>>>>=====".($_POST['set_profilepic_id']));
    $resp=array();
    //error_log('setpic='.$_POST['set_profilepic_id']);
    $Select_gallery_id=$img_upload->select()
    ->where('id', $_POST['set_profilepic_id'])
    ->get();

    if($Select_gallery_id)
    {
        error_log("========================================================>>>>>>>>>=====1");
    }
  
    $convert_flag0=$img_upload->update()
    ->set('default', 0)
    ->where('gallery_id',$Select_gallery_id[0]['gallery_id'])
    ->execute();
    if($convert_flag0)
    {
        error_log("========================================================>>>>>>>>>=====2");
    }

    $convert_flag1=$img_upload->update()
    ->set('default', 1)
    ->where('id',$_POST['set_profilepic_id'])
    ->execute();
    if($convert_flag1)
    {
        error_log("========================================================>>>>>>>>>=====3");
    }

    if($convert_flag1){
        error_log("========================================================>>>>>>>>>=====4");
        $resp['success']=1;
        $resp['msg']="profile updated successfully";
    }else{
        $resp['success']=0;
        $resp['msg']="Invalid data";
    }
    
    echo json_encode($resp);
}
?>