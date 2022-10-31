<?php 
require_once '../modular/connectdb.php';
$modular_admin = new Modular_admin();
/**
 * 
 */
class Modular_admin {
	
	function __construct() {
		$this->categories_arr = $this->dbQuerySelect('SELECT * FROM constructor_category ORDER BY `category`');
		$this->sub_categories_arr = $this->dbQuerySelect('SELECT * FROM `constructor_subcategory`');
		$this->templates_arr = $this->dbQuerySelect('SELECT * FROM `constractor_templates` ORDER BY `price`');

		if ($_GET['page'] == 'modular_image_edit') { // редактирование элемента галереи
			$this->modular_image_edit = $this->dbQuerySelect('SELECT * FROM `constructor_galеry` WHERE `id`='.$_GET['id']);
			if ($_POST['modular_image_edit']) {
				$this->dbQuery('UPDATE `constructor_galеry`
					SET 
					`template`="'.$_POST['template'].'",
					`category`="'.$_POST['category'].'",
					`subcategory`="'.$_POST['subcategory'].'",
					`discount`='.$_POST['discount'].',
					`40x70`='.$_POST['40x70'].'
					WHERE `id`='.$_POST['id']);
			}
		} elseif ($_POST['modular_image_upload'] and $_GET['page'] == 'modular_image_upload') { // загрузка в галерею
				 move_uploaded_file($_FILES['image_file']['tmp_name'],
					'../modular/galery/'.$_FILES['image_file']['name']);
				 if (!$_POST['discount']) {
				 	$_POST['discount'] = 0;
				 }
				 if (!$_POST['40x70']) {
				 	$_POST['40x70'] = 0;
				 }
				 $sql = $this->dbQuery('INSERT INTO `constructor_galеry`
					(`image`, `category`, `subcategory`, `discount`, `template`,
					`40x70`,`46x80`,`51x90`, `57x100`, `63x110`, `68x120`, `74x130`, `80x140`)
					VALUES ("'.$_FILES['image_file']['name'].'",
					"'.$_POST['category'].'",
					"'.$_POST['subcategory'].'",
					'.$_POST['discount'].',
					"'.$_POST['template'].'",
					'.$_POST['40x70'].',0,0,0,0,0,0,0)');
			} elseif ($_POST['modular_image_delete']) {
        var_dump(unlink('../modular/galery/'.$_POST['image']));
        $this->dbQuery('DELETE FROM `constructor_galеry` WHERE `id`='.$_POST['id']);
      } elseif ($_GET['page'] == 'modular_image_delete') { // удалить элемент галереи
        $this->modular_image_delete = $this->dbQuerySelect('SELECT * FROM `constructor_galеry` WHERE `id`='.$_GET['id']);
      } else {
			$this->galery_count_on_page = file_get_contents('../modular/pagination.txt');
			$this->galery_arr = $this->dbQuerySelect('SELECT * FROM `constructor_galеry` ORDER BY `id`');
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
			$page_link = '?page_N='.$n;
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