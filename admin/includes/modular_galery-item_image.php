<div class="modular_galery-image_wrapper">
	<?php 
	if (!$value['vertical_position']) {
		$value['vertical_position'] = 50;
	}
	if (!$value['horizontal_position']) {
		$value['horizontal_position'] = 50;
	}
	if (!$value['image_size']) {
		$value['image_size'] = 50;
	}
	if ($value['scale_y'] == '1') {
		$value['scale_y'] = '-1';
	} else {$value['scale_y'] = '1';}
	if ($value['scale_x'] == '1') {
		$value['scale_x'] = '-1';
	} else {$value['scale_x'] = '1';}
	?>
	<div style="background-size: <?php echo $value['image_size'];?>%;
	background-position:
	<?php echo $value['horizontal_position'] ?>%
	<?php echo $value['vertical_position'] ?>%;
	transform: scale(<?php echo $value['scale_x'];?>,
		<?php echo $value['scale_y'];?>)
	<?php echo $value['image_rotate'] ?>;
	background-image:url(../modular/galery/<?php echo $value['image'] ?>);"
	class="modular_galery-image"></div>
	<div style="background-image:url(../modular/templates/<?php echo $value['template'] ?>);" class="modular_galery-image_template"></div>
</div>