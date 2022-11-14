
<?php include_once 'php/Modular_admin.php';?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" 
  href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://use.fontawesome.com/e8a42d7e14.js"></script>
  <script src="js/jquery_ui.js"></script>
  <link rel="stylesheet" href="css/admin-modular.css">
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <!-- =========== -->
  <title>Document</title>
</head>
<body>
  &#128101 <span class="login-info"></span>
  <script src="js/login.js"></script>

  <div class="container">
   <div class="row">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link 
        <?php if ($_GET['tab'] == 'modular_galery' or !$_GET['tab']): ?>
          active
        <?php endif ?>" href="?tab=modular_galery">
          Изображения
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if ($_GET['tab'] == 'modular_templates'): ?>
          active
        <?php endif ?>" href="?tab=modular_templates">
          Шаблоны
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if ($_GET['tab'] == 'modular_categories'): ?>
          active
        <?php endif ?>" href="?tab=modular_categories">
          Категории
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if ($_GET['tab'] == 'modular_posts'): ?>
          active
        <?php endif ?>" href="?tab=modular_posts">
          Посты
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if ($_GET['tab'] == 'modular_size'): ?>
          active
        <?php endif ?>" href="?tab=modular_size">
          Размеры и цены
        </a>
      </li>
    </ul>
  </div>
</div>

<?php
if (isset($_GET['page']) and $_GET['page'] == 'modular_image_upload') {
  include_once 'includes/modular_image_upload.php';
} elseif (isset($_GET['page']) and $_GET['page'] == 'modular_image_edit') {
  include_once 'includes/modular_image_edit.php';
} elseif(isset($_GET['page']) and $_GET['page'] == 'modular_image_delete') {
  include_once 'includes/modular_image_delete.php';
} elseif(isset($_GET['page']) and $_GET['page'] == 'modular_templates_upload') {
  include_once 'includes/modular_templates_upload.php';
} elseif(isset($_GET['page']) and $_GET['page'] == 'modular_templates_delete') {
  include_once 'includes/modular_templates_delete.php';
} elseif(isset($_GET['page']) and $_GET['page'] == 'modular_posts_edit') {
  include_once 'includes/modular_posts_edit.php';
} elseif(isset($_GET['page']) and $_GET['page'] == 'modular_posts_upload') {
  include_once 'includes/modular_posts_upload.php';
} elseif(isset($_GET['page']) and $_GET['page'] == 'modular_posts_delete') {
  include_once 'includes/modular_posts_delete.php';
} elseif(isset($_GET['page']) and $_GET['page'] == 'modular_category_delete') {
  include_once 'includes/modular_category_delete.php';
} elseif(isset($_GET['page']) and $_GET['page'] == 'modular_subcategory_delete') {
  include_once 'includes/modular_subcategory_delete.php';
} else {
  if ($_GET['tab'] and $_GET['tab'] == 'modular_templates') {
    include_once 'includes/modular_templates.php';
  } elseif ($_GET['tab'] and $_GET['tab'] == 'modular_categories') {
    include_once 'includes/modular_categories.php';
  } elseif ($_GET['tab'] and $_GET['tab'] == 'modular_posts') {
    include_once 'includes/modular_posts.php';
  } elseif ($_GET['tab'] and $_GET['tab'] == 'modular_size') {
    include_once 'includes/modular_size.php';
  } else {
    include_once 'includes/modular_galery.php';
  }
  
}
?>

</body>
</html>