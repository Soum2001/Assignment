<?
include 'connection.php';

$gallery_name = $_POST['gallery_name'];
$new_gallery_id = $_POST['new_gallery_id'];//login user_id

$gallery_type = $query_builder->table('gallery_type');
$galleries = $query_builder->table('galleries');


error_log(".......................................................................".$gallery_name);
$resp=array();
if($gallery_name == Null)
{
    $resp['success']=0;
    $resp['msg']="Mention some gallery name";

}
else{
$check_gallery_id=$gallery_type
->select()
->join('galleries', 'galleries.gallery_type', '=', 'gallery_type.id')
->where('galleries.user_id',$new_gallery_id)
->get();

if(!(in_array($check_gallery_id[0][$gallery_name],$check_gallery_id)))
{
    //add to gallery_type table
    $add_new_gallery = $gallery_type->insert(
        [
            ['gallery_name' => $gallery_name]
        ]
    )->execute();
    $gallery_type = $connection->lastInsertId();
  
    $add_gallery = $galleries->insert(
        [
            ['gallery_type' => $gallery_type,'user_id'=> $new_gallery_id]
        ]
    )->execute();

    if($add_gallery){
        $resp['success']=1;
        $resp['msg']="New gallery created";
    }
}
else{
    $resp['success']=0;
    $resp['msg']="Gallery already exist";
}
}
echo json_encode($resp);
?>