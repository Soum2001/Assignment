<?
session_start();
session_start();
include 'connection.php';
include 'modal.php';
if($_POST['select_user']!="")
{
    $id=$_POST['select_user'];
    error_log('id'.$id);
}
error_log($id);
$user_role=$_SESSION['role'];
error_log($user_role);
$img_upload = $query_builder->table('img_upload');


    $image=$img_upload->select()
    ->join('galleries', 'galleries.id', '=', 'img_upload.gallery_id')
    ->where('galleries.user_id',$id)
    ->where('galleries.flag',1)
    ->get();

    if($image)
    {
        $imageData = base64_encode(file_get_contents(PROFILE_STORAGE_PATH.$image[0]['img_path']));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($image[0]['img_path']).';base64,'.$imageData;
       
    }
    else{
        $src="./assets/image/default-avatar.png";  
    } 
?>
<!DOCTYPE html>
<html>
    <head>
         <!-- CSS only -->
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="assets/css/adminlte.min.css">
        <link rel="stylesheet" href="assets/css/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/additional.css">
        <link  href="assets/css/cropper.min.css" rel="stylesheet">
    </head>
    <style>
        
         .upload-profile{
            border:2px solid grey;
            border-radius:50%;
            padding:2px;
            margin-right:10px;
        }
        .btn_upload button{
            margin-right:-235px;
        }
        #banner_img{
            position: absolute;
            height:286px;
            width:375px;
           
        }
        .text-center{
            position: relative;
            
        }
        .user{
            margin-left:614px;
        }
    </style>
    <body>

        <div class="wrapper">
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="" id="sidebar_img" class="img-circle elevation-2">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><span id="sidebar_username" name="sidebar_username">Soumya</span> </a>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      
                
                                <li class="nav-link active">
                                    <a href="user_profile.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="color:white">Profile</p>
                                    </a>
                                </li>
                        
                    </ul>
                </nav>
            </aside>
            <div class="content-wrapper" style="min-height: 1604.44px;">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Profile</h1>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content-header">
                    <div class="container-fluid">
                        <form  action="user_profile_upload.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                            <div class="text-center" >
                                                <img class="profile-user-img img-fluid img-circle" src="<?= $src;?>"  id="profile_image">
                                                <input type="file" id="profile_imgupload" name="profile_imgupload" onchange="crop_class.loadprofile_img(this)" style="display:none"/> 
                                                <i class="fas fa-camera upload-profile" id="profileupload" ></i>
                                            </div> 
                                            <h3 class="profile-username text-center"><b><span id="head_username" name="head_username"></span> </b></h3>
                                            <p class="text-muted text-center">student</p>
                                        </div>
                                        <div class="btn_upload">
                                            <button><input type="file" id="bannerimgupload" name="bannerimgupload" onchange="loadbanner_img(this)">banner Upload</button> 
                                        </div>
                                        <!--<img src="" id="banner_img">-->
                                    </div>
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">About Me</h3>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label>Name:</label>
                                            <span id="username" name="username">Soumya</span> 
                                        </div>
                                        <div class="input-group mb-3">
                                            <label>Email:</label>
                                            <span id="email" name="email">email</span>  
                                        </div>
                                        <div class="input-group mb-3">
                                        <label>address:</label>
                                            <span id="address" name="address">address</span> 
                                        </div>
                                        <div class="input-group mb-3">
                                            <label>Phone No:</label>
                                                <span id="phn_no" name="phn_no">Phone No</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-header p-2">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item">
                                                <button onclick="select_profile_page(<?=$_POST['select_user']?>)"><a class="nav-link active" id="profile_images" href="#profile_images" data-toggle="tab">profile image</a></button>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#banner" id="banner_images" data-toggle="tab">Banner image</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#Details" id="Details"data-toggle="tab">Details</a>
                                                </li>
                                              
                                                <?if($user_role=='admin')
                                                {
                                                ?>
                                                <li class="nav-item dropdown">
                                                <?include 'users_dropdown.php'?>
                                                </li>
                                                <?}?>
                                            </ul>
                                        </div>
                                        <div id="image_body">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>  
                </section>
            </div> 
        </div>
        <?
        include 'modal.php';
        ?>
        <!-- jQuery -->
        <script src="assets/jquery/jquery.min.js"></script>
        <script src="assets/js/cropper.min.js"></script>

        <!-- Bootstrap 4 -->
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/adminlte.min.js"></script>
        <script src="assets/js/login_validation.js"></script>
        <script src="assets/dist/js/demo.js"></script>
        <script src="openfile.js"></script> 
        <script src="image_access.js"></script>    
        <script src="register.js"></script> 
        <script src="setimage.js"></script>
                                                
    </body>
</html>