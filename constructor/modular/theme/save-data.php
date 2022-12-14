<?php     header('Content-type: text/html; charset=utf-8');


print_r($dataArr);
$dataStyle='
.modular-sidebar_icon,.modular-galery_item-button,
#backButton,.simple-button,.header-menu_button,
.template-tape-item,.sign-blue,.radio-label_active,
.header-top,.header-menu,.footer {
  background-color:'.$dataArr["themeColor"].';
}
.modulat-galery_item-cart,
.modular-navigation,.modular-galery_item-name,
.header-info_icon-large,.header-info_icon{
  color:'.$dataArr["themeColor"].';
}
#range-vidget,.radio-label,.radio-label_active{
border-color:'.$dataArr["themeColor"].';
}
#range-slider{
background-color: '.$dataArr["themeColor"].';
}
.header-top a,.footer *,.header-menu a,#backButton,.modular-cart,
.simple-button,.sign-blue,.modular-galery_item-button{
  color:'.$dataArr["fontColor"].';
}
.modular-sidebar_category:hover,.modular-sidebar_subcategory:hover,
#backButton:hover,.header-menu a:hover,.company-name:hover,
.action-button:hover,.simple-button:hover,.modular-galery_item-button:hover,
.button-search:hover,.item-list:hover{
  background-color: '.$dataArr["hoverColor"].';
}';
$favoriteStyle='
button{
  background-color:'.$dataArr["themeColor"].';
}
button{
  color:'.$dataArr["fontColor"].';
}
.content-item,label,input[type="text"]{
  border-color:'.$dataArr["themeColor"].' !important;
}';
$wallpaperStyle='
.wallpaper-galery_item-button{
  color:'.$dataArr["fontColor"].';
}
.hover_color:hover,
.wallpaper_constructor-button:hover,
.sidebar-category:hover,.wallpaper-galery_item-button:hover,
.sidebar-subcategory:hover{
  background-color: '.$dataArr["hoverColor"].';
  transition-duration:1s;
}
.text_color{
  color:'.$dataArr["fontColor"].';
}

.wallpaper-galery_item-icon,.wallpaper-galery_image-name,
.wallpaper-navigation,.constractor-navigation{
  color:'.$dataArr["themeColor"].';
}
.layout_color,
.wallpaper_constructor-calc, .wallpaper_constructor-button,
.category-icon,.wallpaper-galery_item-button,
.radio-label_actve,.checkbox-label_active{
  background-color: '.$dataArr["themeColor"].';
  transition-duration:1s;
}
.radio-label,.checkbox-label,.border_color{
 border-color:'.$dataArr["themeColor"].';
}';
file_put_contents('css/data-style.css', $dataStyle);
file_put_contents('css/favorite-style.css', $favoriteStyle);
file_put_contents('../../wallpaper/css/data-style.css',$wallpaperStyle);
$json=json_encode($dataArr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('database.txt',$json);




?>