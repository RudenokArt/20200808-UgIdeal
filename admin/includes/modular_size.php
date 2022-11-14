<?php 
$modular_admin->size_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constructor_size` ORDER BY `template` ASC');
$modular_admin->templates_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constractor_templates` ORDER BY `price`');
?>

<div class="container pt-5">
  <form action="" class="row">
    <div class="col-lg-2 col-md-4 col-sm-6">
      Ширина (см):
      <input type="number" class="form-control" name="size_width" required>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
      Высота (см):
      <input type="number" class="form-control" name="size_height" required>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
      Шаблон
      <select name="size_template" class="form-select" required>
        <?php foreach ($modular_admin->templates_arr as $key => $value): ?>
          <option value="<?php echo $value['template']; ?>">
            <?php echo $value['template']; ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
      Стоимость (руб):
      <input type="number" class="form-control" name="size_kof" required>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6">
      <br>
      <button name="modular_size_add" value="Y" class="btn btn-outline-primary">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        Добавить размер
      </button>
    </div>    
  </form> <hr>
  <?php foreach ($modular_admin->size_arr as $key => $value): ?>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6 pt-1 pb-1">
        <?php echo $value['size'] ?>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-6 pt-1 pb-1">
        <?php echo $value['template'] ?>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-6 pt-1 pb-1">
        <?php echo $value['kof'] ?> руб.
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-6 pt-1 pb-1">
        <a href="#" class="btn btn-outline-danger">
          <i class="fa fa-trash-o" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <hr class="m-0">
  <?php endforeach ?>
  <pre><?php print_r($modular_admin->size_arr);?></pre>
</div>