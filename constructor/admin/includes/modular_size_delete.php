<?php 

$modular_admin->size_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constructor_size` WHERE `id`='.$_GET['id']);

if ($_POST['modular_size_delete']) {
	$modular_admin->dbQuery('DELETE FROM `constructor_size` WHERE `id`='.$_POST['id']);
	echo '<meta http-equiv="refresh" content="0; url=?tab=modular_size" />';
}

?>
<div class="container pt-5">
	<div class="row justify-content-center">
		<div class="col-lg-4 col-md-6 col-sm-12 border pt-5">
			<div class="row">
				<div class="text-center">
					Удалить размер?
					<div class="h5">
						<?php echo $modular_admin->size_arr[0]['size'];?>
						<?php echo $modular_admin->size_arr[0]['template'];?>
						<?php echo $modular_admin->size_arr[0]['kof'];?>
					</div>
				</div>
			</div>
			<div class="row pt-3">
				<div class="col-6 text-center">
					<a href="?tab=modular_size" class="btn btn-outline-warning">
						<i class="fa fa-times" aria-hidden="true"></i>
						Отмена
					</a>
				</div>
				<div class="col-6 text-center">
					<form action="" method="post">
						<input type="hidden" name="id" value="<?php echo $modular_admin->size_arr[0]['id'];?>">
						<button value="Y"	name="modular_size_delete" class="btn btn-outline-danger">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
							Удалить
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>