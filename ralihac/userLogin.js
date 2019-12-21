// DOM
const username = document.forms["xform"]["username"];
const password = document.forms["xform"]["password"];

// Div errors
const user_error = document.getElementById("user_error");
const password_error = document.getElementById("password_error");
const both_error = document.getElementById("both_error")

// Eventlister
username.addEventListener("blur", userVerify, true);
password.addEventListener("blur", passVerify, true);

// Validate
function user_validate(){
  if (username.value == "" || password.value == ""){
    var variables = [username, password];
    var errors = [user_error, password_error];
    var countErrors = [];

    for(i = 0; i < variables.length; i++){
      if (variables[i].value == ""){
        variables[i].style.border = "1.3px solid red";
          switch (i){
            case 0:
                errors[i].textContent = "Enter Username";
                break;
            case 1:
                errors[i].textContent = "Enter Password";
                break;
          }
        variables[i].focus();
        countErrors.push(i);
      }
    }
    if(countErrors.length > 0){
        return false;
    }
  }
  var serializedData = $('#userLoginForm').serialize();
  $.ajax({
    url: "ajax_php_login.php",
    type: "POST",
    dataType: 'JSON',
    data: serializedData,
    success: function(data)
      {
      $('#tableHolder tbody').empty();
       var length = data.length;
         for(i = 0; i < length; i++){

             var error = data[i].error;
             var tr = '<tr><td><div class="container"><i class="fas fa-exclamation-circle"></i><span class="align-middle" style="padding:5px">'+error+'</span></div></td></tr>';
             $('#tableHolder tbody').append(tr);
             $('#tableHolder tbody tr td div').css({
               'margin-bottom' : '10px',
               'background-color' : '#FDA0A0',
               'border-radius' : '3px',
               'border-style' : 'solid',
               'border-color' : 'red',
               'border-width' : '1px',

             });

         }

        if (data[0].success == 'Login'){
          $('#tableHolder tbody').empty();
          window.location = "index.php";
        }
     }
  });
  return false;
}

function userVerify(){
  if (username.value != ""){
    username.style.border = "";
    user_error.innerHTML = "";
    return true;
  }
}

function passVerify(){
  if (password.value != ""){
    password.style.border = "";
    password_error.innerHTML = "";
    return true;
  }
}
