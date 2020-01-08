$(document).ready(function(){
  loadLikedData();
});

function loadLikeCount(){
  $.ajax({
    url: './parsers/trending_count.php',
    method: 'GET',
    success: function (data){
      $('#allLikes').html(data); // change
    }
  });
}

function loadLikedData(){
  $.ajax({
    url: './ajax_files/ajax_php_trending.php',
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
    url: './ajax_files/ajax_php_saved_hacks.php',
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
