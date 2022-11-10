<?php if ($_POST['modular_category_add']) {
  echo $_POST['category'];
  $modular_admin->dbQuery('INSERT INTO `constructor_category`(`category`) VALUES ("'.$_POST['category'].'")');
  echo '<meta http-equiv="refresh" content="0; url=?tab=modular_categories" />';
} ?>
<div class="container pt-5">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<form action="" method="post" class="row">
				<div class="col">
					<input type="text" name="category" class="form-control" required>
				</div>
				<div class="col">
					<button name="modular_category_add" value="Y" class="btn btn-outline-primary">
						<i class="fa fa-floppy-o" aria-hidden="true"></i>
						Добавить категорию
					</button>
				</div>
			</form><hr>
			<?php foreach ($modular_admin->categories_arr as $key => $value): ?>
				<div class="row">
					<div class="col">
						<?php echo $value['category'];?>
					</div>
					<div class="col">
						<form action="" method="post" class="m-0">
							<button class="btn btn-outline-danger">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
								<?php echo $value['id']; ?>
							</button>
						</form>
					</div>
				</div><hr class="m-2">
			<?php endforeach ?>
		</div>
	</div>
</div>

<pre><?php print_r($modular_admin->categories_arr); ?></pre>