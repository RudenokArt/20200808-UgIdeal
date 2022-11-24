<?php 
if ($_POST['count_on_page']) {
  file_put_contents('../modular/pagination.txt', $_POST['count_on_page']);
  echo '<meta http-equiv="refresh" content="0; url=?page_N='.$_GET['page_N'].'" />';
}

$modular_admin->galery_count_on_page = file_get_contents('../modular/pagination.txt');

if ($_GET['category'] and !$_GET['subcategory']) {
  $modular_admin->filter = 'WHERE `category`="'.$_GET['category'].'"';
} elseif ($_GET['category'] and $_GET['subcategory']) {
  $modular_admin->filter = 'WHERE `category`="'.$_GET['category'].'" AND `subcategory`="'.$_GET['subcategory'].'"';
} elseif ($_GET['article_search']) {
  $modular_admin->filter = 'WHERE `image` LIKE "%'.$_GET['article_search'].'%"';
}

$modular_admin->sub_categories_arr = $modular_admin
->dbQuerySelect('SELECT * FROM `constructor_subcategory`');

$modular_admin->categories_arr = $modular_admin
->dbQuerySelect('SELECT * FROM constructor_category ORDER BY `category`');

$modular_admin->galery_arr = $modular_admin
->dbQuerySelect('SELECT * FROM `constructor_galеry` '.$modular_admin->filter.' ORDER BY `40x70`');

if ($_GET['upload']) {
  $unpaging_gallery_arr = $modular_admin->galery_arr;
  foreach ($unpaging_gallery_arr as $key => $value) {
    if ($value['id']==$_GET['upload']) {
      $page_number = ($key+1)/$modular_admin->galery_count_on_page;
    }
  }
  echo '<meta http-equiv="refresh" content="0; url=?page_N='.ceil($page_number).'" />';
  exit();
}


$modular_admin->galery_arr = $modular_admin
->pagination($modular_admin->galery_arr, $modular_admin->galery_count_on_page);




?>

<div class="container pt-5">
  <div class="row w-100">
    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
      <form action="" method="get"><br>
        <input <?php if ($_GET['article_search']): ?>
        value="<?php echo $_GET['article_search']; ?>"
        <?php endif ?> name="article_search" type="text" class="form-control" placeholder="Поиск по артикулу">
        <button class="btn btn-outline-info w-100 mt-4">
          <i class="fa fa-search" aria-hidden="true"></i>
          Поиск
        </button>
        <a href="?" class="btn btn-outline-warning w-100 mt-3">
          <i class="fa fa-times" aria-hidden="true"></i>
          Сброс
        </a>
      </form>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
      <form action="" method="get">
        <?php include_once 'modular_galery-category_selector.php';?>
        <button class="btn btn-outline-info mt-3">
          <i class="fa fa-filter" aria-hidden="true"></i>
          Фильтр
        </button>
        <a href="?" class="btn btn-outline-warning mt-3">
          <i class="fa fa-times" aria-hidden="true"></i>
          Сброс
        </a>
      </form>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
      Элементов на странице:
      <form action="" method="post" class="m-0">
        <div class="row">
          <div class="col-6">
            <input name="count_on_page" value="<?php echo $modular_admin->galery_count_on_page;?>"
            type="number" class="form-control">
          </div>
          <div class="col-6">
            <button class="btn btn-outline-info w-100">
              <i class="fa fa-floppy-o" aria-hidden="true"></i>
              Сохранить
            </button>
          </div>
        </div>
      </form>
      <div class="pt-4">
        <a href="?page=modular_image_upload&page_N=<?php echo $_GET['page_N']; echo $modular_admin->pagination_filter?>"
          class="btn btn-outline-info">
          <i class="fa fa-cloud-upload" aria-hidden="true"></i>
          Загрузить изображение
        </a>
      </div>
    </div>
  </div>
  <div class="row w-100 pt-5">
    <?php foreach ($modular_admin->galery_arr['page'] as $key => $value): ?>
      <?php if ($value): ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 border">

          <?php include 'modular_galery-item_image.php';?>

          <div class="modular_galery-image_options pt-3">
            <div>
              Изображение: <?php echo $value['image']; ?><br>
              Категория: <?php echo $value['category']; ?><br>
              Подкатегория: <?php echo $value['subcategory']; ?><br>
              Шаблон: <?php echo $value['template'];?><br>
              Скидка: <?php echo $value['discount']; ?><br>
              Сортировка: <?php echo $value['40x70']; ?><br>
            </div>
            <div>
              <a href="?page=modular_image_edit<?php echo $modular_admin->pagination_filter;?>&id=<?php echo $value['id'];?>&page_N=<?php echo $_GET['page_N'];?>"
                title="Редактировать"
                class="btn btn-outline-success m-1">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
              <br>
              <a href="?page=modular_image_delete<?php echo $modular_admin->pagination_filter;?>&id=<?php echo $value['id'];?>&page_N=<?php echo $_GET['page_N'];?>" 
                title="Удалить" class="btn btn-outline-danger m-1">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </a>
              <br>
              <a href="modular_image_position.php?template=<?php echo $value['template'];?>&image_id=<?php echo $value['id'];?>&page_N=<?php echo $_GET['page_N']; echo $modular_admin->pagination_filter?>" title="Позиционирование" class="btn btn-outline-primary m-1">
                <i class="fa fa-arrows" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endif ?>
      
    <?php endforeach ?>
  </div> 
  <div class="row p-5">
    <?php foreach ($modular_admin->galery_arr['nav'] as $key => $value): ?>
      <div class="col-2 col-sm-1">
        <a href="<?php echo $value['page_link'] ?>"
          <?php if ($value['is_current_page']): ?>
            style="color: red;"
          <?php endif ?>
          class="admin_modular_pagination">
          <?php echo $value['page_nuber'] ?>
        </a>
      </div>
    <?php endforeach ?>
  </div>
</div>