// DOM
const username = document.forms["cform"]["username"];
const password = document.forms["cform"]["password"];
const confirmPassword = document.forms["cform"]["confirmPassword"];
const email = document.forms["cform"]["email"];

// Div errors
const user_error = document.getElementById("user_error");
const password_error = document.getElementById("password_error");
const confirmPassword_error = document.getElementById("confirmPassword_error");
const email_error = document.getElementById("email_error");

// Eventlister
username.addEventListener("blur", userVerify, true);
password.addEventListener("blur", passVerify, true);
confirmPassword.addEventListener("blur", confirmVerify, true);
email.addEventListener("blur", emailVerify, true);

// Validation with multiple combinations
function user_validate(){
  if (username.value == "" || password.value == "" || confirmPassword.value == "" || email.value == ""){
    var variables = [username, password, confirmPassword, email];
    var errors = [user_error, password_error, confirmPassword_error, email_error];
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
            case 2:
                errors[i].textContent = "Enter Confirm Password";
                break;
            case 3:
                errors[i].textContent = "Enter Email";
                break;
          }
        variables[i].focus();
        countErrors.push(i);
      }
    }
    if(countErrors.length > 0){
        return false;
    }else{
      return true;
    }
  }

  if(password.value != confirmPassword.value){
    confirmPassword.style.border = "1.3px solid red";
    confirmPassword_error.textContent = "Passwords do not match";
    return false;
  }
  else{
    return true;
  }
}

// clear error
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

function confirmVerify(){
  if (confirmPassword.value != ""){
    confirmPassword.style.border = "";
    confirmPassword_error.innerHTML = "";
    return true;
  }
}

function emailVerify(){
  if (email.value != ""){
    email.style.border = "";
    email_error.innerHTML = "";
    return true;
  }
}