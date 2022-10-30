<?php 
require_once '../modular/connectdb.php';
$modular_admin = new Modular_admin();
/**
 * 
 */
class Modular_admin {
	
	function __construct() {
		$this->galery_count_on_page = file_get_contents('../modular/pagination.txt');
		$this->galery_arr = $this->dbQuery('SELECT * FROM `constructor_galеry` ORDER BY `40x70`');
		$this->galery_arr = $this->pagination($this->galery_arr, $this->galery_count_on_page);

		
	}

	function dbQuery ($sql){
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
		if (isset($_GET['page'])) {
			$current_page = $_GET['page'];
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
			$page_link = '?page='.$n;
			array_push($nav, ['page_nuber' => $page_nuber, 'page_link' => $page_link]);
		}
		return ['page'=>$page, 'nav'=>$nav];
	}

}

?>