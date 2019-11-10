$(document).ready(function(){
  loadData();
});

function loadData(){
  $.ajax({
    url: 'ajax_categories.php',
    method: 'GET',
    success: function (data){
      $('tbody').html(data);
    }
  });
}

function deleteThis(id){
    $.ajax({
      url: 'ajax_categories.php',
      method: 'POST',
      data:{
        delete: id
      },
      success: function (data){
        loadData();
      },
    });
  }
