<?php include_once 'header.php' ?>
<?php include_once 'php/Modular_admin.php' ?>
<link rel="stylesheet" href="css/admin-modular.css">
<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<!-- =========== -->
<?php
if (isset($_GET['page']) and $_GET['page'] == 'modular_image_upload') {
  include_once 'includes/modular_image_upload.php';
} elseif (isset($_GET['page']) and $_GET['page'] == 'modular_image_edit') {
  include_once 'includes/modular_image_edit.php';
} elseif(isset($_GET['page']) and $_GET['page'] == 'modular_image_delete') {
  include_once 'includes/modular_image_delete.php';
} else {
  include_once 'includes/modular_galery.php';
}
?>
