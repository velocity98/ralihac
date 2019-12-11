// DOM
const username = document.forms["vform"]["username"];
const password = document.forms["vform"]["password"];

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
