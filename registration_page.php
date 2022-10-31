<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="assest/css/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="assest/css/adminlte.min.css">
        <!--<link rel="stylesheet" href="assest/css/icheck-bootstrap.min.css">-->
        <link rel="stylesheet" href="assest/css/additional.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> 
    </head>
    <body class="register-page">
      <?
      if(isset($_GET['response'])){
        ?>
        <p class='message'><?php echo $_GET['response'] ?></p>
        <?
      }
      ?>
         <div class="register-box">
            <div class="register-logo">
                <b>Registration Page</b>
            </div>
            <p class="login-box-msg">Register a new membership</p>
            <form action="" method="POST" id="Form" >
                <input type="hidden" id="user_id" name="user_id">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" id="user_name" name="user_name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" id="mailid" name="mailid">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <small id="emailvalid" class="form-text text-muted invalid-feedback">
                        Your email must be a valid email
                    </small> 
                </div>
                <div class="input-group mb-3">
                    <textarea class="form-control" placeholder="address" id="addres" name="addres"></textarea>
                </div>
                <div class="input-group mb-3">
                    <input type="tel" class="form-control" placeholder="Mobile no" id="phnno" name="phnno">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="passcode" name="passcode">
                    <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Retype password" id="re_passcode" name="re_passcode">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="icheck-primary">
                            
                        </div>
                    </div>   
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary btn-block" id="register" name="register" onclick="add()">Register</button>
                    </div>
                    <div class="col-3">
                        <a href="index.php" class="btn btn-primary btn-block">Back</a>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="assest/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="assest/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assest/dist/js/adminlte.min.js"></script>
        <script src="assest/js/register.js"></script>
        <script src="assest/js/image_access.js"></script>
    </body>
</html>