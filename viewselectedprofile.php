<?
    session_start();
    include 'modal.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <!-- CSS only -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="assest/css/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="assest/css/adminlte.min.css">
        <link rel="stylesheet" href="assest/css/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="assest/css/additional.css">

</head>
<body>
    <?php
    session_start();
    include 'connection.php';
    $id=$_SESSION['login_id'];
    $gallery_type=$_POST['gallery_type'];

    $resp = array();
    $img_upload = $query_builder->table('img_upload');
    
    //Indivisual user during login
    $images=$img_upload->select()
        ->join('galleries', 'galleries.id', '=', 'img_upload.gallery_id')
        ->where('galleries.user_id',$id)
        ->where('galleries.type',$gallery_type)
        ->where('galleries.flag',0)
        ->get();

    //Profile pic of login user
    $current_profile=$img_upload->select()
    ->join('galleries', 'galleries.id', '=', 'img_upload.gallery_id')
    ->where('galleries.user_id',$id)
    ->where('galleries.type',$gallery_type)
    ->where('galleries.flag',1)
    ->get();
    ?>
    <div class="row">
    <?
    foreach ($current_profile as $value) {
        $imageData = base64_encode(file_get_contents(PROFILE_STORAGE_PATH.$value['img_path']));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($value['img_path']).';base64,'.$imageData;
     
    ?>
        <div class="col-md-6">
        <img class="img-fluid mb-3" src="<?=$src?>" style="height:617px; width:584px; "id=<?echo $value['id']?>  onclick=popup_pic(<?echo $value['id']?>)>    
        </div>
    <?
    }
    ?>
        <div class="col-md-6">
            <div class="row">
    <?
    foreach ($images as $value) {
        $imageData = base64_encode(file_get_contents(PROFILE_STORAGE_PATH.$value['img_path']));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($value['img_path']).';base64,'.$imageData;
     
    ?>

    <div class="col-sm-4">
        <img class="img-fluid mb-3" src="<?=$src?>" style="height:300px; width:300px;" id=<?echo $value['id']?>  onclick=popup_pic(<?echo $value['id']?>)>    
    </div>
    <?
    }
    ?>
    </div>
    </div>
</div>
    <?
    // if($image_arr)
    // {
    //     echo json_encode($image_arr);
    // }
    // else{
    //     $resp['success']=0;
    //     $resp['msg']="Invalid data";
    //     echo json_encode($resp);
    // } 
    
?>
        <script src="assest/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="assest/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assest/dist/js/adminlte.min.js"></script>
        <script src="assest/js/login_validation.js"></script>
        <script src="assest/dist/js/demo.js"></script>
        <script src="assest/js/register.js"></script>
        <script src="assest/js/image_access.js"></script>
</body>
</html>  

