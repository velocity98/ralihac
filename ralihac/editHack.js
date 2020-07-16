var hackName = document.forms["editForm"]["hackName"];
var hackCategory = document.forms["editForm"]["hackCategory"];
var hackDescrption = document.forms["editForm"]["hackDescrption"];

var hackNameError = document.getElementById("hackNameError");
var hackCategoryError = document.getElementById("hackCategoryError");
var hackDescrptionError = document.getElementById("hackDescrptionError");


function hackNameVerify(){
  if (hackName.value != ""){
    hackName.style.border = "";
    hackNameError.innerHTML = "";
    return true;
  }
}
function hackCategoryVerify(){
  if (hackCategory.value != ""){
    hackCategory.style.border = "";
    hackCategoryError.innerHTML = "";
    return true;
  }
}
function hackDescrptionVerify(){
  if (hackDescrption.value != ""){
    hackDescrption.style.border = "";
    hackDescrptionError.innerHTML = "";
    return true;
  }
}

hackName.addEventListener("blur", hackNameVerify, true);
hackCategory.addEventListener("blur", hackCategoryVerify, true);
hackDescrption.addEventListener("blur", hackDescrptionVerify, true);


function editHack(hackId){ //reusable

  if (hackName.value == "" || hackCategory.value == "" || hackDescrption.value == "" ){
    var variables = [hackName, hackCategory, hackDescrption];
    var errors = [hackNameError, hackCategoryError, hackDescrptionError];
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
          }
        variables[i].focus();
        countErrors.push(i);
      }
    }
    if(countErrors.length > 0){
        return false;
    }
    else if(countErrors.length = 0){
      $.ajax({
        url: '.ajax_files/ajax_php_edit_hacks.php',
        type: 'POST',
        data:
          {
            id: hackId
          },
        success: function(response){

        }
      });
    }
    }
  }
