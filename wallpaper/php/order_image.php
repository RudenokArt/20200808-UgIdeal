<?php 
// $font = [
//   'D:\OpenServer\domains\ug-ideal\modular/fonts/arial-narrow.ttf',
//   'D:\OpenServer\domains\ug-ideal\modular/fonts/times-bold.ttf',
// ];
$font = [
 __DIR__.'/fonts/arial-narrow.ttf',
 __DIR__.'/fonts/times-bold.ttf',
];
$company=json_decode(file_get_contents('../../modular/theme/database.txt'));
$user = json_decode(file_get_contents('../data/useer_data.json'));
$data = json_decode($_POST['data']);
image_draw();


function image_draw(){
  global $data;
  $page = imagecreatetruecolor(590, page_size());
  $white=imagecolorallocate($page, 250, 250, 250);
  imagefill($page, 0, 0, $white);
  $item_counter = 1;
  foreach ($data as $key => $value) {
    order_item_image ($page, $value,$item_counter);
    order_item_text($page, $value, $item_counter);
    $item_counter++;
  }
  order_text($page);
  order_total($page);
  imageJPEG($page, '../user_download/order.jpg');
}

function page_size() {
  global $data;
  return (sizeof($data)+2)*160;
}

function image_src($path,$img) {
 global $data;
 $imageFile = '../img/'.$path.'/'.$img;
 $ext=explode('.', $data[0][1]->image);
 if ($ext=='webp') {
  $image=imagecreatefromwbmp($imageFile);} 
  elseif ($ext=='png') {
    $image=imagecreatefrompng($imageFile);
  }
  else{
    $image=imagecreatefromjpeg($imageFile);
  }
  return $image;
}

function image_size ($path,$src) {
  $arr = getimagesize('../img/'.$path.'/'.$src);
  $size_arr = [
    'width' => $arr[0],
    'height' => $arr[1],
  ];
  return $size_arr;
}

function order_item_image ($page, $value, $item_counter) {
  $wallpaper_src = image_src('wallpaper',$value[1]->image);
  $wallpaper_size = image_size('wallpaper',$value[1]->image);
  imagecopyresampled($page, $wallpaper_src,
    10 , $item_counter*150+10, 0, 0, 
    $wallpaper_size['width']/5, $wallpaper_size['height']/5, 
    $wallpaper_size['width'], $wallpaper_size['height']);
}

function order_item_text ($page, $value, $item_counter) {
  global $font;
  $image = imagecreate(300, 150);
  $white=imagecolorallocate($image, 250, 250, 250);
  $black=imagecolorallocate($image,0,0,0);
  imageFtText($image, 10, 0, 0,10, $black, $font[0], 'Категория: '.$value[1]->category);
  imageFtText($image, 10, 0, 0,25, $black, $font[0], 'Подкатегория: '.$value[1]->subcategory);
  imageFtText($image, 10, 0, 0,40, $black, $font[0], 'Изображение: '.$value[1]->imageName);
  imageFtText($image, 10, 0, 0,55, $black, $font[0], 'Артикул: '.explode('.', $value[1]->image)[0]);
  imageFtText($image, 10, 0, 0,70, $black, $font[0], 'Ширина: '.$value[1]->relativeSize[0]);
  imageFtText($image, 10, 0, 150,70, $black, $font[0], 'Высота: '.$value[1]->relativeSize[1]);
  imageFtText($image, 10, 0, 0, 85, $black, $font[0], 'Рулон: '.$value[1]->rollAbsSize).' см.';
  imageFtText($image, 10, 0, 150, 85, $black, $font[0], 'Фактура: '.$value[1]->texture);
  imageFtText($image, 10, 0, 0, 100, $black, $font[0], 'Стоимость: '.$value[1]->amount);
  imageFtText($image, 10, 0, 150, 100, $black, $font[0], 'Скидка: '.$value[1]->discount).' %';
  imageFtText($image, 10, 0, 0, 115, $black, $font[0], 'Стоимость со скидкой: '.$value[1]->amountDiscount);
  imagecopyresized($page, $image, 250, $item_counter*150+10, 0, 0, 300, 150, 300, 150);
}

function order_text ($page) {
  global $company, $font;
  $text=imagecreate(400, 100);
  $white=imagecolorallocate($text,250,250,250);
  $black=imagecolorallocate($text,0,0,0);
  imageFtText($text, 12, 0, 0,15, $black, $font[0], $company->siteName);
  imageFtText($text, 10, 0, 0,30, $black, $font[0], $company->region);
  imageFtText($text, 10, 0, 0,45, $black, $font[0], $company->city);
  imageFtText($text, 10, 0, 0,60, $black, $font[0], $company->adress);

  imageFtText($text, 10, 0, 200,30, $black, $font[0], $company->email);
  imageFtText($text, 10, 0, 200,45, $black, $font[0], $company->region);
  imageFtText($text, 10, 0, 200,60, $black, $font[0], $company->region);

  imageFtText($text, 10, 0, 0,75, $black, $font[0], $company->phone1);
  imageFtText($text, 10, 0, 200,75, $black, $font[0], $company->phone2);
  imagecopyresized($page, $text, 50, 50, 0, 0, 400, 100, 400, 100);
}

function order_total($page){
  global $data, $font, $user;
  $total = 0;
  foreach ($data as $key => $value) {
    $total = $total+$value[1]->amountDiscount;
  }
  $text=imagecreate(400, 100);
  $white=imagecolorallocate($text,250,250,250);
  $black=imagecolorallocate($text,0,0,0);
  imageFtText($text, 12, 0, 0,15, $black, $font[0], 'ВСЕГО К ОПЛАТЕ: '.$total);
  imageFtText($text, 12, 0, 0,35, $black, $font[0], 'ЗАКАЗЧИК: '.$user->user_name);
  imageFtText($text, 12, 0, 0,55, $black, $font[0], 'тел.: '.$user->user_phone);
  imageFtText($text, 12, 0, 0,75, $black, $font[0], 'email: '.$user->user_email);
  print_r($user);
  imagecopyresized($page, $text, 50, (page_size()-160), 0, 0, 400, 100, 400, 100);
}




?>