<?php 
if ($_POST['modular_tempates_upload']) {
	move_uploaded_file($_FILES['template_file']['tmp_name'],
		'../modular/templates/'.$_FILES['template_file']['name']);
	$sql = 'INSERT INTO `constractor_templates`(`template`, `size`, `price`)
		VALUES ("'.$_FILES['template_file']['name'].'", "0", "'.$_POST['sort'].'")';
	$modular_admin->dbQuery($sql);
	echo '<meta http-equiv="refresh" content="0; url=?tab=modular_templates" />';
}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="h4">Добавление шаблона</div>
				Файл:
				<input type="file" name="template_file" class="form-control w-100" id="template_file">
				Сортировка:
				<input name="sort" value="0" type="number" class="form-control">
				<div class="row w-100 pt-3">
					<div class="col text-center">
						<button name="modular_tempates_upload" value="Y"
						class="btn btn-outline-success" title="Сохранить">
						<i class="fa fa-floppy-o" aria-hidden="true"></i>
						Сохранить
					</button>
					<a href="?tab=modular_templates"
					class="btn btn-outline-danger" title="Отмена">
					<i class="fa fa-times" aria-hidden="true"></i>
					Отмена
				</a>
			</div>
		</div>
	</div>
</div>
</div>
</form>