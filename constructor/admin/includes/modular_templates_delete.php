
<?php 
$modular_admin->templates_arr = $modular_admin->
dbQuerySelect('SELECT * FROM `constractor_templates` WHERE `id`='.$_GET['id']);
if ($_POST['modular_tempates_delete']) {
  $modular_admin->dbQuery('DELETE FROM `constractor_templates` WHERE `id`='.$_POST['id']);
  var_dump(unlink('../modular/templates/'.$_POST['template']));
  echo '<meta http-equiv="refresh" content="0; url=?tab=modular_templates" />';
}
?>

<form action="" method="post">
	<?php foreach ($modular_admin->templates_arr as $key => $value): ?>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="row">
						<div class="col text-center">
							<img src="../modular/templates/<?php echo $value['template'];?>"
							class="modular_tempates_delete-image"
							alt="<?php echo $value['template'] ?>">
							<p><?php echo $value['template'] ?></p>
						</div>
					</div>
					<div class="row w-100">
						<div class="col text-center">
							<input value="<?php echo $value['template'];?>" type="hidden" name="template">
							<input value="<?php echo $value['id'] ?>" type="hidden" name="id">
							<button name="modular_tempates_delete" value="Y" 
								class="btn btn-outline-danger" title="Сохранить">
								<i class="fa fa-floppy-o" aria-hidden="true"></i>
								Удалить
							</button>
							<a href="?tab=modular_templates"
							class="btn btn-outline-warning" title="Отмена">
							<i class="fa fa-times" aria-hidden="true"></i>
							Отмена
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>
</form>