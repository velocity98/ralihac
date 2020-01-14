function likeButton(id){
  let likeCount = parseInt($('#likeCount'+id).text());
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
            $('#likeCount'+id).text(likeCount - 1);
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
        });
      }
      else if(data == 'removed') {
        $('#card-hack', function() {
            $('#saveButton'+id).removeClass('text-success').addClass('text-secondary');
            $('#saveStatus'+id).html(' Save');
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

$('#owl-two').owlCarousel({
    loop: false,
    navRewind: false,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    },
    onTranslated:callBackTwo
})

$('#owl-three').owlCarousel({
    loop: false,
    navRewind: false,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    },
    onTranslated:callBack
})

$(document).ready(function(){
  $('.owl-prev').attr('disabled', 'disabled');
  $('.owl-prev').css('cursor', 'default');
  $('.owl-prev-two').attr('disabled', 'disabled');
  $('.owl-prev-two').css('cursor', 'default');
});

function callBack(){
  if($('#owl-three .owl-item').last().hasClass('active')){
        $('.owl-next').attr('disabled', 'disabled');
        $('.owl-next').css('cursor', 'default');
     }else{
       $('.owl-next').removeAttr('disabled', 'disabled');
       $('.owl-next').css('cursor', 'pointer');
     }

 if($('#owl-three .owl-item').first().hasClass('active')){
      $('.owl-prev').attr('disabled', 'disabled');
      $('.owl-prev').css('cursor', 'default');
     }else{
      $('.owl-prev').removeAttr('disabled', 'disabled');
      $('.owl-prev').css('cursor', 'pointer');
     }
}

function callBackTwo(){
  if($('#owl-two .owl-item').last().hasClass('active')){
        $('.owl-next-two').attr('disabled', 'disabled');
        $('.owl-next-two').css('cursor', 'default');
     }else{
       $('.owl-next-two').removeAttr('disabled', 'disabled');
       $('.owl-next-two').css('cursor', 'pointer');
     }

 if($('#owl-two .owl-item').first().hasClass('active')){
      $('.owl-prev-two').attr('disabled', 'disabled');
      $('.owl-prev-two').css('cursor', 'default');
     }else{
      $('.owl-prev-two').removeAttr('disabled', 'disabled');
      $('.owl-prev-two').css('cursor', 'pointer');
     }
}


var owl3 = $('#owl-three');

// Go to the next item
$('.owl-next').click(function() {
       owl3.trigger('next.owl.carousel');
})
// Go to the previous item
$('.owl-prev').click(function() {
        owl3.trigger('prev.owl.carousel');
})

var owl2 = $('#owl-two');

$('.owl-next-two').click(function() {
       owl2.trigger('next.owl.carousel');
})
// Go to the previous item
$('.owl-prev-two').click(function() {
        owl2.trigger('prev.owl.carousel');
})
