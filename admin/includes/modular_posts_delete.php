<?php 
if ($_POST['modular_posts_delete']) {
	$modular_admin->dbQuery('DELETE FROM `constructor_post` WHERE `id`='.$_POST['id']);
	var_dump(unlink('../modular/post-image/'.$_POST['image_name']));
	echo '<meta http-equiv="refresh" content="0; url=?tab=modular_posts" />';
}
?>

<form action="" method="post">
	<?php foreach ($modular_admin->posts_arr as $key => $value): ?>
		<div class="container pt-5">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<img src="../modular/post-image/<?php echo $value['image_name'];?>"
					class="modular_post_image" alt="">
				</div>
				<div class="col-lg-8 col-md-6 col-sm-12">
					<?php echo $value['post_text']; ?>
				</div>
			</div>

			<div class="row w-100">
				<div class="col text-center">
					<input value="<?php echo $value['image_name'];?>" type="hidden" name="image_name">
					<input value="<?php echo $value['id'] ?>" type="hidden" name="id">
					<button name="modular_posts_delete" value="Y" 
					class="btn btn-outline-danger" title="Сохранить">
					<i class="fa fa-floppy-o" aria-hidden="true"></i>
					Удалить
				</button>
				<a href="?tab=modular_posts"
				class="btn btn-outline-warning" title="Отмена">
				<i class="fa fa-times" aria-hidden="true"></i>
				Отмена
			</a>
		</div>
	</div>

</div>

<?php endforeach ?>
</form>