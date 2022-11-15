<?php 

$modular_admin->size_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constructor_mat`');

?>

<div class="container pt-5">
  <?php foreach ($modular_admin->size_arr as $key => $value): ?>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <?php echo $value['material'] ?>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-2">
        <?php echo $value['kof'] ?> %
      </div>
      <div class="col-lg-1 col-md-1 col-sm-2">
        <a href="#" class="btn btn-outline-danger">
          <i class="fa fa-trash-o" aria-hidden="true"></i>
        </a>
      </div>
    </div><hr>
  <?php endforeach ?>
</div>

<pre><?php print_r($modular_admin->size_arr); ?></pre>