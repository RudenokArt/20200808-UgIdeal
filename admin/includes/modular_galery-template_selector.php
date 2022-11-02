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