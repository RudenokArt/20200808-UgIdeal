
// ========== ACTIONS ===========
cartDataAjax();
cartDataClean();


// ========== LISTNERS ===========
$('body').delegate('input[name="order_add"]','click', function () {
  amountCheck(this);
});

$('body').delegate('button[name="item_edit"]','click', function () {
  var itemId = this.value;
  var constructor = '';
  cartDataClean().forEach( function(element, index) {
    if (element[0]==itemId) {
      constructor = element[0]+'|'+
      element[1].image+'|'+
      element[1].imageName+'|'+
      element[1].category+'|'+
      element[1].subcategory+'|'+
      ''+'|'+
      element[1].discount;
    }
  });
  localStorage.setItem('wallpaper_constructor', constructor);
  document.location.href='constructor.php';
});

$('body').delegate('button[name="item_delete"]', 'click', function () {
  var delId = this.value;
  var arr = JSON.parse(localStorage.getItem('wallpaper'));
  arr.forEach( function(element, index) {
    var itemId = arr[index].split('|')[0];
    if (itemId == delId) {
      arr.splice(index, 1);
    }
  });
  var json = JSON.stringify(arr);
  localStorage.setItem('wallpaper', json);
  cartDataAjax();
});

$('#order_link').click(function () {
  var arr = $('input[name="order_add"]');
  var checkedArr = [];
  for (var i = 0; i < arr.length; i++) {
    if (arr[i].checked) {
      checkedArr.push(arr[i].value);
    }
  }
  orderData(checkedArr);
});

// ========== FUNCTIONS ===========
function checkboxChecked () {
  var arr = $('input[name="order_add"]');
  for (var i = arr.length - 1; i >= 0; i--) {
    if(arr[i].checked){
      $(arr[i]).siblings('span').children('i').fadeIn();
    } else {
      $(arr[i]).siblings('span').children('i').fadeOut();
    }
  }
}

function amountCheck (item) {
  var arr = cartDataClean();
  var flag = false;
  arr.forEach( function(element, index) {
    if (element[1].amountDiscount>0 && element[0]==item.value) { 
      flag = true; 
    }
  });
  if (!flag) {
    item.checked = false; 
    alert('Добавление в заказ не возможно! Не указана сумма! Отредактируйте элемент.');
  }
  checkboxChecked();
}

function getCartData () {
  var cart = JSON.parse(localStorage.getItem('wallpaper'));
  cart = cartDataExplode(cart);
  var order = JSON.parse(localStorage.getItem('wallpaper_cart'));
  return [cart,order];
}

function cartDataExplode (cart) {
  var arr = [];
  cart.forEach( function(element, index) {
    var subArr = element.split('|');
    arr.push(subArr);
  });
  return arr;
}

function cartDataNormalize () {
  var cart =getCartData()[0];
  var order = getCartData()[1];
  if (getCartData()[1]==null) {order = [];}
  cart.forEach( function(cart_element, cart_index) {
    var flag = false;
    order.forEach( function(order_element, order_index) {
      if (cart_element[0] == order_element[0]) { flag = true;}
    });
    if (!flag) { 
      var arr = [ cart_element[0], {
        image: cart_element[1],
        imageName: cart_element[2],
        category: cart_element[3],
        subcategory: cart_element[4],
        discount:cart_element[6],
      }];
      order.push(arr);
    }
  });
  return [cart,order];
}

function cartDataClean () {
  var cart =cartDataNormalize()[0];
  var order = cartDataNormalize()[1];
  order.forEach( function(order_element, order_index) {
    var flag = false;
    cart.forEach( function(cart_element, cart_index) {
      if (order_element[0] == cart_element[0]) { flag = true; }
    });
    if (!flag) {
      order.splice(order_index, 1);
    }
  });
  return(order);
}

function cartDataAjax () {
  var arr = cartDataClean();
  var json = JSON.stringify(arr);
  $.post('php/cart_item_data.php', {data:json}, function (data) {
    var node = document.getElementById('cart_container');
    node.innerHTML = data;
    checkboxChecked();
  }); 
}

function orderData (checkedArr) {
  if (checkedArr<1){alert('Не выбрано ни одного элемента!');}

  else {
    var json = localStorage.getItem('wallpaper_cart');
    var wholeArr = JSON.parse(json);
    var arr=[];
    wholeArr.forEach( function(element, index) {
      checkedArr.forEach( function(subelement, subindex) {
        if (subelement == element[0]) {
          arr.push(element);
        }
      });
    });
    localStorage.setItem('wallpaper_order', JSON.stringify(arr));
    console.log(localStorage.getItem('wallpaper_order'));
    document.location.href = 'order.php';
  }
}