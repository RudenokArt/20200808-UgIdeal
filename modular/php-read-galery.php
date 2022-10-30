<?php
header("Content-Type: text/html; charset=utf-8");
require 'connectdb.php';
if (isset($_POST['where'])){$where=$_POST['where'];}
$where=str_replace('###', '%', $where);

if ($where=='empty' or $where=='') {
  $sqlText='SELECT * FROM `constructor_galеry` ORDER BY `40x70`';
}
else{
  $sqlText='SELECT * FROM `constructor_galеry` '.$where.' ORDER BY `40x70`';
}
$arr=[];
$i=0;
$sql = $mysqli->query($sqlText);
//$sql = $mysqli->query('SELECT * FROM `constructor_galеry`');
while ($result = mysqli_fetch_array($sql))
{
	$arr[$i]=[];
	$arr[$i]['id']=$result['id'];
	$arr[$i]['image']=$result['image'];
	$arr[$i]['category']=$result['category'];
	$arr[$i]['subcategory']=$result['subcategory'];
	//$arr[$i]['price']=$result['40x70'];
	$arr[$i]['discount']=$result['discount'];
	$arr[$i]['template']=$result['template'];
  $arr[$i]['order']=$result['40x70'];
  $arr[$i]['galeryName']=$result['46x80'];
  $arr[$i]['image_size']=$result['image_size'];
  $arr[$i]['vertical_position']=$result['vertical_position'];
  $arr[$i]['horizontal_position']=$result['horizontal_position'];
  $arr[$i]['scale_x']=$result['scale_x'];
  $arr[$i]['scale_y']=$result['scale_y'];
  $arr[$i]['image_rotate']=$result['image_rotate'];
	$i++;
}
$json=json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $json;

?>