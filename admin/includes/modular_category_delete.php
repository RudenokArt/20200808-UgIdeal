<?php
$modular_admin->categories_arr = $modular_admin->
dbQuerySelect('SELECT * FROM constructor_category WHERE `id`='.$_GET['id']);
$modular_admin->sub_categories_arr = $modular_admin->
dbQuerySelect('SELECT * FROM `constructor_subcategory` 
  WHERE `category`="'.$modular_admin->categories_arr[0]['category'].'"');
$modular_admin->galery_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constructor_galеry` 
  WHERE `category`="'.$modular_admin->categories_arr[0]['category'].'"');
if ($_POST['modular_category_delete']) {
  $modular_admin->dbQuery('DELETE FROM `constructor_category` WHERE `id`='.$_POST['modular_category_delete']);
  echo '<meta http-equiv="refresh" content="0; url=?tab=modular_categories" />';
}
?>

<div class="container pt-5">
	<?php if ($modular_admin->sub_categories_arr or $modular_admin->galery_arr): ?>
		<div class="alert alert-danger text-center" role="alert">
			Удаление невозможно. Категория содержит дочерние элементы.
      <?php echo '<meta http-equiv="refresh" content="2; url=?tab=modular_categories" />'; ?>
    </div>
  <?php else: ?>
    <div class="row justify-content-center">
     <div class="col-lg-4 col-md-6 col-sm-12 border pt-5">
      <div class="row">
        <div class="col h6 text-center">
          Удалить категорию?
          <p class="h5"><?php echo $modular_admin->categories_arr[0]['category'];?></p>
        </div>
      </div>
      <div class="row justify-content-center pt-5 pb-5">
        <div class="col text-center">
         <a class="btn btn-outline-warning" href="?tab=modular_categories">
          <i class="fa fa-times" aria-hidden="true"></i>
          Отмена
        </a> 
      </div>
      <div class="col">
        <form action="" method="post">
          <button value="<?php echo $modular_admin->categories_arr[0]['id']?>"
            name="modular_category_delete" class="btn btn-outline-danger">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
            Удалить
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif ?>

</div>
