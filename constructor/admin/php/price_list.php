<?php 

require_once '../modular/connectdb.php';

function priceListGet(){
  global $mysqli;
  $str='SELECT * FROM `wallpaper_price` ';
  $sql=$mysqli->query($str);
  $arr=[];
  while ($row=mysqli_fetch_assoc($sql)) {
    array_push($arr, $row);
  }
  return $arr;
}

function textureGet($texture_id){
  global $mysqli;
  $str='SELECT * FROM `wallpaper_texture` 
  WHERE `id`="'.$texture_id.'"';
  $sql=$mysqli->query($str);
  return mysqli_fetch_assoc($sql)['title'];
}

function sizeGet($size_id){
  global $mysqli;
  $str='SELECT * FROM `wallpaper_roll` 
  WHERE `id`="'.$size_id.'"';
  $sql=$mysqli->query($str);
  return mysqli_fetch_assoc($sql)['roll'];
}

function priceListSort() {
  $rawArr = priceListGet();
  $helperArr = [];
  foreach ($rawArr as $key => $value) {
    $helperArr[$value['id']] = sizeGet($value['size_id']);
  }
  asort($helperArr);
  $arr=[];
foreach ($helperArr as $key => $value) {
  foreach ($rawArr as $subkey => $subvalue) {
    if ($subvalue['id'] == $key) {
      array_push($arr, $subvalue);
    }
  }
}

  return $arr;
}

?>