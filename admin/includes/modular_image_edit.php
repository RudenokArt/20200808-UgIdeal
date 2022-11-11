<?php 
$modular_admin->modular_image_edit = $modular_admin->
dbQuerySelect('SELECT * FROM `constructor_galеry` WHERE `id`='.$_GET['id']);
$modular_admin->sub_categories_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constructor_subcategory`');
$modular_admin->categories_arr = $modular_admin->dbQuerySelect('SELECT * FROM constructor_category ORDER BY `category`');
if ($_POST['modular_image_edit']) {
  $modular_admin->dbQuery('UPDATE `constructor_galеry`
    SET 
    `template`="'.$_POST['template'].'",
    `category`="'.$_POST['category'].'",
    `subcategory`="'.$_POST['subcategory'].'",
    `discount`='.$_POST['discount'].',
    `40x70`='.$_POST['40x70'].'
    WHERE `id`='.$_POST['id']);
  echo '<meta http-equiv="refresh" content="0; url=?page_N='.$_GET['page_N'].'" />';
}
?>
<form action="" method="post">
	<div class="container">
		<div class="row w-100 justify-content-center">
			<div class="col-lg-6 col-md-8 col-sm-12 border pt-5 pb-5">
				<div class="container">
					<div class="row">
						<div class="col h4">Редактирование элемента</div>
					</div>
					<?php foreach ($modular_admin->modular_image_edit as $key => $value): ?>
						<input type="hidden" name="id" value="<?php echo $value['id']; ?>">
						<div class="row">
							<div class="col-12">
								<?php include_once 'modular_galery-item_image.php';?>
							</div>
							<div class="col-12">
								<p class="text-center"><b>Изображение: <?php echo $value['image'];?></b></p>
								<?php include_once 'modular_galery-template_selector.php';?>
								<?php include_once 'modular_galery-category_selector.php';?>
								Скидка (%):
								<input value="<?php echo $value['discount'] ?>"
								name="discount" type="text" class="form-control">
								Сортировка (номер п/п):
								<input value="<?php echo $value['40x70'] ?>"
								name="40x70" type="text" class="form-control">
							</div>
						</div>
					<?php endforeach ?>
					<div class="row w-100 pt-5">
						<div class="col text-center">
							<button name="modular_image_edit" value="Y"
							class="btn btn-outline-success" title="Сохранить">
              <i class="fa fa-floppy-o" aria-hidden="true"></i>
              Сохранить
            </button>
            <a href="?page_N=<?php echo $_GET['page_N'];?>"
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

