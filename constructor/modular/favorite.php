<?php include_once 'header.php'; ?>
<link rel="stylesheet" href="css-new_constructor.css">

<div id="favorite-container"></div>
<div class="constructor_modular-preloader-wrapper">
  <div class="constructor_modular-preloader">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
  </div>
</div>
<script>
  $(function () {
    var favoriteArr = JSON.parse(localStorage.getItem('modular')).favorite;
    var sql = 'SELECT * FROM `constructor_galеry` WHERE `id` IN (';
    for (var i = 0; i < favoriteArr.length; i++) {
      if (i != 0) {
        sql = sql + ', ';
      }
      sql = sql + favoriteArr[i];
    }
    sql = sql + ')';
    $.post('favorite-load.php', {data:sql}, function (data) {
      $('#favorite-container').html(data);
      $('.constructor_modular-preloader-wrapper').hide();
    });
  });
</script>
<?php include_once 'footer.php'; ?>