<?php 
if ($_POST['modular_image_edit']) {
	echo '<meta http-equiv="refresh" content="0; url=?page_N='.$_GET['page_N'].'" />';
}
?>
<form action="" method="post">
	<div class="container">
		<div class="row w-100 justify-content-center">
			<div class="col-lg-6 col-md-8 col-sm-12 border pt-5 pb-5">
				<div class="container">
					<div class="row">
						<div class="col h4">Редактирование элемента</div>
					</div>
					<?php foreach ($modular_admin->modular_image_edit as $key => $value): ?>
						<input type="hidden" name="id" value="<?php echo $value['id']; ?>">
						<div class="row">
							<div class="col-12">
								<?php include_once 'modular_galery-item_image.php';?>
							</div>
							<div class="col-12">
								<p class="text-center"><b>Изображение: <?php echo $value['image'];?></b></p>
								Шаблон:
								<select name="template" class="form-select">
									<?php foreach ($modular_admin->templates_arr as $sub_key => $sub_value): ?>
										<option <?php if ($sub_value['template'] == $value['template']): ?>
											selected
										<?php endif ?> value="<?php echo $sub_value['template']; ?>">
											<?php echo $sub_value['template']; ?>
										</option>
									<?php endforeach ?>
								</select>
								Категория:
								<select name="category" class="form-select" id="categorySelect">
									<?php foreach ($modular_admin->categories_arr as $sub_key => $sub_value): ?>
										<option <?php if ($sub_value['category'] == $value['category']): ?>
											selected
										<?php endif ?>
										value="<?php echo $sub_value['category']; ?>">
										<?php echo $sub_value['category']; ?>										
										</option>
									<?php endforeach ?>
								</select>
								<?php include_once 'modular_galery-subcategory_selector.php';?>
								Скидка (%):
								<input value="<?php echo $value['discount'] ?>"
								name="discount" type="text" class="form-control">
								Сортировка (номер п/п):
								<input value="<?php echo $value['40x70'] ?>"
								name="40x70" type="text" class="form-control">
							</div>
						</div>
					<?php endforeach ?>
					<div class="row w-100 pt-5">
						<div class="col text-center">
							<button name="modular_image_edit" value="Y"
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

