<?
include 'connection.php';

$id=$_POST['pic_id'];
$image_uploadtbl = $query_builder->table('img_upload');
$resp=array();

$image_uploadtbl_del=$image_uploadtbl->delete()
->where('id', $id)
->execute();


if($image_uploadtbl_del){
    $resp['success']=1;
    $resp['msg']="picture deleted";
}else{
    $resp['success']=0;
    $resp['msg']="some error occured";
}

echo json_encode($resp);

?>