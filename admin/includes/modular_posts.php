<?php 
$modular_admin->posts_arr = $modular_admin->dbQuerySelect('SELECT * FROM `constructor_post`');
?>
<div class="container pt-5">
	<div class="row">
			<div class="col">
				<a href="?page=modular_posts_upload" class="btn btn-outline-primary">
					<i class="fa fa-cloud-upload" aria-hidden="true"></i>
				Добавить пост
				</a>
			</div>
		</div>
	<?php foreach ($modular_admin->posts_arr as $key => $value): ?>
		<div class="row mt-3 p-2 border">
			<div class="col-md-4 col-sm-12">
				<?php echo $value['post_text'];?>
			</div>
			<div class="col-md-4 col-sm-12">
				<?php if ( $value['image_name']): ?>
					<img class="modular_post_image" 
					src="../modular/post-image/<?php echo $value['image_name'];?>"
					alt="<?php echo $value['image_name'];?>">
				<?php endif ?>
			</div>
			<div class="col-md-4 col-sm-12">
				<a href="?page=modular_posts_edit&id=<?php echo $value['id'];?>" class="btn btn-outline-success">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</a>
				<a href="?page=modular_posts_delete&id=<?php echo $value['id'] ?>" class="btn btn-outline-danger">
					<i class="fa fa-trash-o" aria-hidden="true"></i>
				</a>
			</div>
		</div>
	<?php endforeach ?>
</div>