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

  function modalShow(){
      $('#addmodal').modal('toggle');
  }

  function addCategory(){
    var newcategory = $('#categoryText').val();

    if(newcategory == ''){
      $('#categoryText').css('border', '1px solid red');
      $('#errorcheck1').html('Enter Category');
      $('#errorcheck1').css('color', 'red');
      return;
    }else{
      $('#categoryText').css('border', '');
      $('#errorcheck1').html('');
      $.ajax({
        url: 'ajax_categories.php',
        method: 'POST',
        data: {
          newcategory: newcategory
        },
        success: function (data){
          loadData();
          $('#addmodal').modal('toggle');
          $('#categoryText').val('');
        }
      });
    }
  }

  function editModal(id){
    //first AJAX for edit
    $.ajax({
      url: 'ajax_categories.php',
      method: 'POST',
      data:{
        edit: id
      },
      success: function(data){
        $('body').prepend(data);
        $('#editmodal').modal('toggle');
      },
      error: function(response){
        alert(response);
      }
    });
  }

  function editCategory(id){
    //second AJAX for edit
    var names = $('#categoryTextEdit').val();
    $.ajax({
      url: 'ajax_categories.php',
      method: 'POST',
      data:{
        edit2: id,
        names: names
      },
      success: function(){
        $("#editmodal").modal('toggle');
        $('#editmodal').detach()
          loadData();
      },
      error: function(response){
        alert(response);
      }
    });
  }
