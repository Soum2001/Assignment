<?
// if( $_SERVER['HTTP_REFERER']==index.php)
// {
//   header('loaction:forget_password.php');
// }
// else{
//   header('loaction:index.php');
// }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<?include 'header.php'?>
<style>
  .form-gap {
    padding-top: 70px;
}
</style>
  
</head>
<body>
</div>
<div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
          <?  
            if(isset($_GET['response_id'])){
              if($_GET['response_id']==0)
              {
              ?>
              <p class='errorMsg'>You are not registered user or Put a valid mail id.</p>
              <?
              }
              
            }
            ?>
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>Mention email to send OTP.</p>
                  <div class="panel-body">
    
                    <form id="reset_password_form" role="form" autocomplete="off" class="form" action="check_email.php" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="otp_email" name="otp_email" placeholder="email address" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Send OTP" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
<!-- JavaScript Bundle with Popper -->
<?include 'footer.php'?>
</body>
</html>