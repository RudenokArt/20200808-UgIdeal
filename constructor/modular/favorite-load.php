<?php include_once 'php-index-select.php' ?>
<?php $galeryArr=indexSelect($_POST['data']); ?>

<div class="modular-container">
  <div class="modular-content">
    <h1 style="color:grey; padding: 50px;">
      <i class="fa fa-star-o" aria-hidden="true"></i>
      Избранное
    </h1>
    <div class="modular-galery">
      <?php for ($i=0;$i<sizeof($galeryArr);$i++) { 
        if (!$galeryArr[$i]['vertical_position']) {
          $galeryArr[$i]['vertical_position'] = 50;
        }
        if (!$galeryArr[$i]['horizontal_position']) {
          $galeryArr[$i]['horizontal_position'] = 50;
        }
        if (!$galeryArr[$i]['image_size']) {
          $galeryArr[$i]['image_size'] = 50;
        }
        if ($galeryArr[$i]['scale_y'] == '1') {
          $galeryArr[$i]['scale_y'] = '-1';
        } else {$galeryArr[$i]['scale_y'] = '1';}
        if ($galeryArr[$i]['scale_x'] == '1') {
          $galeryArr[$i]['scale_x'] = '-1';
        } else {$galeryArr[$i]['scale_x'] = '1';}
        $categoryInterior=indexSelect('
          SELECT * FROM `constructor_category` 
          WHERE `category`="'.$galeryArr[$i]['category'].'"');
        if(isset($categoryInterior[0]['interior'])){
          $imageInterior=$categoryInterior[0]['interior'];
        };
        $subCategoryInterior=indexSelect('
          SELECT * FROM `constructor_subcategory` 
          WHERE `subcategory`="'.$galeryArr[$i]['subcategory'].'"');
        if(isset($subCategoryInterior[0]['interior'])){
          $imageInterior=$subCategoryInterior[0]['interior'];
        };
        ?>
        <div class="modular-galery_item-wrapper"
        id="<?php echo $galeryArr[$i]['image'].
        '|'.$galeryArr[$i]['category'].
        '|'.$galeryArr[$i]['subcategory'].
        '|'.$galeryArr[$i]['46x80'].
        '|'.$galeryArr[$i]['discount'].
        '|'.$galeryArr[$i]['template']?>">
        <div class="modular-galery_item">
          <div class="modular-galery_item-interior"
          style="background-image: url(../wallpaper/img/interior/<?php echo $imageInterior ?>);">
          <div class="modular-galery_item-image-wrapper">
            <div class="modular-galery_item-image"
            style="
            background-size: <?php echo $galeryArr[$i]['image_size'];?>%;
            background-position: <?php echo $galeryArr[$i]['horizontal_position'];?>% <?php echo $galeryArr[$i]['vertical_position'];?>%;
            transform: scale(
              <?php echo $galeryArr[$i]['scale_x'];?>,
              <?php echo $galeryArr[$i]['scale_y'];?>
            ) <?php echo $galeryArr[$i]['image_rotate'];?>;
            background-image: url(galery/<?php echo $galeryArr[$i]['image']?>);
            ">
          </div>
          <div class="modular-galery_item-template"
          style="background-image: url(templates/<?php echo $galeryArr[$i]['template']?>);"></div>
        </div>
      </div>
      <div class="modular-galery_item-info">
        <?php if ($galeryArr[$i]['discount']): ?>
          <div class="modular-galery_item-discount">
            - <b><?php echo $galeryArr[$i]['discount'] ?></b> %
          </div>
        <?php endif ?>                    
        <div class="flex-wrapper">
          <div class="modular-galery_item-article">
            АРТИКУЛ:
            <?php 
            $imageArticle=explode('.',$galeryArr[$i]['image']);
            echo $imageArticle[0] ?>
          </div>

          <div class="modulat-galery_item-cart" title="Добавить в избранное">
            <i class="fa fa-heart-o" aria-hidden="true"></i>
            <i class="fa fa-times" aria-hidden="true" style="display: none;"></i>
            <input value="<?php echo $galeryArr[$i]['id']; ?>" type="checkbox">
          </div>

        </div>
        <div class="flex-wrapper">
          <div class="modular-galery_item-button">
            <i class="fa fa-eye" aria-hidden="true"></i>
            Подробнее
          </div>
          <div class="modular-galery_item-category">
            <?php echo $galeryArr[$i]['category']?>
            <?php if ($galeryArr[$i]['subcategory']): ?>
             /<?php echo $galeryArr[$i]['subcategory'] ?>
           <?php endif ?>  
         </div>
       </div>
     </div>
   </div>
 </div>
<? } ?>
</div>
</div>


<script src="js-index.js?v=<?php echo time();?>"></script>