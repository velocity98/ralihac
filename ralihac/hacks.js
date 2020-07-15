function hackModal(hackId){
  window.location.href = "h.php?hid="+hackId;
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
        $(function() {
          $('#allLikeButton'+id).removeClass('text-secondary').addClass('text-primary');
          $('#allLikeCount'+id).text(likeCount + 1);

        });
      }
      else if(data == 'unliked') {
        $(function() {
            $('#allLikeButton'+id).removeClass('text-primary').addClass('text-secondary');
            $('#allLikeCount'+id).text(likeCount - 1);

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
        $(function() {
          $('#allSaveButton'+id).removeClass('text-secondary').addClass('text-success');
          $('#allSaveStatus'+id).html(' Saved');

        });
      }
      else if(data == 'removed') {
        $(function() {
            $('#allSaveButton'+id).removeClass('text-success').addClass('text-secondary');
            $('#allSaveStatus'+id).html(' Save');

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

function randomize(){
  $.ajax({
    url: './ajax_files/ajax_php_randomize.php',
    type: 'GET',
    success: function(data){
      window.location.href = "h.php?hid="+data;
    }
  });
}

$(function () {
  $('[data-toggle="popover"]').popover()
})

function deleteHackModal(hackId){
  $.ajax({
    url: './parsers/delete_modal.php',
    type: 'POST',
    data:
      {
        id: hackId
      },
    success: function(response){
      $('#required').prepend(response);
      $('#deleteModal').modal('show');
    }
  });
}

function deleteHack(hackId){
  $.ajax({
    url: './ajax_files/ajax_php_delete_hacks.php',
    type: 'POST',
    data:
      {
        id: hackId
      },
    success: function(response){
        window.location.href = "index.php";
    }
  });
}
