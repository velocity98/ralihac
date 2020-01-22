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
