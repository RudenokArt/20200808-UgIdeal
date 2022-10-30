
<div class="cart_item">
  <div class="cart_item_image" 
  style="background-image: url(img/wallpaper/<?php echo $value[1]->image ?>);">
  <img src="img/texture/<?php echo $value[1]->texture ?>">
</div>
<div class="cart_item-info">
  <table>
    <tr>
      <td>Категория:</td>
      <td colspan="2"><?php echo $value[1]->category ?></td>
      <td></td>
    </tr>
    <tr>
      <td>Подкатегория:</td>
      <td colspan="2"><?php echo $value[1]->subcategory ?></td>
      <td></td>
    </tr>
    <tr>
      <td>Фотообои:</td>
      <td colspan="2"><?php echo $value[1]->imageName ?></td>
      <td></td>
    </tr>
    <tr>
      <td>Артикул:</td>
      <td colspan="2"><?php echo explode('.', $value[1]->image)[0] ?></td>
      <td></td>
    </tr>
    <tr>
      <tr>
        <td>Ширина:</td>
        <td><?php echo $value[1]->relativeSize[0] ?></td>
        <td>см.</td>
      </tr>
      <tr>
        <td>Высота:</td>
        <td><?php echo $value[1]->relativeSize[1] ?></td>
        <td>см.</td>
      </tr>
      <tr>
        <td>Рулон:</td>
        <td><?php echo $value[1]->rollAbsSize ?></td>
        <td>см.</td>
      </tr>
      <tr>
        <td>Фактура:</td>
        <td colspan="2"><?php echo $value[1]->texture ?></td>
        <td></td>
      </tr>
      <tr>
        <td>Стоимость:</td>
        <td><?php echo $value[1]->amount ?></td>
        <td>руб.</td>
      </tr>
      <tr>
        <td>Размер скидки:</td>
        <td><?php echo $value[1]->discount ?></td>
        <td>%</td>
      </tr>
      <tr>
        <td>Со скидкой:</td>
        <td><?php echo $value[1]->amountDiscount ?></td>
        <td>руб.</td>
      </tr>
    </table>
    <div class="button_block">
      <div>
        <button class="layout_color hover_color" title="редактировать"
        value="<?php echo $value[0] ?>" name="item_edit">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </button>
      </div>
      <div>
        <button class="layout_color hover_color" title="удалить" 
        value="<?php echo $value[0] ?>" name="item_delete">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
      </div>
      <div>
        <label title="в заказ" class="order_add layout_color">
          <span class="text_color layout_color">
            <i class="fa fa-check layout_color" aria-hidden="true"></i>
          </span>
          <input type="checkbox" value="<?php echo $value[0] ?>"
          <?php if ($value[1]->amountDiscount > 0): ?>
            checked = "checked"
          <?php endif ?>
           name="order_add">
        </label>
      </div>
    </div>
  </div>
</div>