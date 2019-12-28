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

$('#delete').alert({
    title: 'Alert!',
    content: 'Simple alert!',
});

function deleteThis(id){
      $.confirm({
        title: 'Confirm!',
        content: 'Are you sure you want to delete this category?',
        buttons: {
            confirm: function () {
                $.ajax({
                url: 'ajax_categories.php',
                method: 'POST',
                data:{
                  delete: id
                },
                success: function (data){
                  loadData();
                  $.alert('Category Deleted!');
                },
              });

            },
            cancel:{
              btnClass: 'btn-danger',
              action:
              function () {
              $.alert('Canceled!');
            }


            },
        }
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
    if(names == ''){
      $('#categoryTextEdit').css('border', '1px solid red');
      $('#errorcheck2').html('Enter Category');
      return;
    }else{
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
  }
