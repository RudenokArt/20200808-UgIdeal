<?php

$modular_admin->sub_categories_arr = $modular_admin->
dbQuerySelect('SELECT * FROM `constructor_subcategory` WHERE `id`='.$_GET['id']);

$modular_admin->galery_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constructor_galеry` 
  WHERE `subcategory`="'.$modular_admin->sub_categories_arr[0]['subcategory'].'"');

if ($_POST['modular_subcategory_delete']) {
  $modular_admin->dbQuery('DELETE FROM `constructor_subcategory` WHERE `id`='.$_POST['modular_subcategory_delete']);
  echo '<meta http-equiv="refresh" content="0; url=?tab=modular_categories&category='.$modular_admin->sub_categories_arr[0]['category'].'" />';
}

?>

<div class="container pt-5">
  <?php if ($modular_admin->galery_arr): ?>
    <div class="alert alert-danger text-center" role="alert">
      Удаление невозможно. Подкатегория содержит дочерние элементы.
      <?php echo '<meta http-equiv="refresh" content="2; url=?tab=modular_categories&category='.$modular_admin->sub_categories_arr[0]['category'].'" />'; ?>
    </div>
  <?php else: ?>
    <div class="row justify-content-center">
     <div class="col-lg-4 col-md-6 col-sm-12 border pt-5">
      <div class="row">
        <div class="col h6 text-center">
          Удалить подкатегорию
          <p class="h5"><?php echo $modular_admin->sub_categories_arr[0]['subcategory'];?></p>
          из категории
          <p class="h5"><?php echo $modular_admin->sub_categories_arr[0]['category'];?>?</p>
          
        </div>
      </div>
      <div class="row justify-content-center pt-5 pb-5">
        <div class="col text-center">
         <a class="btn btn-outline-warning" 
         href="?tab=modular_categories&category=<?php echo $modular_admin->sub_categories_arr[0]['category'];?>">
          <i class="fa fa-times" aria-hidden="true"></i>
          Отмена
        </a> 
      </div>
      <div class="col">
        <form action="" method="post">
          <button value="<?php echo $modular_admin->sub_categories_arr[0]['id']?>"
            name="modular_subcategory_delete" class="btn btn-outline-danger">
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