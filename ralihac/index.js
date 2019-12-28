function likeButton(id){
  let likeCount = parseInt($('#likeCount'+id).text());
  $.ajax({
    url: 'ajax_php_like.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(data){
      if(data == 'liked'){
        $('#card-hack', function() {
          $('#likeButton'+id).removeClass('text-secondary').addClass('text-primary');
          $('#likeCount'+id).text(likeCount + 1);
        });
      }
      else if(data == 'unliked') {
        $('#card-hack', function() {
            $('#likeButton'+id).removeClass('text-primary').addClass('text-secondary');
            $('#likeCount'+id).text(likeCount - 1);
        });
      }
    }
  });
}

function saveButton(id){
  $.ajax({
    url: 'ajax_php_saved_hacks.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(data){
      if(data == 'saved'){
        $('#card-hack', function() {
          $('#saveButton'+id).removeClass('text-secondary').addClass('text-success');
          $('#saveStatus'+id).html(' Saved');
        });
      }
      else if(data == 'removed') {
        $('#card-hack', function() {
            $('#saveButton'+id).removeClass('text-success').addClass('text-secondary');
            $('#saveStatus'+id).html(' Save');
        });
      }
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
          $('#mostSaveButton'+id).removeClass('text-secondary').addClass('text-success');
          $('#mostSaveStatus'+id).html(' Saved');
        });
      }
      else if(data == 'removed') {
        $('#card-hack', function() {
            $('#mostSaveButton'+id).removeClass('text-success').addClass('text-secondary');
            $('#mostSaveStatus'+id).html(' Save');
        });
      }
    }
  });
}
