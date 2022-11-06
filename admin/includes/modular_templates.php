
<?php if ($_POST['modular_template_sort']) {
  $modular_admin->dbQuery('UPDATE `constractor_templates`
    SET 
    `price`='.$_POST['modular_template_sort'].'
    WHERE `id`='.$_POST['id']);
  echo '<meta http-equiv="refresh" content="0; url=?tab=modular_templates" />';
} ?>

<div class="container">
  <div class="row pt-5">
    <a href="?page=modular_tempates_upload" class="btn btn-outline-primary">
      <i class="fa fa-cloud-upload" aria-hidden="true"></i>
      Загрузить шаблон
    </a>
  </div>
  <div class="row pt-3">
   <?php foreach ($modular_admin->templates_arr as $key => $value): ?>
    <div class="col-lg-4 col-md-6 col-sm-12 border">
      <div class="row">
        <div class="col-6">
          <img class="modular_templates-template" src="../modular/templates/<?php echo $value['template'] ?>" alt="<?php echo $value['template'] ?>">
        </div>
        <div class="col-6">
          <div class="row pb-2">
            <div class="col">
              <?php echo $value['template'] ?>
            </div>
          </div>
          <div class="row border-top">
            <div class="col">
              Сортировка:
            </div>
          </div>
          <form class="row pb-2" action="" method="post">
            <div class="col">
              <input type="text" name="modular_template_sort" class="form-control" value="<?php echo $value['price'] ?>">              
            </div>
            <div class="col">
              <button name="id" value="<?php echo $value['id'] ?>" title="сохранить" class="btn btn-outline-primary h-100">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>
              </button>
            </div>
          </form>
          <div class="row border-top pt-2 pb-1">
           <a href="?page=modular_tempates_delete&id=<?php echo $value['id'] ?>" class="btn btn-outline-danger">
             <i class="fa fa-trash-o" aria-hidden="true"></i>
             Удалить
           </a>
         </div>
       </div>
     </div>


   </div>
 <?php endforeach ?>
</div>
</div>