<?
session_start();
session_start();
include 'connection.php';
$id=$_SESSION['login_id'];
$select_user=$_GET['select_user'];
$user_role=$_SESSION['role'];
error_log($select_user);
error_log('select_user'.$user_role);




//tabels
$user_detailstbl = $query_builder->table('user_details');
$img_upload = $query_builder->table('img_upload');
$gallery_tbl = $query_builder->table('galleries');
$gallery_type_tbl = $query_builder->table('gallery_type');



//check user is there or not
$check= $user_detailstbl->select()
->where('id',$_SESSION['login_id'])
->get();
if(!$check)
{
  error_log("passedddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd");
  header('Location:index.php?err_response=0');
}


if(isset($select_user) && $select_user){
    $id = $select_user;
    error_log('hi');
}else{
    $id = $_SESSION['login_id'];
    error_log('bye');
}

error_log('user_id='.$id);

//fetch no.of extra nav item present
$select_nav_item = $gallery_tbl->select()
->where('user_id',$id)
->get();
//select extra nav item names
$select_nav_name = $gallery_type_tbl->select()
->join('galleries', 'galleries.gallery_type', '=', 'gallery_type.id')
->where('galleries.user_id',$id)
->get();

error_log(count($select_nav_name));


//To set profile pic
$select_gallery_id = $gallery_tbl->select()
    ->where('user_id',$id)
    ->where('gallery_type',1)
    ->get();





    $image = $img_upload->select()
   ->where('gallery_id',$select_gallery_id[0]['id'])
   ->where('default',1)
    ->get();

    error_log('image='.$image[0]['img_path']);

//To set banner pic
$select_gallery_bannerid= $gallery_tbl->select()
    ->where('user_id',$id)
    ->where('gallery_type',2)
    ->get();



    $banner=$img_upload->select()
   ->where('gallery_id',$select_gallery_bannerid[0]['id'])
   ->where('default',1)
    ->get();

  
    if($image)
    {
        $imageData = base64_encode(file_get_contents(PROFILE_STORAGE_PATH.$image[0]['img_path']));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($image[0]['img_path']).';base64,'.$imageData;
       
       
    }
    
    else{
        $src="./assest/image/default-avatar.png";  
    } 
    if($banner)
    {
        error_log('banner_image');
        $imageData = base64_encode(file_get_contents(BANNER_STORAGE_PATH.$banner[0]['img_path']));

        // Format the image SRC:  data:{mime};base64,{data};
        $src_banner = 'data: '.mime_content_type($banner[0]['img_path']).';base64,'.$imageData;
       
    }
    //error_log('src_banner----------------------------------------------------------------------------------------'.$src_banner);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | User Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assest/css/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assest/dist/css/adminlte.min.css">
  <link  href="assest/cropper/cropper.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    
    <ul class="navbar-nav">
      <form method="POST" action="logout.php">
        <div class="row">
          <div class="col-md-6">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li> 
          </div>
          <div class="col-md-6">
            <li class="nav-item">
              <input type="submit" class="btn btn-primary" onclick="logout_btn()" id="logout_btn" name="logout_btn" value="Log out">
            </li> 
          </div>
      </div>
    </ul> 
  </form>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
          <img src="<?= $src?>"  class="img-circle elevation-2">
      </div>
        <div class="info">
          <a href="#" class="d-block">Soumya</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                User Details
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?if($user_role=='admin'){?>
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage User</p>
                </a>
              </li>
              <?}?>
              <li class="nav-item">
                <a href="user_profile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3"> 

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <form  action="user_profile_upload.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="user_id" value=<?=$id?>>
                    <img class="profile-user-img img-fluid img-circle" src="<?= $src;?>"  id="profile_image">
                    <input type="file" id="profile_imgupload" name="profile_imgupload" onchange="crop_class.loadprofile_img(this,1)" style="display:none"/> 
                    <i class="fas fa-camera upload-profile" id="profileupload" ></i>
                  </form>
                </div>
                <h3 class="profile-username text-center"><b><span id="head_username" name="head_username"></span> </b></h3>
                <p class="text-muted text-center">student</p>
                <input type="file" id="banner_imgupload" name="banner_imgupload" onchange="crop_class.loadbanner_img(this,2)" style="display:none"/> 
                <button class="btn btn-primary" id="banner_btn">banner upload</button>
            <!--banner upload-->

              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-user mr-1"></i> Name:</strong>
                    <span id="username1" name="username"></span> 
                    <hr>
                    <strong><i class="fas fa-envelope mr-1"></i> Email:</strong>
                    <span id="email1" name="email"></span> 
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Address:</strong>
                    <span id="address1" name="address"></span> 
                    <hr>
                    <strong><i class="fas fa-phone mr-1"></i> Phone No:</strong>
                    <span id="phn_no1" name="phn_no"></span> 
                </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <!-- <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div> -->

              <div class="card-header p-2">
                <ul class="nav nav-pills" id="navbar">
                    <!-- <li class="nav-item">
                    <a class="nav-link active" id="profile_images" onclick="profile_page(<?=$id?>)" data-toggle="tab">profile image</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#banner" id="banner_images" onclick="banner_page(<?=$id?>)" data-toggle="tab">Banner image</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Details" id="Details"data-toggle="tab">Details</a>
                    </li> -->
                
                    <?foreach ($select_nav_name as $name){?>
                    <li class="nav-item">
                        <a class="nav-link" onclick="load_gallery(<?=$name['id']?>)" data-toggle="tab"><? echo $name['gallery_name']?></a>
                    </li>
                    <?}?>
                    
                    <li class="nav-item">
                        <a class="nav-link add_gallery" onclick="add_gallery(<?=$_SESSION['login_id']?>)">Add Gallery</a>
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
              <!-- /.card-header -->
              <div class="card-body" id="image_body">
                
                
                <!-- /.tab-content -->
              </div>
              <!-- /.card-body -->
             
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<?include 'modal.php'?>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assest/jquery/jquery.min.js"></script>
<script src="assest/cropper/cropper.js"></script>

<!-- Bootstrap 4 -->
<script src="assest/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assest/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assest/dist/js/demo.js"></script>
<script src="assest/js/openfile.js"></script> 
<script src="assest/js/image_access.js"></script>    
<script src="assest/js/register.js"></script> 
<script src="assest/js/setimage.js"></script>
<script src="assest/js/datatable.js"></script> 
</body>
</html>
