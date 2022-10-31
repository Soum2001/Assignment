<?php
include 'connection.php';
session_start();
$id="";
$id=$_SESSION['login_id'];


$gallery_tbl= $query_builder->table('galleries');
$img_uploadtbl= $query_builder->table('img_upload');
$target_banner_dir = BANNER_STORAGE_PATH;
$image_name=$_FILES['bannerimgupload']['name'];
$target_file = $target_banner_dir . basename($image_name);
$image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$uploadOk = 1;

 $unique_name   = uniqid() . "-" . time();
 $newimagename   = $unique_name . "." . $image_file_type;
 $destination  = "$target_banner_dir{$newimagename}";

if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
&& $image_file_type != "gif" ) {
  $Msg=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  header('Location:user_profile.php?err_response='.$Msg);
  exit;
  $uploadOk = 0;
}
if ($file_size > 500000) {
  $Msg=  "Sorry, your file is too large.";
  header('Location:user_profile.php?err_response='.$Msg);
  exit; 
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    $Msg=  "Sorry, your file was not uploaded.";
    header('Location:user_profile.php?err_response='.$Msg);
    exit;

  // if everything is ok, try to upload file
  }else{

    if(!is_dir($target_banner_dir)){
        mkdir($target_banner_dir,0777);
    }
    if(move_uploaded_file($_FILES["bannerimgupload"]["tmp_name"], $destination)){
        try{
          $select_gallery_id=$gallery_tbl->select()
          ->where('user_id',$id)
          ->where('gallery_type',2)
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
                'gallery_type' => 2
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