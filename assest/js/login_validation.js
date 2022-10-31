$(document).ready(function(){
      $("#passcheck").hide();
      let passwordError = true;
      $("#password").keyup(function () {
        validatePassword();
      });
   const email = document.getElementById("email");
  email.addEventListener("blur", () => {
    let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
    let s = email.value;
    if (regex.test(s)) {
      email.classList.remove("is-invalid");
      emailError = true;
    } else {
      email.classList.add("is-invalid");
      emailError = false;
    }
  });
  function validatePassword() {
    let passwordValue = $("#password").val();
    if (passwordValue.length == "") {
      $("#passcheck").show();
      passwordError = false;
      return false;
    }
    if (passwordValue.length < 3 || passwordValue.length > 10) {
      $("#passcheck").show();
      $("#passcheck").html(
        "**length of your password must be between 3 and 10"
      );
      $("#passcheck").css("color", "red");
      passwordError = false;
      return false;
    } else {
      $("#passcheck").hide();
    }
  }
  $("#login").click(function () {
    validatePassword();
    
    if (
      
      passwordError == true &&
     
      emailError == true
    ) {
      return true;
    } else {
      return false;
    }
  });
})