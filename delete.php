<?php
include 'connection.php';

$id=$_POST['id'];
$resp = array();


$image_uploadtbl = $query_builder->table('img_upload');
$galleriestbl = $query_builder->table('galleries');
$gallery_typetbl = $query_builder->table('gallery_type');
$user_detailstbl = $query_builder->table('user_details');

$user_detailstbl_del=array();

$select_imguploadtbl_tbl=$image_uploadtbl->select()
->join('galleries', 'galleries.id', '=', 'img_upload.gallery_id')
->where('user_id',$id)
->execute();



if(count($select_imguploadtbl_tbl)>1)
{
    foreach($select_imguploadtbl_tbl as $item)
    {
        $image_uploadtbl_del=$image_uploadtbl->delete()
        ->where('gallery_id', $item['id'])
        ->execute();
    }
}


$galleriestbl_del=$galleriestbl->delete()
->where('user_id', $id)
->execute();


$user_detailstbl_del=$user_detailstbl->delete()
->where('id',$id)
->execute();


if($user_detailstbl_del){
    $resp['success']=1;
    $resp['msg']="data deleted successfully";
}else{
    $resp['success']=0;
    $resp['msg']="some error occured";
}

echo json_encode($resp);
?>