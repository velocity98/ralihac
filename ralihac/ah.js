// input dom
const hackTitle = $('#hack');
const hackCategory = $('#categories');
const hackDescription = $('#description');
const hackImage = $('#file');
// error dom
const noName = $('#noName');
const noNameTwo = $('#noNameTwo');
const noNameThree = $('#noNameThree');
const noImage = $('#noImage');

// E-listener
hackTitle.on('blur', function(){
  if (hackTitle.val() != ''){
    hackTitle.css('border','');
    noName.html('');
    return true;
  }
});

hackCategory.on('blur', function(){
  if (hackCategory.val() != ''){
    hackCategory.css('border','');
    noNameTwo.html('');
  }
});

hackDescription.on('blur', function(){
  if (hackDescription.val() != ''){
    hackDescription.css('border', '');
    noNameThree.html('');
    return true;
  }
});
hackImage.on('change', function(){
  if (hackImage.val() != ''){
    $('#customFile').css('border', '');
    noImage.html('');
    return true;
  }
});

$(document).ready(function (e) { // Ajax call for Image
  $("#uploadimage").on('submit',(function(e) {
    e.preventDefault();
    $("#message").empty();

    if (hackTitle.val() == "" || hackCategory.val() == "" || hackDescription.val() == "" || hackImage.val() == ""){
      var variables = [hackTitle, hackCategory, hackDescription, $('#previewing')];
      var errors = [noName, noNameTwo, noNameThree, noImage];
      var countErrors = [];

      for(i = 0; i < variables.length; i++){
        if (variables[i].val() == ""){
          variables[i].css('border', '1.3px solid red');
            switch (i){
              case 0:
                  errors[i].html('Enter Title');
                  break;
              case 1:
                  errors[i].html('Enter Category');
                  break;
              case 2:
                  errors[i].html('Enter Description');
                  break;
              case 3:
                  errors[i].html('Enter Image File');
                  break;
            }
          variables[i].focus();
          countErrors.push(i);
        }
      }
      if(countErrors.length > 0){
          return false;
      }else{
        // nothing yet
      }
    }

    // if(isNotEmpty(hackTitle, noName) && isNotEmpty(hackCategory, noNameTwo) && isNotEmpty(hackDescription, noNameThree)){
    //   $.ajax({
    //     url: "ajax_php_file.php",
    //     type: "POST",
    //     data: new FormData(this),
    //     contentType: false,
    //     cache: false,
    //     processData:false,
    //     success: function(data)
    //       {
    //         $("#message").html(data);
    //       }
    //   });
    // }

  }));

  // Function to preview image after chosen file
  $(function() {
    $("#file").change(function() {
      $("#message").empty();
      var file = this.files[0];
      var imagefile = file.type;
      var match = ["image/jpeg","image/jpg"];
      if(!((imagefile==match[0]) || (imagefile==match[1])))
        {
          $('#previewing').attr('src','./images/siteimages/no_image.png');
          $("#message").html("<small id='error' class='text-danger'>Please Select A valid Image File</small>"+"<br><small id='error_message' class='text-danger'>Only jpeg and jpg images type allowed</small>");
          $('#previewing').css('border', '1.3px solid red');
          return false;
        }
      else
        {
          var reader = new FileReader();
          reader.onload = imageIsLoaded;
          reader.readAsDataURL(this.files[0]);
        }
    });
  });

  function imageIsLoaded(e) {
    $("#file").css("color","green");
    $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '250px');
    $('#previewing').attr('height', '230px');
  };

  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    if (fileName.length > 10){
      fileName = fileName.substring(0,21) + '...';
    }
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
});
