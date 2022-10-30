var json = localStorage.getItem('wallpaper_order');
$.post('php/order_image.php', {data:json}, function (data) {
  $('#order_prewiew_image').html('<img src="user_download/order.jpg" alt=" ">');
  console.log(data);
}); 

// ===== LISTENERS =====

$('button[name="user_data_form"]').click(function (e) {
  e.preventDefault();
  var flag = true;
  var arr = $('#user_data_form input[type="text"]');
  for (var i = 0; i < arr.length; i++) {
    if (arr[i].value == ''){flag = false;}
  }
  if (!flag) {alert('Заполните все поля формы!');}
  else {$('#user_data_form')[0].submit();}
});

$('button[name="order_button"]').click(function (e) {
  e.preventDefault();
  localStorage.removeItem('wallpaper_constructor');
  localStorage.removeItem('wallpaper_order');
  localStorage.removeItem('wallpaper');
  localStorage.removeItem('wallpaper_cart');
  document.getElementById('order_send').submit();
});



// ===== JQUERY-UI =====

$(document).ready(function(){   
  $('input[name="user_email"]').inputmask("email");
});

$('input[name="user_phone"]').mask("+7(999) 999-9999");


console.log(localStorage);