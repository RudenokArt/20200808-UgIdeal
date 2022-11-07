<?php 

if ($_POST['modular_posts_edit']) {
	$modular_admin->dbQuery('UPDATE `constructor_post` 
		SET `post_text`="'.$_POST['post_text'].'" WHERE `id`='.$_POST['id']);
	echo '<meta http-equiv="refresh" content="0; url=?tab=modular_posts" />';
}

?>

<form action="" method="post">
	<?php foreach ($modular_admin->posts_arr as $key => $value): ?>
		<div class="container pt-5">
			<div class="row justify-content-center">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<?php if ( $value['image_name']): ?>
						<img src="../modular/post-image/<?php echo $value['image_name'];?>"
						alt="<?php echo $value['image_name'];?>">
					<?php endif ?>
					<input type="hidden" name="id" value="<?php echo $value['id'];?>">					
				</div>
				<div class="col-lg-8 col-md-6 col-sm-12">
					<textarea name="post_text" rows="10" class="form-control"><?php echo $value['post_text'];?></textarea>
				</div>
			</div>
			<div class="row w-100 pt-5">
				<div class="col text-center">
					<button name="modular_posts_edit" value="Y"
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
<?php endforeach ?>
</form>
