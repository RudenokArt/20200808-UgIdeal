<div class="container">
  <div class="row w-100">
    <div class="col p-2">
      <a href="?page=modular_image_upload&page_N=<?php echo $_GET['page_N'];?>" class="btn btn-outline-info">
        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
        Загрузить изображение
      </a>
    </div>
  </div>
  <div class="row w-100">
    <?php foreach ($modular_admin->galery_arr['page'] as $key => $value): ?>
      <?php if ($value): ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 border">

        <?php include 'modular_galery-item_image.php';?>

        <div class="modular_galery-image_options pt-3">
          <div>
            Изображение: <?php echo $value['image']; ?><br>
            Категория: <?php echo $value['category']; ?><br>
            Подкатегория: <?php echo $value['subcategory']; ?><br>
            Шаблон: <?php echo $value['template']; ?><br>
            Скидка: <?php echo $value['discount']; ?><br>
            Сортировка: <?php echo $value['40x70']; ?><br>
          </div>
          <div>
            <a href="?page=modular_image_edit&id=<?php echo $value['id'];?>&page_N=<?php echo $_GET['page_N'];?>"
              title="Редактировать"
              class="btn btn-outline-success m-1">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a>
            <br>
            <a href="?page=modular_image_delete&id=<?php echo $value['id'];?>&page_N=<?php echo $_GET['page_N'];?>" 
              title="Удалить" class="btn btn-outline-danger m-1">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
            <br>
            <a href="#" title="Позиционирование" class="btn btn-outline-primary m-1">
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