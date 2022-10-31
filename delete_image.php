<?
include 'connection.php';
$img_uploadtbl = $query_builder->table('img_upload');
$img_id=$_POST['img_id'];
// $query=array();
$delete_img = array();
$resp=array();
$select_userid = $img_uploadtbl->select()->where('id', $img_id)->get();

$user_id=$select_userid[0]['user_id'];

$query=$img_uploadtbl->select()->where('user_id', $user_id)->orderBy('id','desc')->get();
error_log($query[1]['id']);

if($img_id==$query[0]['id'])
{
    $update_flag = $img_uploadtbl->update()
            ->set('current_upload', 1)
            ->where('id', $query[1]['id'])
            ->execute();
        if($update_flag)
        {
            $delete_img = $img_uploadtbl->delete()
            ->where('id', $query[0]['id'])
            ->execute();
        }  
}else{
    $delete_img = $img_uploadtbl->delete()
            ->where('id', $img_id)
            ->execute();
}
if($delete_img){
    $resp['success']=1;
    $resp['msg']="image deleted";
}else{
    $resp['success']=0;
    $resp['msg']="Invalid data";
}
echo json_encode($resp);
?> 