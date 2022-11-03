<?php
  session_start();
    include 'connection.php';
    include 'modal.php';
   
    $query1=array();
    // error_log("profile=".$_GET['id']);
    // error_log("name=".$_SESSION['name']);
    // error_log("name=".$_SESSION['login_id']);
    
    if(isset($_POST['img_id']))
    {
        $resp=array();
        error_log('xgsdgdsi');
        $id=$_POST['img_id'];//to set profile pic
        $table = $query_builder->table('img_upload');
        $update_flag=$table->update()
        ->set('current_upload',0)
        ->where('user_id',$_SESSION['login_id'])
        ->execute();

        $update_flag1=$table->update()
        ->set('current_upload',1)
        ->where('id',$id)
        ->execute();
        if($update_flag1)
        {
            $resp['success']=1;
            $resp['msg']="Profile updated successfully";
            
        }
        else{
            $resp['success']=0;
            $resp['msg']="Some error occured";
        }
        echo json_encode($resp);
        exit();
       
        // $imageData = base64_encode(file_get_contents(AVATAR_STORAGE_PATH.$query1['img_path']));

        // // Format the image SRC:  data:{mime};base64,{data};
        // $src = 'data: '.mime_content_type($query1['img_path']).';base64,'.$imageData;
    }
   else if(isset($_SESSION['login_id'])){
        error_log('hi');
        $table = $query_builder->table('img_upload');
        $query1=$table->select()
        ->where('current_upload', 1)
        ->where('user_id',$_SESSION['login_id'])
        ->get();
        if($query1)
        {
            // Read image path, convert to base64 encoding
        $imageData = base64_encode(file_get_contents(AVATAR_STORAGE_PATH.$query1[0]['img_path']));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($query1[0]['img_path']).';base64,'.$imageData;
        }
        else{
            $src="./assets/image/default-avatar.png";
        }   
    } 
    else if(($_GET['response'])=='Image uploaded successfully.')
    {
        error_log('hii');
        $table = $query_builder->table('img_upload');
        $query1=$table->select()
        ->orderBy(['user_id' => 'desc'])
        ->Limit(1)
        ->get();
        // Read image path, convert to base64 encoding
        $imageData = base64_encode(file_get_contents(AVATAR_STORAGE_PATH.$query1['img_path']));
        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data: '.mime_content_type($query1['img_path']).';base64,'.$imageData;
    }else{
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

    </head>
    <body>
    <div class="wrapper">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<? echo $src;?>" id="sidebar_img" class="img-circle elevation-2">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Soumya Samantaray</a>
                    </div>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                        Tables
                          <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        <li class="nav-item menu-is-opening menu-open">
                            <li class="nav-item">
                                <a href="dashboard.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="profile.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                        </li>
                    </ul>
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
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <?
                                            if(isset($_GET['response'])){
                                                ?>
                                                <p class='message'><?php echo $_GET['response'] ?></p>
                                                <?
                                            }
                                        ?>
                                         <?
                                            if(isset($_GET['err_response'])){
                                                ?>
                                                <p class='errorMsg'><?php echo $_GET['err_response'] ?></p>
                                                <?
                                            }
                                        ?>
                                        <form action="upload.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" id="hidden_img" name="hidden_img" value="<? echo $src;?>">
                                            <img class="profile-user-img img-fluid img-circle" id="profile_img" name="profile_img" src="<? echo $src;?>" alt="User profile picture">
                                            
                                            <h3 class="profile-username text-center"><?echo $_SESSION['name']?></h3>
                                            <p class="text-muted text-center">Student</p>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <!-- <li class="list-group-item">
                                                  <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                                                </li> -->
                                                <!-- <li class="list-group-item">
                                                    <b class="item_name">Following</b>
                                                    <a class="float-right">562</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b class="item_name">Friends</b>
                                                    <a class="float-right">15,600</a>
                                                </li> -->
                                            </ul>
                                            <div class="btn_upload">
                                                <a href="#"class="btn btn-primary btn-block"><input type="file" id="img_upload" name="img_upload" onchange="readURL(this)">
                                                <b>Choose image</b>
                                                </a>   
                                            </div>
                                            <input type="submit" value="Upload Image" name="submit">
                                        </form>
                                        <button class="btn btn-primary" id="view_images" onclick="view_images(<?echo $_SESSION['login_id']?>)"><b>View Images</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#activity" data-toggle="tab">Activity</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-pane active" id="activity">
                                        <div class="post">
                                            <div class="user-block">
                                            
                                                <img class="img-circle img-bordered-sm" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="user-image">
                                                <span class="user-name">
                                                    <a href="#">Jonathan Burke Jr.</a>
                                                    <a href="#" class="float-right btn-tool">
                                                        <i class="fas fa-times">

                                                        </i>
                                                    </a>
                                                </span>
                                                <span class="description">Shared publicly - 7:30 PM today</span>
                                            </div>
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore the hate as they create awesome
                                                tools to help create filler text for everyone from bacon lovers
                                                to Charlie Sheen fans.
                                            </p>
                                            <p>
                                                <a href="#" class="link-black text-sm mr-2">
                                                    <i class="fas fa-share mr-1"></i>
                                                    share
                                                </a>
                                                <a href="#" class="link-black text-sm">
                                                    <i class="far fa-thumbs-up mr-1"></i>
                                                    like
                                                </a>
                                                <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i>
                                                        comments(5)
                                                    </a>
                                                </span>
                                            </p>
                                            <input type="text" class="form-control form-control-sm" placeholder="Type a comment">
                                        </div>
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="user-image">
                                                <span class="user-name">
                                                    <a href="#">Jonathan Burke Jr.</a>
                                                    <a href="#" class="float-right btn-tool">
                                                        <i class="fas fa-times">

                                                        </i>
                                                    </a>
                                                </span>
                                                <span class="description">Shared publicly - 7:30 PM today</span>
                                            </div>
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore the hate as they create awesome
                                                tools to help create filler text for everyone from bacon lovers
                                                to Charlie Sheen fans.
                                            </p>
                                            <form class="form-horizontal">
                                                <div class="input-group input-group-sm mb-0">
                                                    <input class="form-control form-control-sm" placeholder="Response">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-danger">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="user-image">
                                                <span class="user-name">
                                                    <a href="#">Jonathan Burke Jr.</a>
                                                    <a href="#" class="float-right btn-tool">
                                                        <i class="fas fa-times">

                                                        </i>
                                                    </a>
                                                </span>
                                                <span class="description">Shared publicly - 7:30 PM today</span>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid" src="https://adminlte.io/themes/v3/dist/img/photo1.png" alt="Photo">
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <img class="img-fluid mb-3" src="https://adminlte.io/themes/v3/dist/img/photo2.png" alt="Photo">
                                                            <img class="img-fluid" src="https://adminlte.io/themes/v3/dist/img/photo3.jpg" alt="Photo">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <img class="img-fluid mb-3" src="https://adminlte.io/themes/v3/dist/img/photo4.jpg" alt="Photo">
                                                            <img class="img-fluid" src="https://adminlte.io/themes/v3/dist/img/photo1.png" alt="Photo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                <a href="#" class="link-black text-sm mr-2">
                                                    <i class="fas fa-share mr-1"></i>
                                                    share
                                                </a>
                                                <a href="#" class="link-black text-sm">
                                                    <i class="far fa-thumbs-up mr-1"></i>
                                                    like
                                                </a>
                                                <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i>
                                                        comments(5)
                                                    </a>
                                                </span>
                                            </p>
                                            <input type="text" class="form-control form-control-sm" placeholder="Type a comment">
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="settings">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName" placeholder="Name"> 
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email"> 
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputskill" class="col-sm-2 col-form-label">Skills</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputSkills" placeholder="Skill"> 
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>   
    </div>
    
        <!-- jQuery -->
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