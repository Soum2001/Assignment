<!DOCTYPE html>
<html lang="en">
<head>
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!------ Include the above in your HEAD tag ---------->

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="assest/css/additional.css">
 <div class="form-gap"></div>
    <title>Document</title>
    
</head>
<body>
<div class="form-gap">
    <?
 
      if(isset($_GET['response_id'])){
        if($_GET['response_id']==1)
        {
        ?>
        <p class='message'>Password Changed</p>
        <?
        }
        else if($_GET['response_id']==2){
          ?>
            <p class='errorMsg'>Password Not set.Try again</p>
          <?
        }
      }
      ?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Reset Password</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="reset_password_form" role="form" autocomplete="off" class="form" action="confirm_password.php" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input id="chng_password" name="chng_password" placeholder="change password" class="form-control"  type="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input id="confirm_password" name="confirm_password" placeholder="confirm password" class="form-control"  type="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
<!-- JavaScript Bundle with Popper -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>
