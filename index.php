
<html>
    <head>
        <!-- CSS only-->
    <?include 'header.php'?>
    </head>
    <body class="register-page">
      <?
      if(isset($_GET['err_response'])){
        if($_GET['err_response']==0)
        {
        ?>
        <p class='errorMsg'>Inavalid  Credential</p>
        <?
        }
      }
      ?>
    
        <div class="login-box">
        <div class="card-body">
        <div class="card card-outer card-primary">
            <div class="card-hearder text-center">
                <b>ADMIN</b>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="login.php" method="POST">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" class="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <small id="emailvalid" class="form-text
                        text-muted invalid-feedback">
                                Your email must be a valid email
                            </small> 
                    </div>
                    
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" class="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <h5 id="passcheck" style="color: red;">
                        **Enter a password
                    </h5>
                    <div class="row">
                        <div class="col-8">
                        <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                        Remember Me
                        </label>
                        </div>
                        </div>
                        
                        <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                        </div>
                        
                    </div>
                </form>
                <p class="mb-0">
                    <a href="registration_page.php" class="text-center">Register a new membership</a>
                </p>
                <p class="mb-0">
                    <a href="forget_password.php" class="text-center">Forget password</a>
                </p>
            </div>  
        </div>
        </div>
        </div>
       <?include 'footer.php'?>
            
    </body>
</html> 