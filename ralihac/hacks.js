function hackModal(hackId){
  $.ajax({
    url: './parsers/hack_modal.php',
    method: 'POST',
    data: {
      hackId: hackId
    },
    success: function(data){
      $('#hackModalPlacement').prepend(data);
      $('#hackModal').modal('show');
    }
  });
}

function allLikeButton(id){
  let likeCount = parseInt($('#allLikeCount'+id).text());
  $.ajax({
    url: './ajax_files/ajax_php_like.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(data){
      if(data == 'liked'){
        $('#card-hack', function() {
          $('#allLikeButton'+id).removeClass('text-secondary').addClass('text-primary');
          $('#allLikeCount'+id).text(likeCount + 1);
          $('#likeButton'+id).removeClass('text-secondary').addClass('text-primary');
          $('#likeCount'+id).text(likeCount + 1);
          $('#mostLikeButton'+id).removeClass('text-secondary').addClass('text-primary');
          $('#mostLikeCount'+id).text(likeCount + 1);
        });
      }
      else if(data == 'unliked') {
        $('#card-hack', function() {
            $('#allLikeButton'+id).removeClass('text-primary').addClass('text-secondary');
            $('#allLikeCount'+id).text(likeCount - 1);
            $('#mostLikeButton'+id).removeClass('text-primary').addClass('text-secondary');
            $('#mostLikeCount'+id).text(likeCount - 1);
            $('#likeButton'+id).removeClass('text-primary').addClass('text-secondary');
            $('#likeCount'+id).text(likeCount - 1);
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
    },
    error: function(data){
      alert(data);
    }
  });
}
function allSaveButton(id){
  $.ajax({
    url: './ajax_files/ajax_php_saved_hacks.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(data){
      if(data == 'saved'){
        $('#card-hack', function() {
          $('#allSaveButton'+id).removeClass('text-secondary').addClass('text-success');
          $('#allSaveStatus'+id).html(' Saved');
          $('#mostSaveButton'+id).removeClass('text-secondary').addClass('text-success');
          $('#mostSaveStatus'+id).html(' Saved');
          $('#saveButton'+id).removeClass('text-secondary').addClass('text-success');
          $('#saveStatus'+id).html(' Saved');
        });
      }
      else if(data == 'removed') {
        $('#card-hack', function() {
            $('#allSaveButton'+id).removeClass('text-success').addClass('text-secondary');
            $('#allSaveStatus'+id).html(' Save');
            $('#mostSaveButton'+id).removeClass('text-success').addClass('text-secondary');
            $('#mostSaveStatus'+id).html(' Save');
            $('#saveButton'+id).removeClass('text-success').addClass('text-secondary');
            $('#saveStatus'+id).html(' Save');
        });
      }
      else if(data == 'saveModal'){
        // modal for like only with acc
        $.ajax({
          url: './parsers/modal_login_require.php',
          type: 'POST',
          data: {
            method: data,
          },
          success: function (response){
            $('#required').prepend(response);
            $('#saveModal').modal('show');
          }
        });
      }
    }
  });
}
