$(document).ready(function(){
  loadSavedData();
});

function loadSavedData(){
  $.ajax({
    url: 'ajax_view_saved.php',
    method: 'GET',
    success: function (data){
      $('.view-saved').html(data);
    }
  });
}

function mostLikeButton(id){
  let likeCount = parseInt($('#mostLikeCount'+id).text());
  $.ajax({
    url: 'ajax_php_like.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(data){
      if(data == 'liked'){
        $('#card-hack', function() {
          $('#mostLikeButton'+id).removeClass('text-secondary').addClass('text-primary');
          $('#mostLikeCount'+id).text(likeCount + 1);
        });
      }
      else if(data == 'unliked') {
        $('#card-hack', function() {
            $('#mostLikeButton'+id).removeClass('text-primary').addClass('text-secondary');
            $('#mostLikeCount'+id).text(likeCount - 1);
        });
      }
    }
  });
}

function mostSaveButton(id){
  $.ajax({
    url: 'ajax_php_saved_hacks.php',
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
        });
      }
    }
  });
}
