<?php
include 'connection.php';
session_start();

$id=$_SESSION['login_id'];

$post = print_r($_POST,true);



$gallery_tbl= $query_builder->table('galleries');
$img_uploadtbl= $query_builder->table('img_upload');

$resp=array();

$target_profile_dir = CUSTOM_STORAGE_PATH;
$image_name=$_FILES['custom_img']['name'];

error_log("======== ".$_POST['custom_img']);
error_log($post);
error_log("========");

$file_size=$_FILES['custom_img']['size'];
$target_file = $target_profile_dir . basename($image_name);
$image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$uploadOk = 1;

 $unique_name   = uniqid() . "-" . time();
 $newimagename   = $unique_name . "." . $image_file_type;
 $destination  = "$target_profile_dir{$newimagename}";

if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
&& $image_file_type != "gif" ) {

  header('Location:user_profile.php?err_response=1');
  exit;
  $uploadOk = 0;
}
if ($file_size > 500000) {

  header('Location:user_profile.php?err_response=2');
  exit; 
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    header('Location:user_profile.php?err_response=3');
    exit;

  // if everything is ok, try to upload file
  }else{

    if(!is_dir($target_profile_dir)){
        mkdir($target_profile_dir,0777);
    }
    if(move_uploaded_file($_FILES["custom_img"]["tmp_name"], $destination)){
        try{
            $convert_flag_0=$img_uploadtbl->update()
            ->set('default',0)
            ->where('gallery_id',$_POST['custom_img'])
            ->execute();

            $insert_to_imguplod = $img_uploadtbl->insert([
                [
                'img_path' => $newimagename,
                'gallery_id'=>$_POST['custom_img'],
                'default'=>1
                ]
                ])->execute();
            if( $insert_to_imguplod)
            {
                error_log("=====================================custom data stored====================================");
            }    
            else{
                error_log("==============================custom gallery not stored========================================");
            }

            if($insert_to_imguplod)
            {
                $resp['success']=1;
                $resp['msg']="image added";
            }
            else
            {
                $resp['success']=0;
                $resp['msg']="some error is there";
            }
            echo json_encode($resp);
            // header('Location:user_profile.php');
            // exit;
                        
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