<?
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <!-- CSS only -->
  <?include 'header.php'?>
</head>
<body>
    <?php
    session_start();
    include 'connection.php';
    $id=$_SESSION['login_id'];
   
    if(isset($_POST['id']))
    {
        $id=$_POST['id'];
    }
    error_log('id---'.$id);
    $resp = array();
    
    $img_upload = $query_builder->table('img_upload');
    $gallery_tbl= $query_builder->table('galleries');

    $gallery_id=$_POST['gallery_id'];

    $select_gallery_type = $gallery_tbl->select()->where('id',$gallery_id)->get();
   
    error_log("gallery id========================================================".$gallery_id);
    
    $select_gallery_id = $img_upload->select()
    ->where('gallery_id',$gallery_id)
    ->get();

    // $count_pic=$img_upload->select()
    // ->join('galleries', 'galleries.id', '=', 'img_upload.gallery_id')
    // ->where('galleries.user_id',$id)
    // ->where('galleries.gallery_type',$gallery_type)
    // ->where('img_upload.gallery_id',$select_gallery_id[0]['id'])
    // ->get();

    $results_per_page = 6;
    $number_of_result=count($select_gallery_id);

    //determine the total number of pages available  
    $number_of_page = ceil ($number_of_result / $results_per_page);  
    if (isset($_POST['page']) ) {  
        $page = $_POST['page'];  
    } else {   
        $page = 1;
    }

    error_log('pics='.$number_of_result);
     //determine the sql LIMIT starting number for the results on the displaying page  
     $page_first_result = ($page-1) * $results_per_page;
     error_log('limit'.$results_per_page);
     error_log('offset'.$page_first_result);
    ?>
  <?

    //Indivisual user during login
   
 
    $images=$img_upload->select()
        ->where('gallery_id',$gallery_id)
        ->limit($results_per_page)
        ->offset($page_first_result)
        ->get();


      
    if($images)
    {
        error_log('image fetched');
    }
    else{
        error_log('not fetched');
    }
    //Profile pic of login user
    // $current_profile=$img_upload->select()
    // ->join('galleries', 'galleries.id', '=', 'img_upload.gallery_id')
    // ->where('galleries.user_id',$id)
    // ->where('galleries.type',$gallery_type)
    // ->where('galleries.flag',1)
    // ->get();
    if($select_gallery_type[0]['gallery_type']!=1 && $select_gallery_type[0]['gallery_type']!=2)
    {
        $path=CUSTOM_STORAGE_PATH;
       
        error_log($path);
    }else{
        $path=PROFILE_STORAGE_PATH;
        error_log($path);
    }

   
    ?>
    <div class="tab-content">
        <div class="row">
    <?
    if($select_gallery_type[0]['gallery_type']!=1 && $select_gallery_type[0]['gallery_type']!=2)
    {?>
    <form  action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="tab-content">
                <button class="btn btn-primary"><input type="file" id="custom_img" name="custom_img" onchange="load_custom(this,<?=$gallery_id?>)"></button> 
            </div>
        </div>
    </form> 
    <?}?><?
    foreach ($images as $value) {
        $imageData = base64_encode(file_get_contents($path.$value['img_path']));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($value['img_path']).';base64,'.$imageData;
       
    ?>
      
    <div class="col-sm-4">
        <img class="img-fluid mb-3" src="<?=$src?>" style="height:300px; width:300px;" id=<?echo $value['id']?>  onclick=popup_pic(<?echo $value['id']?>)>    
    </div>
    <?
    }
    ?>

    <div class="pagination">    
      <?php     
            $total_records=count($select_gallery_id);

         echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $results_per_page);     
        $pagLink = "";       
      
      ?> <? if($page>=2){
        ?>  
            <a onclick="paginate_pic(<?=$page-1?>,<?=$gallery_id?>)">Prev</a>   
       <?}?>     
                   
        <?for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {  
            ?>
              <a class = 'active' onclick="paginate_pic(<?=$i?>,<?=$gallery_id?>)"><?= $i ?> </a>   
         <? }               
         else  {
            ?>
              <a onclick="paginate_pic(<?=$i?>,<?=$gallery_id?>)"><?=$i?> </a>     
          <?}  
        };    
  
        if($page<$total_pages){  
            error_log('4th'.$page)?>
            <a onclick="paginate_pic(<?=$page+1?>,<?=$gallery_id?>)">Next </a>   
        <? } ?>    
      </div>
      <div class="inline">   
        <form action="" method="POST">
            <input type="number" id="page" name="page" min="1" max="<?= $number_of_page?>"   
            placeholder="<?php echo $page."/".$number_of_page; ?>" required>   
            <button id="btn" name="btn">Go</button> 
        </form>  
     </div>
    </div>
    </div>
   
     <?php
if(isset($_POST['btn']))
{
$page=$_POST['page'];
$page=$page>$number_of_page?$number_of_page:(($page<1)?1:$page);
}
?>  
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
        <script src="assets/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/adminlte.min.js"></script>
        <script src="assets/js/login_validation.js"></script>
        <script src="assets/dist/js/demo.js"></script>
        <script src="assets/js/register.js"></script>
        <script src="assets/js/image_access.js"></script>
</body>
</html>  

