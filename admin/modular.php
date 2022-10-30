<?php include_once 'php/Modular_admin.php' ?>
<link rel="stylesheet" href="css/admin-modular.css">
<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<!-- =========== -->
<div class="container">
  <div class="row">
    <?php foreach ($modular_admin->galery_arr['page'] as $key => $value): ?>
      <div class="col-12 col-sm-12 col-md-6 col-lg-4 border">
        <div class="modular_galery-image_wrapper">
          <div
          style="background-image:url(../modular/miniatures/<?php echo $value['image'] ?>);"
          class="modular_galery-image"></div>
          <div style="background-image:url(../modular/mini-templates/<?php echo $value['template'] ?>);" class="modular_galery-image_template"></div>
        </div>
        <pre><?php print_r($value); ?></pre>
      </div>
    <?php endforeach ?>
  </div> 
</div>
