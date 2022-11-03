<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- CSS only -->
        <?include 'header.php'?>
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
      <?include 'footer.php'?>
    </body>
</html>