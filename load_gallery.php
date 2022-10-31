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

    error_log('gallery_type=========================================================================='.$gallery_type);
    $resp = array();
    $results_per_page = 6;
    error_log('pics='.$number_of_result);

    //determine the total number of pages available  
    $number_of_page = ceil ($number_of_result / $results_per_page);
    
    $img_upload = $query_builder->table('img_upload');
    $gallery_tbl= $query_builder->table('galleries');
    $select_gallery_id = $gallery_tbl->select()
    ->where('user_id',$id)
    ->where('gallery_type',2)
    ->get();

    $count_pic=$img_upload->select()
    ->join('galleries', 'galleries.id', '=', 'img_upload.gallery_id')
    ->where('galleries.user_id',$id)
    ->where('galleries.gallery_type',$gallery_type)
    ->where('img_upload.gallery_id',$select_gallery_id[0]['id'])
    ->get();
    //Indivisual user during login
    $images=$img_upload->select()
    ->where('gallery_id',$select_gallery_id[0]['id'])
    ->limit($results_per_page)
    ->offset($page_first_result)
    ->get();
  
    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    } 
    ?>
    <div class="row">
    <?
    foreach ($current_profile as $value) {
        $imageData = base64_encode(file_get_contents(BANNER_STORAGE_PATH.$value['img_path']));

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
        $imageData = base64_encode(file_get_contents(BANNER_STORAGE_PATH.$value['img_path']));

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
<div class="pagination">    
      <?php     
            $total_records=count($count_pic);

         echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $results_per_page);     
        $pagLink = "";       
      
      ?> <? if($page>=2){
        ?>  
            <a onclick="paginate_pic(<?=$page-1?>)">Prev</a>   
       <?}?>     
                   
        <?for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {  
            ?>
              <a class = 'active' onclick="paginate_pic(<?$i?>)"><?= $i ?> </a>   
         <? }               
         else  {
            ?>
              <a onclick="paginate_pic(<?=$i?>)"><?=$i?> </a>     
          <?}  
        };    
  
        if($page<$total_pages){  
            error_log('4th'.$page)?>
            <a onclick="paginate_pic(<?=$page+1?>)">Next </a>   
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

