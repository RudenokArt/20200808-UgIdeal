// ===== GLOBALS =====
var navigation={
  category:'empty',
  subcategory:'empty',
};
var modular={};
var page={};
var buscket={};
if (!localStorage.modular) {
  localStorage.setItem('modular', '{}');
}
buscket=JSON.parse(localStorage.modular);


// ===== LISTENERS & ACTIONS =====
$('.modular-sidebar_category').click(categoryExpander);
$('.modular-sidebar_subcategory').click(subcategorySet);
$('.modular-navigation span').click(navigationClick);
$('.category-select').change(categorySelect);
$('.subcategory-select').change(subcategorySelect);
filterResset();

$('.modulat-galery_item-cart input').click(function (e) {
  e.stopPropagation();
  favoriteAnime(this);
});
getFavoriteItems();
// $('.modulat-galery_item-cart input').change(cartItemCheck);
// $('.modulat-galery_item-cart input').prop('checked',false);
// setCheckbokses();
// cartCounter();

$('.modular-galery_item-wrapper').click(constructorTransfer);
$('.button-search').click(searchImage);
$('.number-page').click(setPageNumber);
$('.first-page').click(()=>{page.number=1;currentPage();});
$('.last-page').click(()=>{
  page.number=page.pages;
  currentPage();
});
$('.back-page').click(()=>{
  page.number=page.number-1;
  if (page.number<1) {page.number=1;}
  currentPage();
});
$('.next-page').click(()=>{
  page.number=page.number+1;
  if (page.number>page.pages) {page.number=page.pages;}
  currentPage();
});


// ===== FUNCTION =====
function categoryExpander () {
  var list=$(this).next();
  var visible=list[0].style.display;
  categoryRollup ();
  if (visible!='block'){$(list).slideToggle();}
  navigation.category=this.children[0].innerHTML;
  navigation.subcategory='empty';
  navigationSet();
  filterResset();
}
function categoryRollup () {
  var list=$('.modular-sidebar_category-list');
  $(list).slideUp();
}
function categorySelect () {
  navigation.category=this.value;
  navigation.subcategory='empty';
  navigationSet();
  categoryRollup();
  subcategorySelectData();
  filterGalery();
}
function filterGalery () {
  $('.modular-galery_item-wrapper').css({'display':'block'});
  var arr=$('.modular-galery_item-wrapper');
  for (var i = 0; i < arr.length; i++) {
    var subArr=(arr[i].id).split('|');
    if (navigation.category!='empty'&&
      navigation.category!=subArr[1]){
      arr[i].style.display='none';
  }
  if (navigation.subcategory!='empty'&&
    navigation.subcategory!=subArr[2]){
    arr[i].style.display='none';}}
  $.post('php-pagination-get.php',{data:''}, pageQuantity);
}
function subcategorySelect () {
  navigation.subcategory=this.value;
  navigationSet();
  categoryRollup();
  filterGalery();
}
function filterResset () {
  $('.category-select').prop('value','all'); 
  $('.subcategory-select').prop('value','all');
  subcategorySelectData();
  filterGalery();
}
function subcategorySelectData () {
  $('.subcategory-select').prop('value','all');
  var sql=
  'SELECT * FROM `constructor_subcategory` WHERE category="'+
  navigation.category+'"';
  $.post('php-index-ajax-select.php',{data:sql}, subcategorySelectSet);
}
function subcategorySelectSet (data) {
  var option=$('.subcategory-select_option');
  for (var i = 0; i < option.length; i++) {
    option[i].innerHTML='empty';
  }
  var subcategory=JSON.parse(data);
  for (var i = 0; i < subcategory.length; i++) {
    option[i].innerHTML=subcategory[i].subcategory;
  }
  subcategorySelectCat(option);
}
function subcategorySelectCat(option){
  for (var i = 0; i < option.length; i++) {
    if (option[i].innerHTML=='empty'){
      option[i].style.display='none';
    }else {
      option[i].style.display='block';
    }
  }
}
function subcategorySet () {
  navigation.subcategory=this.children[1].innerHTML;
  navigationSet();
  filterResset();
}
function navigationClick () {
  var nodeClass=$(this).parent().prop('className');
  if(nodeClass=='modular-navigation_root'){
    navigation.category='empty';
    navigation.subcategory='empty';
    categoryRollup();
  }
  if(nodeClass=='modular-navigation_category'){
    navigation.subcategory='empty';
  }
  navigationSet();
  filterResset();
}
function navigationSet () {
  var node=$('.modular-navigation div').children('span');
  node[1].innerHTML=navigation.category;
  node[2].innerHTML=navigation.subcategory;
  for (var i = 0; i < node.length; i++) {
    if (node[i].innerHTML=='empty') {
      $(node[i]).parent().css({'display':'none'});
    }else {
      $(node[i]).parent().css({'display':'block'});
    }
  }
}

