<?php 
$modular_admin->size_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constructor_size`');
?>

<div class="container pt-5">
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