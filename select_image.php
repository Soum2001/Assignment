<?
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="assest/css/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assest/css/adminlte.min.css">
    <link rel="stylesheet" href="assest/css/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="assest/css/additional.css">
</head>
<body>
    <?php
    include 'connection.php';
    $id=$_POST['id'];
    error_log('id='.$id);
    $resp = array();
    $table = $query_builder->table('img_upload');

    $images=$table->select()
        ->where('user_id',$id)
        ->get();
        
    $image_arr=array();
    /* foreach ($images as $value) {
        $imageData = base64_encode(file_get_contents(AVATAR_STORAGE_PATH.$value['img_path']));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($value['img_path']).';base64,'.$imageData;
        array_push($image_arr,$src,$value['id']);
        // array_push($image_arr,array($value['id']=>$src));
        echo '<div class="row">';
        echo '<div class="col"><img src="'.$src.'"></div>'; 
        echo '</div>';	
    }  */

    ?>

    <div class="row">
    <?
    foreach ($images as $value) {
        $imageData = base64_encode(file_get_contents(AVATAR_STORAGE_PATH.$value['img_path']));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($value['img_path']).';base64,'.$imageData;
        ?>
        
            <div class="col-sm-4">
                <img class="img-fluid mb-3" src="<?=$src?>" style="height:100px; width:100px">
                <input type="button" class="btn btn-danger btn-sm" value="delete" id=<?echo $value['id']?> onclick="delete_image(<?echo $value['id']?>)">
                <input type="button" class="btn btn-primary btn-sm" value="set profile" id=<?echo 'profile'.$value['id']?> onclick="set_profile_img(<?echo $value['id']?>)">
            </div>
        
        
        <?	
    } 
    ?>
    </div>
    <?
    /* if($image_arr)
    {
        echo json_encode($image_arr);
    }
    else{
        $resp['success']=0;
        $resp['msg']="Invalid data";
        echo json_encode($resp);
    } */

    ?>
<!-- jQuery -->
<script src="assest/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->  <script src="register.js"></script>
</html>        
