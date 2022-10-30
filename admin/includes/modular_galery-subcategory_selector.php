Подкатегория:
							<select name="subcategory" class="form-select" id="subCategorySelect">
								<?php foreach ($modular_admin->sub_categories_arr as $sub_key => $sub_value): ?>
									<option value="<?php echo $sub_value['subcategory']; ?>" 
										data-category="<?php echo $sub_value['category']; ?>">
										<?php echo $sub_value['subcategory']; ?>
									</option>
								<?php endforeach ?>
							</select>
							<script>
								$(function () {
									var start_category = $('#categorySelect').prop('value');
									subCategorySelect(start_category);
									$('#categorySelect').change(function () {
										subCategorySelect(this.value);
									});
									function subCategorySelect (category) {
										$('#subCategorySelect').prop('value','');
										var select = $('#subCategorySelect').children('option');
										for (var i = 0; i < select.length; i++) {
											var data_category = $(select[i]).attr('data-category');
											if (data_category == category) {
												select[i].style.display = 'block';
												var selectedOption = "<?php echo $modular_admin->modular_image_edit[0]['subcategory'];?>";
												if (selectedOption == select[i].value) {
													select[i].selected = true;
												}
											} else {
												select[i].style.display = 'none';
											}
										}
									}
								});
							</script>
							