$(document).ready(function (e) { // Ajax call for Image
  loadData();
  $("#uploadimage").on('submit',(function(e) {
    e.preventDefault();
    $("#message").empty();

    var hackTitle = $('#hack');
    var hackCategory = $('#categories');
    var hackDescription = $('#description');
    var noName = $('#noName');
    var noNameTwo = $('#noNameTwo');
    var noNameThree = $('#noNameThree');

    if(isNotEmpty(hackTitle, noName) && isNotEmpty(hackCategory, noNameTwo) && isNotEmpty(hackDescription, noNameThree)){
      $.ajax({
        url: "ajax_php_file.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
          {
            $("#message").html(data);
          }
      });
    }
  }));

  // Function to preview image after validation (Validation Only)
  $(function() {
    $("#file").change(function() {
      $("#message").empty();
      var file = this.files[0];
      var imagefile = file.type;
      var match = ["image/jpeg","image/jpg"];
      if(!((imagefile==match[0]) || (imagefile==match[1])))
        {
          $('#previewing').attr('src','../images/siteimages/no_image.png');
          $("#message").html("<br><p id='error' class='text-danger'>Please Select A valid Image File</p>"+"<h5 class='text-light'>Note:</h5>"+"<span id='error_message' class='text-light'>Only jpeg and jpg images type allowed</span>");
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



  $(document).on('mouseenter', '#card-hack', function() {
     $('#card-body', this).slideDown(100);
  });
  $(document).on('mouseleave', '#card-hack', function() {
      $('#card-body', this).slideUp(100);
  });

  $(document).on('keyup', '#descriptionEdit', function(){
    $('#descriptionChange').text($(this).val());
  });

  $(document).on('keyup', '#hackEdit', function(){
    $('#hackChange').text($(this).val());
  });


});

function loadData(){
  $.ajax({
    url: 'ajax_admin_hacks.php',
    method: 'GET',
    success: function (data){
      $('#hackView').html(data);
    }
  });
}

function deleteHack(id){
      $.confirm({
        title: 'Confirm!',
        content: 'Are you sure you want to delete this Hack?',
        buttons: {
            confirm: function () {
                $.ajax({
                url: 'ajax_admin_hacks.php',
                method: 'POST',
                data:{
                  delete: id
                },
                success: function (data){
                  loadData();
                  $.alert('Hack Deleted!');
                },
              });
            },
            cancel:{
              btnClass: 'btn-danger',
              action:
              function () {
              $.alert('Canceled!');
            }
            },
        }
    });
  }

  function editHack(id){
      $.ajax({
        url: 'ajax_admin_hacks.php',
        method: 'POST',
        data:{
          edit: id
        },
        success: function(data){
          $('body').prepend(data);
          $('#editModal').modal('toggle');
        },
        error: function(response){
          alert(response);
        }
      });
  }

  function isNotEmpty(call, name){
    if (call.val() == ''){
      call.css('border', '1px solid red');
      name.html('Enter Value');
      return false;
    }else{
      call.css('border', '');
      name.html('');
      return true;
    }
  }

  function editHackModal(id){
    var hackName = $('#hackEdit');
    var noNameOne = $('#noNameEdit');
    var hackCategory = $('#categoriesEdit');
    var noNameTwo = $('#noNameTwoEdit');
    var hackDescription = $('#descriptionEdit');
    var noNameThree = $('#noNameThreeEdit');
    if(isNotEmpty(hackName, noNameOne) && isNotEmpty(hackCategory, noNameTwo) && isNotEmpty(hackDescription, noNameThree)){
      $.ajax({
        url: 'ajax_admin_hacks.php',
        method: 'POST',
        data: {
          editFinal: id,
          hackEditName: hackName.val(),
          hackEditCategory: hackCategory.val(),
          hackEditDescription: hackDescription.val()
        },
        success: function(){
          loadData();
        },
        error: function(response){
          alert(response);
        }
      });
    }
  }

  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    if (fileName.length > 10){
      fileName = fileName.substring(0,21) + '...';
    }
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
