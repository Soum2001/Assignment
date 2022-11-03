<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        body{
        background:#eee;
        }

        .bgWhite{
        background:white;
        box-shadow:0px 3px 6px 0px #cacaca;
      
        }

        .title{
        font-weight:600;
        margin-top:20px;
        font-size:24px
        }

        .customBtn{
        border-radius:0px;
        padding:10px;
        width:88px;
        
        }
        form input{
        display:inline-block;
        width:50px;
        height:50px;
        text-align:center;
        }
    </style>
</head>
<body>
<div class="container">
  <div class="row justify-content-md-center">
      <div class="col-md-4 text-center">
        <div class="row">
          <div class="col-sm-12 mt-5 bgWhite">
            <div class="title">
              Verify OTP
            </div>
            
            <form >
                <div class="row">
                    <div class="col-sm-12">
                        <input class="otp" type="text" id="otp_dig1" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1 >
                        <input class="otp" type="text" id="otp_dig2" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1 >
                        <input class="otp" type="text" id="otp_dig3" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1 >
                        <input class="otp" type="text" id="otp_dig4" oninput='digitValidate(this)'onkeyup='tabChange(4)' maxlength=1 >
                        <input class="otp" type="text" id="otp_dig5" oninput='digitValidate(this)' onkeyup='tabChange(5)' maxlength=1 >
                        <input class="otp" type="text" id="otp_dig6" oninput='digitValidate(this)'onkeyup='tabChange(6)' maxlength=1 >
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" value="verify"  class='btn btn-primary btn-block mt-4 mb-4 customBtn' onclick="verify_otp()">
                    </div>
                </div>
            </form>
            
            
          </div>
        </div>
      </div>
  </div>
</div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/js/getotp.js"></script>
</body>
</html>