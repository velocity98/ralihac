$(document).ready(function(){
  loadSavedData();
  loadSaveCount();
});

function loadSaveCount(){
  $.ajax({
    url: './parsers/save_count.php',
    method: 'GET',
    success: function (data){
      $('#allSaves').html(data); // change
    }
  });
}

function loadSavedData(){
  $.ajax({
    url: './ajax_files/ajax_php_only_saved.php',
    method: 'GET',
    success: function (data){
      $('.view-saved').html(data);
    }
  });
}


function mostLikeButton(id){
  let likeCount = parseInt($('#mostLikeCount'+id).text());
  $.ajax({
    url: './ajax_files/ajax_php_like.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(data){
      if(data == 'liked'){
        $('#card-hack', function() {
          $('#mostLikeButton'+id).removeClass('text-secondary').addClass('text-primary');
          $('#mostLikeCount'+id).text(likeCount + 1);
          loadLikedData();
            loadLikeCount();
        });
      }
      else if(data == 'unliked') {
        $('#card-hack', function() {
            $('#mostLikeButton'+id).removeClass('text-primary').addClass('text-secondary');
            $('#mostLikeCount'+id).text(likeCount - 1);
            loadLikedData();
              loadLikeCount();
        });
      }
      else if(data == 'likeModal'){
        // modal for like only with acc
        $.ajax({
          url: './parsers/modal_login_require.php',
          type: 'POST',
          data: {
            method: data,
          },
          success: function (response){
            $('#required').prepend(response);
            $('#likeModal').modal('show');
          }
        });
      }
    }
  });
}

function mostSaveButton(id){
  $.ajax({
    url: './ajax_files/ajax_php_saved_hacks.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(data){
      if(data == 'saved'){
        $('#card-hack', function() {
          $('#mostSaveButton'+id).removeClass('text-secondary').addClass('text-danger');
          $('#mostSaveStatus'+id).html(' Saved');
        });
      }
      else if(data == 'removed') {
        $('#card-hack', function() {
            $('#mostSaveButton'+id).removeClass('text-danger').addClass('text-secondary');
            $('#mostSaveStatus'+id).html(' Save');
            loadSavedData();
            $('#saveButton'+id).removeClass('text-success').addClass('text-secondary');
            $('#saveStatus'+id).html(' Save');
              loadSaveCount();
        });
      }
    }
  });
}
