<?php 
if ($_POST['modular_posts_upload']) {
	move_uploaded_file($_FILES['post_image']['tmp_name'],
		'../modular/post-image/'.$_FILES['post_image']['name']);
	$sql = 'INSERT INTO `constructor_post`(`image_name`, `post_text`)
	VALUES ("'.$_FILES['post_image']['name'].'", "'.$_POST['post_text'].'")';
	$modular_admin->dbQuery($sql);
	echo '<meta http-equiv="refresh" content="0; url=?tab=modular_posts" />';
}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="container pt-5">
		<div class="row">
			<div class="col">
				<input type="file" name="post_image">
			</div>
		</div>
		<div class="row pt-2">
			<div class="col">
				<textarea name="post_text" class="form-control" rows="10"></textarea>
			</div>
		</div>
		<div class="row w-100 pt-3">
			<div class="col text-center">
				<button name="modular_posts_upload" value="Y"
				class="btn btn-outline-success" title="Сохранить">
				<i class="fa fa-floppy-o" aria-hidden="true"></i>
				Сохранить
			</button>
			<a href="?tab=modular_posts"
			class="btn btn-outline-danger" title="Отмена">
			<i class="fa fa-times" aria-hidden="true"></i>
			Отмена
		</a>
	</div>
</div>
</div>
</form>

Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor velit saepe distinctio veritatis alias incidunt vitae molestiae labore consectetur sit! Sequi, molestiae adipisci nisi consequuntur sit, ab id nemo accusamus?