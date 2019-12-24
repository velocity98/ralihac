function likeButton(id){
  $.ajax({
    url: 'ajax_php_like.php',
    type: 'POST',
    data: {
      id: id
    },
    success: function(data){
      alert(data);
    },
    error: function(data){
      alert(data);
    }
  });
}
