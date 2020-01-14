$(document).ready(function(){
  loadSavedData();
  loadLikedData();
  loadLikeCount();
  loadSaveCount();
});

function loadLikeCount(){
  $.ajax({
    url: './parsers/like_count.php',
    method: 'GET',
    success: function (data){
      $('#allLikes').html(data); // change
    }
  });
}

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
    url: './ajax_files/ajax_view_saved.php',
    method: 'GET',
    success: function (data){
      $('.view-saved').html(data);
    }
  });
}

function loadLikedData(){
  $.ajax({
    url: './ajax_files/ajax_view_liked.php',
    method: 'GET',
    success: function (data){
      $('.view-liked').html(data);
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

function likeButton(id){
  let likeCount = parseInt($('#likeCount'+id).text());
  let mostLikeCount = parseInt($('#mostLikeCount'+id).text());
  $.ajax({
    url: './ajax_files/ajax_php_like.php',
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
            $('#likeCount'+id).text(mostLikeCount - 1);
            loadLikedData();
            $('#mostLikeButton'+id).removeClass('text-primary').addClass('text-secondary');
            $('#mostLikeCount'+id).text(mostLikeCount - 1);
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
    },
    error: function(data){
      alert(data);
    }
  });
}

function saveButton(id){
  $.ajax({
    url: './ajax_files/ajax_php_saved_hacks.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(data){
      if(data == 'saved'){
        $('#card-hack', function() {
          $('#saveButton'+id).removeClass('text-secondary').addClass('text-success');
          $('#saveStatus'+id).html(' Saved');
          loadSavedData();
            loadSaveCount();
        });
      }
      else if(data == 'removed') {
        $('#card-hack', function() {
            $('#saveButton'+id).removeClass('text-success').addClass('text-secondary');
            $('#saveStatus'+id).html(' Save');
            loadSavedData();
              loadSaveCount();
        });
      }
    }
  });
}
