<?php 
if ($_POST['modular_mat_add']) {
  $modular_admin->dbQuery('INSERT INTO `constructor_mat` (`material`, `kof`) 
    VALUES ("'.$_POST['material'].'", "'.$_POST['kof'].'")');
}

$modular_admin->size_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constructor_mat`');

?>

<div class="container pt-5">
  <form class="row" method="post" action="">
    <div class="col-lg-3 col-md-4 col-sm-6">
      Материал:
      <input name="material" type="text" class="form-control" required>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4">
      Коэффициент:
      <input name="kof" type="number" class="form-control">
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <br>
      <button name="modular_mat_add" value="Y" class="btn btn-outline-primary">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
      Добавить материал
      </button>
    </div>
  </form><hr>
  <?php foreach ($modular_admin->size_arr as $key => $value): ?>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <?php echo $value['material'] ?>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-2">
        <?php echo $value['kof'] ?> %
      </div>
      <div class="col-lg-1 col-md-1 col-sm-2">
        <a href="?page=modular_mat_delete&id=<?php echo $value['id'] ?>" class="btn btn-outline-danger">
          <i class="fa fa-trash-o" aria-hidden="true"></i>
        </a>
      </div>
    </div><hr>
  <?php endforeach ?>
</div>