function favoriteAnime (input) {
  node=$('.modular-cart_image');
  if (input.checked) {
    setTimeout(()=>{node.prop('className','modular-cart_image-show');},100);
    setTimeout(()=>{node.prop('className','modular-cart_image');},200);
  } 
  favoriteIcons(); 
}

function favoriteIcons () {
  var arr = $('.modulat-galery_item-cart input');
  var favoriteArr = [];
  for (var i = 0; i < arr.length; i++) {
    var icons=$(arr[i]).siblings();
    if (arr[i].checked) {
      $(icons[1]).fadeIn();
      $(icons[0]).fadeOut();
      favoriteArr.push(arr[i].value);
    } else {
      $(icons[0]).fadeIn();
      $(icons[1]).fadeOut();
    }
  }
  $('.modular-cart_counter').html(favoriteArr.length);
  var json = JSON.stringify({favorite: favoriteArr});
  localStorage.setItem('modular', json);
}

function getFavoriteItems () {
  var favoriteArr = JSON.parse(localStorage.getItem('modular')).favorite;
  var arr = $('.modulat-galery_item-cart input');
  for (var i = 0; i < arr.length; i++) {
    if (favoriteArr.includes(arr[i].value)) {
      arr[i].checked = true;
    } else {
      arr[i].checked = false;
    }
  }
  favoriteIcons();
  console.log(favoriteArr);
}

function constructorTransfer () {
  var arr=this.id.split('|');
  document.cookie='imageName='+arr[0];
  document.cookie='discount='+arr[4];
  document.location.href='constructor.php?imageName='+arr[0]+'&discount='+arr[4];
  console.log(document.cookie);
  localStorage.removeItem('editItem');
}
function searchImage () {
  var search=$('#searchInput').prop('value');
  $('.modular-galery_item-wrapper').css({'display':'block'});
  var arr=$('.modular-galery_item-wrapper');
  for (var i = 0; i < arr.length; i++) {
    var subArr=(arr[i].id).split('|');
    if (subArr[3].toLowerCase().includes(search.toLowerCase())) {
      arr[i].style.display='block';
    }else {
      arr[i].style.display='none';
    }
  }
}
function pageQuantity (data) {
  page.number=1;
  page.items=Number(data);
  var arr=$('.modular-galery_item-wrapper');
  page.baseArr=[];
  for (var i = 0; i < arr.length; i++) {
    if (arr[i].style.display=='block') {
      page.baseArr.push(arr[i]);
    }
  }
  currentPage();
}
function currentPage () {
  page.pages=Math.ceil(page.baseArr.length/page.items);
  lastItem=page.items*page.number;
  firstItem=lastItem-page.items;
  for (var i = 0; i < page.baseArr.length; i++) {
    if (i>=firstItem&&i<lastItem) {
      page.baseArr[i].style.display='block';
    }else{
      page.baseArr[i].style.display='none';
    }
  }
  pageNumeration();
}

function pageNumeration () {
  var arr=$('.number-page');
  $(arr).css({'display':'block','color':'black'});
  for (var i = 0; i < arr.length; i++) {
    var pageNumber=page.number-2+i;
    $(arr[i]).html(pageNumber);
    if (pageNumber<=0||pageNumber>page.pages) {arr[i].style.display='none';}
    if (pageNumber==page.number) {arr[i].style.color='red';}
  }
  window.scrollTo(pageYOffset, 0);
}

function setPageNumber () {
  page.number=Number($(this).html());
  currentPage();
}



// ===== FEEDBACK =====

$('.header-menu button').click(()=>{
  $('.header-bottom').slideUp();
})
$('.header-menu_button button').click(()=>{
  $('.header-bottom').slideDown();
})
$('.feedback-form button').click((e)=>{e.preventDefault()})
$('.feedback-form button').click(feedBackFormCheck);

function feedBackFormCheck () {
  var feedbackArr = $('.feedback-form input, .feedback-form textarea');
  var check=true;
  for (var i = 0; i < feedbackArr.length; i++) {
    if (feedbackArr[i].value=='') {check=false;}
  }
  if (check){
    feedBackFormSend(feedbackArr);
  }else{
    alert('Заполните все поля формы обратной связи!');
  }
}
function feedBackFormSend (feedbackArr) {
  $('.preloader-wrapper')[0].style.display='flex';
  $.post('mail/feedback.php', $('.feedback-form').serialize(), feedBackFormAfer);
}
function feedBackFormAfer (data) {
  $('.preloader-wrapper')[0].style.display='none';
  feedBackFormMessage(data);
}
function feedBackFormMessage (data) {
  alert(data);
}