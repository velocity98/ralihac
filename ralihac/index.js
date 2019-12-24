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
