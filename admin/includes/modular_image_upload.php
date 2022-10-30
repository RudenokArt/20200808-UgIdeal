<?php 
if ($_POST['modular_image_upload']) {
	echo '<meta http-equiv="refresh" content="0; url=?page_N='
	.$_GET['page_N'].'" />';
}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="container">
		<div class="row w-100 justify-content-center">
			<div class="col-lg-6 col-md-8 col-sm-12 border pt-5 pb-5">
				<div class="container">
					<div class="row w-100 ">
						<div class="col h4">Добавление элемента</div>
					</div>
					<div class="row w-100">
						<div class="col-12">
							<input type="file" name="image_file" class="form-control" id="image_file">
							Шаблон:
							<select name="template" class="form-select">
								<?php foreach ($modular_admin->templates_arr as $sub_key => $sub_value): ?>
									<option>
										<?php echo $sub_value['template']; ?>
									</option>
								<?php endforeach ?>
							</select>
							Категория:
							<select name="category" class="form-select" id="categorySelect">
								<?php foreach ($modular_admin->categories_arr as $sub_key => $sub_value): ?>
									<option value="<?php echo $sub_value['category']; ?>">
										<?php echo $sub_value['category']; ?>										
									</option>
								<?php endforeach ?>
							</select>
							<?php include_once 'modular_galery-subcategory_selector.php';?>
							Скидка (%):
							<input name="discount" type="number" class="form-control">
							Сортировка (номер п/п):
							<input name="40x70" type="number" class="form-control">
						</div>
					</div>
					<div class="row w-100 pt-5">
						<div class="col text-center">
							<button name="modular_image_upload" value="Y"
							class="btn btn-outline-success" title="Сохранить">
							<i class="fa fa-floppy-o" aria-hidden="true"></i>
							Сохранить
						</button>
						<a href="?page_N=<?php echo $_GET['page_N'];?>"
							class="btn btn-outline-danger" title="Отмена">
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
