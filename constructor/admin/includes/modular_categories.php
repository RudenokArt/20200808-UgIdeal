<?php 

if ($_POST['modular_subcategory_add']) {
  $modular_admin->dbQuery('INSERT INTO `constructor_subcategory` (`category`, `subcategory`) VALUES ("'.$_GET['category'].'", "'.$_POST['subcategory'].'")');
}

if ($_POST['modular_category_add']) {
  $modular_admin->dbQuery('INSERT INTO `constructor_category`(`category`) VALUES ("'.$_POST['category'].'")');
}

$modular_admin->categories_arr = $modular_admin->dbQuerySelect('SELECT * FROM constructor_category ORDER BY `category`');

if ($_GET['category']) {
  $modular_admin->sub_categories_arr = $modular_admin->
  dbQuerySelect('SELECT * FROM `constructor_subcategory` WHERE `category`="'.$_GET['category'].'"');
}
?>

<div class="container pt-5">
 <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="row">
      <div class="col h4">
        Категории:
      </div>
    </div><hr>
    <form action="" method="post" class="row">
      <div class="col">
       <input type="text" name="category" class="form-control" required>
     </div>
     <div class="col">
       <button name="modular_category_add" value="Y" class="btn btn-outline-primary">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        Добавить категорию
      </button>
    </div>
  </form><hr>
  <?php foreach ($modular_admin->categories_arr as $key => $value): ?>
    <div <?php if ($_GET['category']==$value['category']): ?>
    style="background: rgba(0, 0, 0, 0.1);"
    <?php endif ?> class="row">
    <div class="col-10">
      <a href="?tab=modular_categories&category=<?php echo $value['category'];?>">
        <?php echo $value['category'];?>      
      </a>
    </div>
    <div class="col-2">
      <a href="?page=modular_category_delete&id=<?php echo $value['id'];?>" class="btn btn-outline-danger">
        <i class="fa fa-trash-o" aria-hidden="true"></i>
      </a>
    </div>
  </div><hr class="m-2">
<?php endforeach ?>
</div>
<?php if ($_GET['category']): ?>
  <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="row">
      <div class="col h4">
        Подкатегории (категория - <?php echo $_GET['category']; ?>):
      </div>
    </div><hr>
    <form action="" method="post" class="row">
      <div class="col">
       <input type="text" name="subcategory" class="form-control" required>
     </div>
     <div class="col">
       <button name="modular_subcategory_add" value="Y" class="btn btn-outline-primary">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        Добавить подкатегорию
      </button>
    </div>
  </form><hr>
  <div class="row">
    <div class="col">
      <?php if ($modular_admin->sub_categories_arr): ?>
        <?php foreach ($modular_admin->sub_categories_arr as $key => $value): ?>
          <div class="row">
            <div class="col-10">
              <?php echo $value['subcategory'] ?>
            </div>

            <div class="col-2">
              <a href="?page=modular_subcategory_delete&id=<?php echo $value['id'];?>" class="btn btn-outline-danger">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </a>
            </div>

          </div><hr class="m-2">
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</div>
<?php endif ?>
</div>
</div>