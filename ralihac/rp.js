// DOM
const email = document.forms["zform"]["email"];

// Div errors
const email_error = document.getElementById("email_error");

// Eventlister
email.addEventListener("blur", emailVerify, true);

// Validate
function forgotValidate(){
  if (email.value == ""){
        email.style.border = "1.3px solid red";
        email_error.textContent = "Enter Email";
        email.focus();
        return false;
  }
  var serializedData = $('#forgotForm').serialize();
  $.ajax({
    url: "./ajax_files/ajax_php_forgot_password.php",
    type: "POST",
    dataType: 'JSON',
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
      //    // remember to add error and success json objects
      //   if (data[0].success == 'Login'){
      //     $('#tableHolder tbody').empty();
      //     // try to make this a modal
      //   }
      alert(data);
     }
  });
  return false;
}

function emailVerify(){
  if (email.value != ""){
    email.style.border = "";
    email_error.innerHTML = "";
    return true;
  }
}
