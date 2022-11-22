<?php 
$modular_admin->templates_arr = $modular_admin
->dbQuerySelect('SELECT * FROM `constractor_templates` ORDER BY `price`');

$modular_admin->sub_categories_arr = $modular_admin
->dbQuerySelect('SELECT * FROM `constructor_subcategory`');

$modular_admin->categories_arr = $modular_admin
->dbQuerySelect('SELECT * FROM constructor_category ORDER BY `category`');

if ($_POST['modular_image_upload']) {
  move_uploaded_file($_FILES['image_file']['tmp_name'],
   '../modular/galery/'.$_FILES['image_file']['name']);
  if (!$_POST['discount']) {
    $_POST['discount'] = 0;
  }
  if (!$_POST['40x70']) {
    $_POST['40x70'] = 0;
  }
  $sql = 'INSERT INTO `constructor_galеry`
    (`image`, `category`, `subcategory`, `discount`, `template`,
     `40x70`,`46x80`,`51x90`, `57x100`, `63x110`, `68x120`, `74x130`, `80x140`)
    VALUES ("'.$_FILES['image_file']['name'].'",
     "'.$_POST['category'].'",
     "'.$_POST['subcategory'].'",
     '.$_POST['discount'].',
     "'.$_POST['template'].'",
     '.$_POST['40x70'].',0,0,0,0,0,0,0)';
  $modular_admin->dbQuery($sql);

  $modular_admin->galery_id_arr = $modular_admin
  ->dbQuerySelect('SELECT `id` FROM `constructor_galеry` ORDER BY `40x70`');
  $modular_admin->uploaded_item = $modular_admin
  ->dbQuerySelect('SELECT `id` FROM `constructor_galеry` ORDER BY `id` DESC');
  $modular_admin->galery_count_on_page = file_get_contents('../modular/pagination.txt');
  foreach ($modular_admin->galery_id_arr as $key => $value) {
    if ($value['id'] == $modular_admin->uploaded_item[0]['id']) {
      $modular_admin->current_page = ceil(($key+1) / ($modular_admin->galery_count_on_page));
    }
  }


  echo '<meta http-equiv="refresh" content="0; url=?page_N='.$modular_admin->current_page.'" />';
  // echo '<meta http-equiv="refresh" content="0; url=?page_N='.$_GET['page_N'].'" />';
}

?>


<form action="" method="post" enctype="multipart/form-data">
	<div class="container">
		<div class="row w-100 justify-content-center">
			<div class="col-lg-6 col-md-8 col-sm-12 border pt-5 pb-5">
				<div class="container">
					<div class="row w-100 ">
						<div class="col h4">Добавление элемента</div>
					</div>
					<div class="row w-100">
						<div class="col-12">
							<input type="file" name="image_file" class="form-control w-100" id="image_file">
							<?php include_once 'modular_galery-template_selector.php';?>
							<?php include_once 'modular_galery-category_selector.php';?>
							Скидка (%):
							<input name="discount" type="number" class="form-control">
							Сортировка (номер п/п):
							<select name="40x70" class="form-select">
                  <?php for ($i=0; $i < 500; $i++):?>
                    <option value="<?php echo $i;?>">
                      <?php echo $i;?>
                    </option>
                <?php endfor; ?>
                </select>
						</div>
					</div>
					<div class="row w-100 pt-5">
						<div class="col text-center">
							<button name="modular_image_upload" value="Y"
							class="btn btn-outline-success" title="Сохранить">
							<i class="fa fa-floppy-o" aria-hidden="true"></i>
							Сохранить
						</button>
						<a href="?page_N=<?php echo $_GET['page_N']; echo $modular_admin->pagination_filter?>"
							class="btn btn-outline-danger" title="Отмена">
							<i class="fa fa-times" aria-hidden="true"></i>
							Отмена
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
