<?
include 'connection.php';

$id=$_POST['id'];
error_log('edit='.$id);
$resp = array();
$table = $query_builder->table('user_details');
$results=$table->select()->where('id',$id)->get();

if($results)
{
    error_log('data fetched for edit');
}
if(count($results) > 0){
    $resp['success'] = 1;
    $resp['data']   = $results[0];
}else{
    $resp['success'] = 0;
    $resp['msg']   = 'Invalid user.';
}

echo json_encode($resp);
?>
