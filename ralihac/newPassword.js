// DOM
const password = document.forms["zform"]["password"];
const confirmPassword = document.forms["zform"]["confirmPassword"];

// Div errors

const password_error = document.getElementById("password_error");
const confirm_password_error = document.getElementById("confirm_password_error");

// Eventlister
confirmPassword.addEventListener("blur", confirmPassVerify, true);
password.addEventListener("blur", passVerify, true);

// Validate
function resetValidate(){

  if (confirmPassword.value == "" || password.value == ""){

    var variables = [password, confirmPassword];
    var errors = [password_error, confirm_password_error];
    var countErrors = [];

    for(i = 0; i < variables.length; i++){

      if (variables[i].value == ""){

        variables[i].style.border = "1.3px solid red";
          switch (i){

            case 0:
                errors[i].textContent = "Enter your New Password";
                break;
            case 1:
                errors[i].textContent = "Enter your Confirmed Password";
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


  if(password.value != confirmPassword.value){

    confirmPassword.style.border = "1.3px solid red";
    confirm_password_error.textContent = "Passwords do not match";
    return false;

  }else{

    var serializedData = $('#resetForm').serialize();
    $.ajax({
      url: "./ajax_files/ajax_php_reset_password.php",
      type: "POST",
      data: serializedData,
      success: function(data)
        {
        // $('#tableHolder tbody').empty();
        //  var length = data.length;
        //    for(i = 0; i < length; i++){
        //        var error = data[i].error;
        //        var tr = '<tr><td><div class="container"><i class="fas fa-exclamation-circle"></i><span class="align-middle" style="padding:5px">'+error+'</span></div></td></tr>';
        //        $('#tableHolder tbody').append(tr);
        //        $('#tableHolder tbody tr td div').css({
        //          'margin-bottom' : '10px',
        //          'background-color' : '#FDA0A0',
        //          'border-radius' : '3px',
        //          'border-style' : 'solid',
        //          'border-color' : 'red',
        //          'border-width' : '1px',
        //        });
        //    }
        //   if (data[0].success == 'Login'){
        //     $('#tableHolder tbody').empty();
        //     window.location = "index.php";
        //   }
        alert(data);
      }
    });
    return false;

  }

}

function confirmPassVerify(){

  if (confirmPassword.value != ""){

    confirmPassword.style.border = "";
    confirm_password_error.innerHTML = "";
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
