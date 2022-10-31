<?php
include 'connection.php';
session_start();
$id="";
$id=$_SESSION['login_id'];
if(isset($_POST['img_id']))
{
  $id=$_POST['img_id'];//to set profile pic
}
error_log("log=".$_SESSION['id']);
$img_uploadtbl= $query_builder->table('img_upload');
$target_dir = AVATAR_STORAGE_PATH;
$file_name = $_FILES["img_upload"]["name"];
$target_file = $target_dir . basename($file_name);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$uploadOk = 1;

$unique_name   = uniqid() . "-" . time();
$newfilename   = $unique_name . "." . $imageFileType;
$destination  = "$target_dir{$newfilename}";

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $Msg=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  header('Location:profile.php?err_response='.$Msg);
  exit;
  $uploadOk = 0;
}
if ($_FILES["img_upload"]["size"] > 500000) {
  $Msg=  "Sorry, your file is too large.";
  header('Location:profile.php?err_response='.$Msg);
  exit; 
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    $Msg=  "Sorry, your file was not uploaded.";
    header('Location:profile.php?err_response='.$Msg);
    exit;

  // if everything is ok, try to upload file
  }else{

    if(!is_dir($target_dir)){
        mkdir($target_dir,0777);
    }

    $check_img = $img_uploadtbl->update()
    ->set('current_upload', 0)
    ->where('user_id', $id)
    ->execute();

    //$file_path="./../html/uploads/".basename($_FILES["img_upload"]["name"]);
    if(move_uploaded_file($_FILES["img_upload"]["tmp_name"], $destination)){
        try{
          $results = $img_uploadtbl->insert([
            [
              'img_path' => $newfilename,
              'user_id' => $id,
              'current_upload' => 1
            ]
          ])->execute();
        }catch(Exception $e){
          error_lor('SQL Error');
          print "<pre>";print_r($e);
          error_log($e->message());
        }
            if($results){
              
              $Msg=  "Image uploaded successfully.";
              header('Location:profile.php?response='.$Msg);
              exit;
            }
           
    }
    else{
      $Msg=  "Image not uploaded.";
      header('Location:profile.php?err_response='.$Msg);
      exit;
    }
  }
?>