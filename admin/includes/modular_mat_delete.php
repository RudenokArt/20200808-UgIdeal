<?php

$modular_admin->size_arr = $modular_admin
->dbQuerySelect('SELECT * FROM `constructor_mat` WHERE `id`='.$_GET['id'])[0];

if ($_POST['modular_mat_delete']) {
  $modular_admin->dbQuery('DELETE FROM `constructor_mat` WHERE  `id`='.$modular_admin->size_arr['id']);
  echo '<meta http-equiv="refresh" content="0; url=?tab=modular_mat" />';
}

?>
<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 col-sm-12 border pt-5 pb-5">
      <form action="" method="post">
        <div class="text-center h5">
          Удалить материал?
          <div class="h4">
            <?php echo $modular_admin->size_arr['material']; ?>
            <?php if ($modular_admin->size_arr['kof']): ?>
              (<?php echo $modular_admin->size_arr['kof']; ?>%)
            <?php endif ?>    
          </div>   
        </div>
        <div class="text-center pt-5">
          <a href="?tab=modular_mat" class="btn btn-outline-warning">
            <i class="fa fa-times" aria-hidden="true"></i>
            Отмена
          </a>
          <form action="" method="post">
            <button name="modular_mat_delete" value="Y" class="btn btn-outline-danger">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
              Удалить
            </button>
          </form>          
        </div>
      </form>
    </div>
  </div>
</div>

