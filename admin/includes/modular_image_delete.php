<?php 
if ($_POST['modular_image_delete']) {
  var_dump(unlink('../modular/galery/'.$_POST['image']));
  $modular_admin->dbQuery('DELETE FROM `constructor_galеry` WHERE `id`='.$_POST['id']);
  echo '<meta http-equiv="refresh" content="0; url=?page_N='.$_GET['page_N'].'" />';
}
?>
<form action="" method="post">
  <div class="container">
    <div class="row w-100 justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-12 border pt-5 pb-5">
        <div class="container">
          <div class="row w-100 ">
            <div class="col-12 text-center h4">Удаление элемента</div>
          </div>
          <div class="row">
            <div class="col-12">
              <?php if ($modular_admin->modular_image_delete): ?>
                <?php foreach ($modular_admin->modular_image_delete as $key => $value): ?>
                  <?php include_once 'modular_galery-item_image.php';?>
                  <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                  <input type="hidden" name="image" value="<?php echo $value['image'] ?>">
                <?php endforeach ?>
              <?php endif ?>
            </div>
          </div>
          <div class="row w-100 pt-5">
            <div class="col text-center">
              <button name="modular_image_delete" value="Y"
              class="btn btn-outline-danger" title="Сохранить">
              <i class="fa fa-floppy-o" aria-hidden="true"></i>
              Удалить
            </button>
            <a href="?page_N=<?php echo $_GET['page_N'];?>"
              class="btn btn-outline-warning" title="Отмена">
              <i class="fa fa-times" aria-hidden="true"></i>
              Отмена
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>