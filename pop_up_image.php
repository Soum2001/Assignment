<?php
    session_start();
    include 'connection.php';
    $id=$_POST['img_id'];
    $gallery_type=$_POST['gallery_type'];

    $resp = array();
    $img_upload = $query_builder->table('img_upload');
    $images=$img_upload->select()
        ->join('galleries', 'galleries.id', '=', 'img_upload.gallery_id')
        ->where('galleries.id',$id)
        ->get();
    $imageData = base64_encode(file_get_contents(PROFILE_STORAGE_PATH.$images['img_path']));

    // Format the image SRC:  data:{mime};base64,{data};
    $src = 'data: '.mime_content_type($images['img_path']).';base64,'.$imageData;
        
    if($images)
    {
       $resp['success']=1;
       $resp['img_path']=$src;
    }
    else{
        $resp['success']=0;
        $resp['msg']="image not fetched";
    }
    echo json_encode($resp);
    ?>