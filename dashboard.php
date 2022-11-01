<?
session_start();
if($_SESSION['login_id']=="")

include 'connection.php';
include 'modal.php';
$table = $query_builder->table('user_details');
$img_upload = $query_builder->table('img_upload');

$user_details=$table->select()->where('role','user')->get();

$check= $user_detailstbl->select()
->where('id',$_SESSION['login_id'])
->get();

if(!$check)
{
  header('Location:index.php?err_response=0');
  exit();
}

$image = $img_upload->select()
   ->where('gallery_id',$select_gallery_id[0]['id'])
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
// $_SESSION['user']=array();
// for($i=0;$i<count($user_details);$i++)
// {
//     array_push($_SESSION['user'],$user_details[$i]['id']);
// }
// ?>
<html>
    <head>
         <!-- CSS only -->
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
         <link rel="stylesheet" href="assest/css/fontawesome-free/css/all.min.css">
         <link rel="stylesheet" href="assest/css/adminlte.min.css">
         <link rel="stylesheet" href="assest/css/icheck-bootstrap.min.css">
         <link rel="stylesheet" href="assest/css/additional.css">
         <link rel="stylesheet" href="assest/css/datatable.css"> 
        <style>

        </style> 

    </head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li> 
            </ul> 
        </nav>
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
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage User</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
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

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Details Table</h1>
                </div>
                
                </div>
            </div><!-- /.container-fluid -->
            </section>
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">User Details</h3>
                                </div>
                                <div class="card-body">
                                
                                    <table class="table table-hover text-nowrap" id="userdtable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>phone number</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>    
                                        </thead>
                                        <tbody>
                                            <?
                                            foreach ($user_details as $data)
                                            {
                                            ?>  
                                                <tr id="<?echo("row".$data['id'])?>" class="select-row" >
                                                <td><?echo $data['id']?></td>
                                                <td><?echo $data['user_name']?></td>
                                                <td><?echo $data['email']?></td>
                                                <td><?echo $data['phone_no']?></td>
                                                <td><?echo $data['address']?></td>
                                                <td>
                                                    <button onclick="delete_data(<?= $data['id']?>)">Delete</button>
                                                    <button onclick="row_select(<?= $data['id']?>)">Edit</button>
                                                </td>
                                            </tr>  
                                            <?
                                            }
                                            ?>  
                                        </tbody>
                                    </table>
                                    
                                <div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>   
    </div>
        <!-- jQuery -->
        <script src="assest/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="assest/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assest/dist/js/adminlte.min.js"></script>
        <script src="assest/js/login_validation.js"></script>
        <script src="assest/js/register.js"></script>
        <script src="assest/js/image_access.js"></script>
        <script src="assest/js/datatable.js"></script>   
    <?include 'modal.php'?>
    </body>
</html>