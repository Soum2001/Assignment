<?php
include 'connection.php';
session_start();

$id=$_SESSION['login_id'];
$resp=array();
/*
print_r($_POST);
print_r($_FILES);
exit;
*/


$gallery_tbl= $query_builder->table('galleries');
$img_uploadtbl= $query_builder->table('img_upload');


$target_profile_dir = PROFILE_STORAGE_PATH;
$image_name=$_FILES['profile_imgupload']['name'];
//error_log($image_name);
$file_size=$_FILES['profile_imgupload']['size'];
//error_log($file_size);

$target_file = $target_profile_dir . basename($image_name);

$image_file_type=$_FILES['profile_imgupload']['type'];


//$image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

error_log($target_file);
//error_log($image_file_type);
$uploadOk = 1;

 $unique_name   = uniqid() . "-" . time();
 $newimagename   = $unique_name;
 $destination  = "$target_profile_dir{$newimagename}";

// if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
// && $image_file_type != "gif" ) {

//  // header('Location:user_profile.php?err_response=1');
//   //exit;
//   $uploadOk = 0;
// }
if ($file_size > 500000) {

 // header('Location:user_profile.php?err_response=2');
  //exit; 
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
   // header('Location:user_profile.php?err_response=3');
    //exit;

  // if everything is ok, try to upload file
  }else{
    //error_log("creationnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn");
    if(!is_dir($target_profile_dir)){
        mkdir($target_profile_dir,0777);
    }
    if(move_uploaded_file($_FILES["profile_imgupload"]["tmp_name"], $destination)){
        try{
            $select_gallery_id=$gallery_tbl->select()
            ->where('user_id',$id)
            ->where('gallery_type',$_POST['profile_imgupload'])
            ->get();

        
            if( $select_gallery_id)
            {
              $convert_flag=$img_uploadtbl->update()
              ->set('default', 0)
              ->where('gallery_id', $select_gallery_id[0]['id'])
              ->execute();
              $gallery_id=$select_gallery_id[0]['id'];
            }
            else{
   
              $insert_to_gallery = $gallery_tbl->insert([
                [
                  'user_id' =>$id,
                  'gallery_type' => $_POST['profile_imgupload']
                ]
              ])->execute();
              $gallery_id=$connection->lastInsertId();
           
            }
            $insert_to_imguplod = $img_uploadtbl->insert([
              [
              'img_path' => $newimagename,
              'gallery_id'=>$gallery_id,
              'default'=>1
              ]
              ])->execute();
              
            if($insert_to_imguplod)
            {
              $resp['success']=1;
              $resp['msg']="image uploded";
            }
            echo json_encode($resp);        
        }catch(Exception $e){
          error_lor('SQL Error');
          print "<pre>";print_r($e);
          error_log($e->message());
          error_log('image not_uploaded');
        }
  //       if($results){
            
  //           $Msg=  "Image uploaded successfully.";
  //           header('Location:profile.php?response='.$Msg);
  //           exit;
  //       }      
  //   }
  //   else{
  //     error_log('image not_uploaded');
  // } 
  }
}
?>