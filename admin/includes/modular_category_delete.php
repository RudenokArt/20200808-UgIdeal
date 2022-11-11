
<div class="container pt-5">
	<?php if ($modular_admin->sub_categories_arr or $modular_admin->galery_arr): ?>
		<div class="alert alert-danger" role="alert">
			Удаление не возможно. Категория содержит дочерние элементы.
		</div>
	<?php else: ?>
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-12">

				<i class="fa fa-trash-o" aria-hidden="true"></i>
				<i class="fa fa-times" aria-hidden="true"></i>

			</div>
		</div>
	<?php endif ?>

</div>
