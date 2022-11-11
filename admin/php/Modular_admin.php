<?php 
require_once '../modular/connectdb.php';
$modular_admin = new Modular_admin();
/**
 * 
 */
class Modular_admin {
	
	function __construct() {
    
  }

  function dbQuery ($sql) {
    global $mysqli;
    $mysqli->query($sql);
  }

  function dbQuerySelect ($sql){
    global $mysqli;
    $arr=[];
    $src=$mysqli->query($sql);
    while ($result = mysqli_fetch_assoc($src)){
     array_push($arr, $result);
   }
   return($arr);
 }

 function pagination ($arr, $page_size) {
  $current_page = 1;
  if ($_GET['page_N']) {
   $current_page = $_GET['page_N'];
 }
 $last_item = $current_page*$page_size-1;
 $first_item = $last_item - $page_size+1;
 $page = [];
 for ($i=$first_item; $i <= $last_item ; $i++) { 
   array_push($page, $arr[$i]);
 }
 $nav = [];
 for ($i=0; $i < count($arr)/$page_size; $i++) { 
   $n = $i+1;
   $page_nuber = $n;
   $page_link = '?tab=modular_galery&page_N='.$n;
   if ($page_nuber == $current_page) {
    $is_current_page = true;
  } else {
    $is_current_page = false;
  }
  array_push($nav, [
    'page_nuber' => $page_nuber,
    'page_link' => $page_link,
    'is_current_page' => $is_current_page,
  ]);
}
return ['page'=>$page, 'nav'=>$nav];
}

}

?>