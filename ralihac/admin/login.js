// DOM
const username = document.forms["vform"]["username"];
const password = document.forms["vform"]["password"];

// Div errors
const user_error = document.getElementById("user_error");
const password_error = document.getElementById("password_error");

// Eventlister
username.addEventListener("blur", userVerify, true);
password.addEventListener("blur", passVerify, true);

// Validate
function user_validate(){
  if (username.value == "" && password.value == ""){
    username.style.border = "1.3px solid red";
    user_error.textContent = "Enter Username";
    username.focus();
    password.style.border = "1.3px solid red";
    password_error.textContent = "Enter Password";
    password.focus();
    return false;
  }

  if (username.value == ""){
    username.style.border = "1.3px solid red";
    user_error.textContent = "Enter Username";
    username.focus();
    return false;
  }
  if (password.value == ""){
    password.style.border = "1.3px solid red";
    password_error.textContent = "Enter Password";
    password.focus();
    return false;
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
