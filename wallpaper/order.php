<?php 
include_once 'header.php' ;

function user_data () {
  $arr = $_GET;
  $json=json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  file_put_contents('data/useer_data.json', $json);
}

?>


<link rel="stylesheet" href="css/order.css?<?php echo time() ?>">
<link rel="stylesheet" href="css/data-style.css?<?php echo time() ?>">
<script src="https://unpkg.com/vue"></script>
<div class="wallpaper_order_wrapper">
  <?php if (isset($_GET['user_data'])): ?>
    <?php user_data(); ?>
    <div class="order_prewiew_image" id="order_prewiew_image"></div>
    <div class="order_prewiew_buttons">
      <a href="user_download/order.jpg" download="order">
        <button class="text_color layout_color hover_color">
          <i class="fa fa-cloud-download" aria-hidden="true"></i>
          Скачать
        </button>
      </a>
      <form action="php_mail/order_send.php" method="get" id="order_send">
        <input type="hidden" name="order_send" value="<?php echo $_GET['user_email'] ?>">
      <button name="order_button" class="text_color layout_color hover_color">
        <i class="fa fa-money" aria-hidden="true"></i>
        Заказать
      </button>
      </form>
      <a href="cart.php">
        <button class="hover_color layout_color text_color" >
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          Назад в корзину
        </button>
      </a>
    </div>
    <?php else: ?>
      <form action="order.php" method="get" id="user_data_form">
        <input type="text" name="user_name" class="border_color" placeholder="ФИО">
        <input type="text" name="user_phone" class="border_color" placeholder="тел." >
        <input type="text" name="user_email" class="border_color" placeholder="email" >
        <input type="hidden" name="user_data" value="true">
        <button class="hover_color layout_color text_color" name="user_data_form">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          Оформить заказ
        </button>
        <a href="cart.php">
          <button class="hover_color layout_color text_color" >
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Назад в корзину
          </button>
        </a>
      </form>
    <?php endif ?>
  </div>



  <script src="js/order.js?<?php echo time() ?>"></script>
  <?php include_once 'footer.php' ?>

