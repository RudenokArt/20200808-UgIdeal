<?php 
require_once '../modular/connectdb.php';
$modular_admin = new Modular_admin();
/**
 * 
 */
class Modular_admin {
	
	function __construct() {
    if ($_POST['count_on_page']) {
      file_put_contents('../modular/pagination.txt', $_POST['count_on_page']);
      echo '<meta http-equiv="refresh" content="0; url=?page_N='.$_GET['page_N'].'" />';
    }
		$this->categories_arr = $this->dbQuerySelect('SELECT * FROM constructor_category ORDER BY `category`');
		$this->sub_categories_arr = $this->dbQuerySelect('SELECT * FROM `constructor_subcategory`');
    if ($_GET['page'] == 'modular_templates_delete') {
      $this->templates_arr = $this->dbQuerySelect('SELECT * FROM `constractor_templates` WHERE `id`='.$_GET['id']);
    } elseif ($_GET['tab'] == 'modular_templates') {
      $this->templates_arr = $this->dbQuerySelect('SELECT * FROM `constractor_templates` ORDER BY `price`');
    } elseif ($_GET['tab'] == 'modular_categories') {
      $this->categories_arr = $this->dbQuerySelect('SELECT * FROM `constructor_category` ORDER BY `category`');
    }

    if ($_GET['tab'] == 'modular_posts') {
      $this->posts_arr = $this->dbQuerySelect('SELECT * FROM `constructor_post`');
    } elseif ($_GET['page'] == 'modular_posts_edit' or $_GET['page'] == 'modular_posts_delete') {
      $this->posts_arr = $this->dbQuerySelect('SELECT * FROM `constructor_post` WHERE `id`='.$_GET['id']);
    } 

		if ($_GET['page'] == 'modular_image_edit') { // редактирование элемента галереи
			$this->modular_image_edit = $this->dbQuerySelect('SELECT * FROM `constructor_galеry` WHERE `id`='.$_GET['id']);
		}   elseif ($_GET['page'] == 'modular_image_delete') { // удалить элемент галереи
      $this->modular_image_delete = $this->dbQuerySelect('SELECT * FROM `constructor_galеry` WHERE `id`='.$_GET['id']);
    } else { // Вывод галереи
      $this->galery_count_on_page = file_get_contents('../modular/pagination.txt');
      if ($_GET['category']) {
        $this->filter = 'WHERE `category`="'.$_GET['category'].'"';
      } elseif ($_GET['category'] and $_GET['subcategory']) {
        $this->filter = 'WHERE `category`="'.$_GET['category'].'" AND `subcategory`="'.$_GET['subcategory'].'"';
      } elseif ($_GET['article_search']) {
        $this->filter = 'WHERE `image` LIKE "%'.$_GET['article_search'].'%"';
      }
      $this->galery_arr = $this->dbQuerySelect('SELECT * FROM `constructor_galеry` '.$this->filter.' ORDER BY `id`');
      $this->galery_arr = $this->pagination($this->galery_arr, $this->galery_count_on_page);
    }
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