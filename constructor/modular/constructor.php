<?php include_once 'header.php';
include_once 'php-index-select.php';
$interiors_arr = indexSelect('SELECT * FROM `wallpaper_interior`');
$templates_arr = indexSelect('SELECT * FROM `constractor_templates` ORDER BY `price`');
$materials_arr = indexSelect('SELECT * FROM `constructor_mat`');
$materials_arr_json = json_encode($materials_arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$size_arr = indexSelect('SELECT * FROM `constructor_size`');
$size_arr_json = json_encode($size_arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$image_rotate_arr = ['360/0'=>0, '90'=>90, '180'=>180, '270'=>270];
$image_reflection_arr = [
  'нет' => 0, 
  'верт.' => 1,
  'гор.' => 2,
];
if ($_FILES) {
  $take = $_FILES['myfile']['tmp_name'];
  $name = $_FILES['myfile']['name'];
  move_uploaded_file($_FILES['customer_image']['tmp_name'], 'galery/customer_image.jpg');
}
$admin_mail = file_get_contents('profile/admin-mail.txt');

?>
<link rel="stylesheet" href="css-new_constructor.css?v=<?php echo time() ?>">
<script src="vue.js"></script>
<!-- ================SlickSlider======================== -->
<link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" 
href="https://kenwheeler.github.io/slick/slick/slick-theme.css">
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!-- ================Bootstrap======================== -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<!-- ===================================================== -->
<div class="container" id="constructor_modular">
  <div class="row justify-content-center">
    <div class="col-lg-12 col-md-11 col-sm-10 col-10 constructor_modular-template_tape">
      <?php foreach ($templates_arr as $key => $value): ?>
        <img v-on:click="currentTemplateSet('<?php echo $value['template'];?>')"
        class="constructor_modular-template_tape-item"
        src="templates/<?php echo $value['template']; ?>" alt="<?php echo $value['template']; ?>">
      <?php endforeach ?>
    </div>
  </div>
  <div class="row pt-5">
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="constructor_modular-galery_image-wrapper">
        <div v-bind:style="image_position" class="constructor_modular-galery_image"></div>
        <div v-bind:style="current_template_css" class="constructor_modular-galery_image-template"></div>
      </div>      
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 text-secondary">
      <div class="row">
        <div class="col-1">
          <i class="fa fa-arrows-h" aria-hidden="true"></i>
        </div>
        <div class="col-11">
          <input type="range" class="form-range mt-1" max="50" min="-50" v-model="horizontal_position">
        </div>
      </div>
      <div class="row">
        <div class="col-1">
          <i class="fa fa-arrows-v" aria-hidden="true"></i>
        </div>
        <div class="col-11">
          <input type="range" class="form-range mt-1" max="50" min="-50" v-model="vertical_position">
        </div>
      </div>
      <div class="row">
        <div class="col-1">
          <i class="fa fa-expand" aria-hidden="true"></i>
        </div>
        <div class="col-11">
          <input type="range" class="form-range mt-1" max="150" min="50" v-model="image_size">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 pt-3">
          <i class="fa fa-repeat" aria-hidden="true"></i>
          Поворот:
        </div>
      </div>
      <div class="row">
        <?php foreach ($image_rotate_arr as $key => $value): ?>
         <label class="col-lg-3 col-md-3 col-sm-6 col-6 pt-3">
          <input v-model="image_rotate" v-bind:value="<?php echo $value ?>" 
          class="form-check-input" type="radio" name="image_rotate">
          <?php echo $key; ?>
          <sup>0</sup>
        </label>
      <?php endforeach ?>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6 pt-3">
        Отражение:
      </div>
      <?php foreach ($image_reflection_arr as $key => $value): ?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 pt-3">
          <label>
            <input v-model="image_reflection" v-bind:value="<?php echo $value ?>"
            class="form-check-input" type="radio" name="image_reflection">
            <?php echo $key; ?>
          </label> 
        </div>
      <?php endforeach ?>
    </div>
    <div class="row pt-2">
     <div class="col-lg-6 col-md-6 col-sm-12 col-12 pt-2">
       Материал:
     </div>
     <div class="col-lg-6 col-md-6 col-sm-12 col-12">
       <select v-model="image_material_index" class="form-select">
         <option v-for="(item, index) in materials_arr" v-bind:value="index">
           {{item.material}}
         </option>
       </select>
     </div>
   </div>

   <div class="row pt-2">
     <div class="col-lg-6 col-md-6 col-sm-12 col-12 pt-2">
       Размер:
     </div>
     <div class="col-lg-6 col-md-6 col-sm-12 col-12">
       <select v-model="template_size_index" class="form-select">
         <option v-for="(item, index) in template_size_arr" v-bind:value="index">
           {{item.size}}
         </option>
       </select>
     </div>
   </div>

   <div class="row border mt-2">
     <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-2">
       Стоимость: {{amount}}
     </div>
     <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-2">
       <span v-if="discount_visible">Скидка: {{discount}} %</span>
     </div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-2">
       Стоимость с учетом скидки: {{total}}
     </div>
   </div>

   <div class="row">
    <hr>
    <div class="col-lg-3 col-md-3 col-sm-6 col-6 p-1">
      <a href="index.php" class="btn btn-outline-info w-100">
        <i class="fa fa-step-backward" aria-hidden="true"></i>
        Назад
      </a>       
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-6 p-1">
      <a href="favorite.php" class="btn btn-outline-info w-100">
        <i class="fa fa-star-o" aria-hidden="true"></i>
        Избранное
      </a>      
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-6 p-1">
      <button v-on:click="OrderDownload" class="btn btn-outline-info w-100">
        <i class="fa fa-cloud-download" aria-hidden="true"></i>
        Скачать
      </button>       
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12 p-1">
      <button v-on:click="popup_mail_visible=true" class="btn btn-outline-info w-100">
        <i class="fa fa-envelope-o" aria-hidden="true"></i>
        Получить на почту
      </button>       
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12 p-1">
      <button class="btn btn-outline-info w-100" v-on:click="popup_file_visible=true">
        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
        Загрузить свое изображение
      </button>       
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12 p-1">
      <button v-on:click="popup_order_visible=true" class="btn btn-outline-info w-100">
        <i class="fa fa-handshake-o" aria-hidden="true"></i>
        Оформить заказ
      </button>       
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12 p-1">
      <button v-on:click="popup_interior_visible=true" id="interior_view_button" class="btn btn-outline-info w-100">
        <i class="fa fa-camera" aria-hidden="true"></i>
        Просмотреть в интерьере
      </button>       
    </div>
  </div>
</div>
</div>
<hr>
<div v-if="preloader_visible" class="constructor_modular-preloader-wrapper">
  <div class="constructor_modular-preloader">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
  </div>
</div>
<a href="order.pdf" id="order_download_link" download="order.pdf"></a>

<div v-if="popup_mail_visible" class="constructor_modular-popup_mail-wrapper">
  <form v-on:submit.prevent="ImageMail" class="constructor_modular-popup_mail p-3">
    <div class="pt-3">
      Ваш Email:
      <input v-model="customer_mail" type="email" required="required" class="form-control">
    </div>
    <div class="text-center">
      <button type="button" v-on:click="popup_mail_visible=false" class="m-3 btn btn-outline-warning" title="Отмена">
        <i class="fa fa-times" aria-hidden="true"></i>
      </button>
      <button class="m-3 btn btn-outline-success" title="Отправить">
        <i class="fa fa-check" aria-hidden="true"></i>
      </button>
    </div>
  </form>
</div>

<div v-if="popup_file_visible" class="constructor_modular-popup_file-wrapper">
  <div class="constructor_modular-popup_file p-3">
    <div class="h4">Загрузка изображения</div>
    <form action="?imageName=customer_image.jpg&discount=0#" enctype="multipart/form-data" method="post">
      <input type="file" name="customer_image" required>
      <div class="text-center">
        <a href="#" v-on:click="popup_file_visible=false" class="btn btn-outline-warning m-3" title="Отмена">
          <i class="fa fa-times" aria-hidden="true"></i>
        </a>
        <button class="btn btn-outline-success m-3" title="Загрузить">
          <i class="fa fa-check" aria-hidden="true"></i>
        </button>
      </div>
    </form>
  </div>
</div>

<div v-if="alert_visible" class="constructor_modular-alert_wrapper">
  <div class="constructor_modular-alert">
    <div class="text-end text-danger h3">
      <i v-on:click="alert_visible=false" class="fa fa-times alert_close_button" aria-hidden="true"></i>
    </div>
    <div class="alert alert-success" role="alert">
      {{alert_text}}
    </div>
  </div>
</div>

<div v-show="popup_interior_visible" class="constructor_modular-popup_interior-wrapper">
  <div class="constructor_modular-popup_interior">
    <div class="text-end text-danger h3 p-3">
      <i v-on:click="popup_interior_visible=false" class="fa fa-times alert_close_button" aria-hidden="true"></i>
    </div>
    <div class="constructor_modular-popup_interior-slider">
      <?php foreach ($interiors_arr as $key => $value): ?>
        <img class="constructor_modular-popup_interior-slider_item" src="../wallpaper/img/interior/<?php echo $value['interior'];?>" v-on:click="currentInteriorSet" alt="">
      <?php endforeach ?>
    </div>
    <div style="min-height: 50vh;">
      <div class="constructor_modular-galery_image-wrapper">
        <div v-bind:style="image_position" class="constructor_modular-galery_image"></div>
        <div v-bind:style="current_template_css" class="constructor_modular-galery_image-template"></div>
      </div> 
      <img class="constructor_modular-popup_interior-interior" v-bind:src="current_interior" alt="">
    </div>  
  </div>
</div>

<div v-if="popup_order_visible" class="constructor_modular-popup_order-wrapper">
  <form v-on:submit.prevent="OrderMail" class="constructor_modular-popup_order p-3">
    <div class="h4">
      Оформление заказа
    </div>
    <div class="pt-3">
      ФИО:
      <input v-model="customer_fio" type="text" class="form-control" required>
    </div>
    <div  class="pt-3">
      Email:
      <input v-model="customer_mail" type="email" class="form-control" required>
    </div>
    <div  class="pt-3">
      тел:
      <input v-model="customer_phone" type="text" class="form-control" required>
    </div>
    <div class="text-center">
      <a href="#" v-on:click="popup_order_visible=false" class="btn btn-outline-warning m-3" title="Отмена">
        <i class="fa fa-times" aria-hidden="true"></i>
      </a>
      <button class="btn btn-outline-success m-3" title="Отправи">
        <i class="fa fa-check" aria-hidden="true"></i>
      </button>
    </div>
  </form>
</div>

</div>


<script>
  new Vue({
    el: '#constructor_modular',

    data: {
      preloader_visible: true,
      popup_interior_visible: false,
      popup_order_visible: false,
      current_interior: "../wallpaper/img/interior/<?php echo $interiors_arr[0]['interior'] ?>",
      popup_file_visible: false,
      alert_text: '',
      alert_visible: false,
      popup_mail_visible: false,
      imageName: '',
      discount: '',
      current_template: '',
      horizontal_position: 0,
      vertical_position: 0,
      image_size: 100,
      image_rotate: 0,
      image_reflection: 0,
      materials_arr_json: '<?php echo $materials_arr_json; ?>',
      image_material_index: 0,
      template_size_arr_json: '<?php echo $size_arr_json; ?>',
      template_size_index: 0,
      customer_mail: '',
      customer_fio: '',
      customer_phone: '',
    },

    methods: {

      currentInteriorSet: function (e) {
        this.current_interior = e.target.src;
      },

      serverRequest: function (url) {
        return fetch(url).then(function (response){
          return response.text();
        });
      },

      OrderMail: async function () {
        this.preloader_visible = true;
        var url = '../php-mail/index.php?Receiver=' + this.customer_mail +
        '&Subject=Заказ на сайте Юг Идеал: ' + 
        '&Attachment=../modular/order.pdf' +
        '&addRecipient=<?php echo $admin_mail;?>' + 
        '&Text=Заказ в приложенном файле';
        this.popup_order_visible = false;
        await this.OrderData();
        var result = await this.serverRequest(url);
        this.alert_text = 'Спасибо. Ваш заказ принят. Наш менеджер свяжется с вами. Подтверждение заказа отправлено на указанную вами почту';
        this.alert_visible = true;
        this.preloader_visible = false;
      },

      ImageMail: async function () {
        this.preloader_visible = true;
        var url = '../php-mail/index.php?Receiver=' + this.customer_mail +
        '&Subject=Изображение с сайта Юг Идеал: ' +
        '&Attachment=../modular/order.pdf' + 
        '&Text=Изображение в приложенном файле';
        this.popup_mail_visible = false;
        await this.OrderData();
        var result = await this.serverRequest(url);
        this.alert_text = 'Изображение отправлено на указанную почту.';
        this.alert_visible = true;
        this.preloader_visible = false;
      },

      OrderDownload: async function () {
        result = await this.OrderData();
        var node = document.getElementById('order_download_link');
        node.click();
      },

      OrderData: async function () {
        this.preloader_visible = true;
        var result = await this.OrderImage();
        var pdf = await this.OrderForm();
        this.preloader_visible = false; 
      },

      OrderForm: function () {
        var size;
        if (this.template_size) {
          size = this.template_size.size;
        } else {
          size = '';
        }
        var url = '../dompdf/modular_order.php?imageName='+this.imageName +
        '&amount='+this.amount +
        '&discount='+this.discount +
        '&total='+this.total +
        '&material='+this.image_material.material +
        '&size='+ size + 
        '&customer_mail='+ this.customer_mail + 
        '&customer_fio='+ this.customer_fio + 
        '&customer_phone='+ this.customer_phone;
        return fetch(url).then(function (response){
          return response.text();
        });
      },


      OrderImage: function () {
        var url = 'OrderImage.php?imageName=' + this.imageName +
        '&template='+this.current_template +
        '&image_rotate=' + this.image_rotate +
        '&image_reflection=' + this.image_reflection +
        '&image_size=' + this.image_size +
        '&horizontal_position=' + this.horizontal_position +
        '&vertical_position=' + this.vertical_position;
        return fetch(url).then(function (response){
          return response.text();
        });
      },

      currentTemplateSet: function (template) {
        this.current_template = template;
      },

      getUrlData: function () {
        var searchFilter = new URLSearchParams(document.location.search);
        this.imageName = searchFilter.get('imageName');
        this.discount = searchFilter.get('discount');
      }
    },

    watch: {
      customer_phone: function () {
        var str = String(this.customer_phone);
        this.customer_phone = str.replace(/[^0-9\-()+]/, '');
      },
      popup_interior_visible: function () {
        $('.constructor_modular-popup_interior').find('.slick-prev').trigger('click');
      }
    },

    computed: {

      discount_visible: function () {
        if (this.discount > 0) {
          return true;
        }
        return false;
      },

      template_size_arr: function () {
        var arr = JSON.parse(this.template_size_arr_json);
        var size_arr = [];
        for (var i = 0; i < arr.length; i++) {
          if (arr[i].template == this.current_template) {
            size_arr.push(arr[i]);
          }
        }
        return size_arr;
      },

      template_size: function () {
        return this.template_size_arr[this.template_size_index];
      },

      amount: function () {
        var result = 0;
        if (this.template_size) {
          result = this.template_size.kof;
          if (this.image_material.kof) {
            result = Math.round(result * (this.image_material.kof/100+1));
          }
        } 
        return result;
      },

      total: function () {
        var result = this.amount;
        if (this.discount > 0) {
          result = result * ((100 - this.discount)/100);
        }
        return Math.round(result);
      },

      materials_arr: function () {
        return JSON.parse(this.materials_arr_json);
      },

      image_material: function () {
        return this.materials_arr[this.image_material_index];
      },


      image_scale: function () {
        if (this.image_reflection == 0) {
          return 'scale(1);';
        }
        if (this.image_reflection == 1) {
          return 'scale(1, -1);';
        }
        if (this.image_reflection == 2) {
          return 'scale(-1, 1);';
        }
      },

      image_position: function () {
        return 'left: '+this.horizontal_position+'%; top: '+this.vertical_position+'%; height: '+this.image_size+'%; width: '+this.image_size+'%; background-image: url("galery/'+this.imageName+'"); transform: rotate('+this.image_rotate+'deg) '+this.image_scale;
      },

      current_template_css: function () {
        return 'background-image: url("templates/'+this.current_template+'")';
      },

    },

    mounted: function () {
      this.getUrlData();
      var templates_arr = document.getElementsByClassName('constructor_modular-template_tape-item');
      templates_arr[0].click();
      this.popup_interior_visible = false;
      this.preloader_visible = false;
    },
  });

$('.constructor_modular-template_tape').slick({
  lazyLoad: 'ondemand',
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 12,
  slidesToScroll: 1,
  responsive: [
  {
    breakpoint: 992,
    settings: {
      slidesToShow: 8,
      slidesToScroll: 1,
      dots: true
    }
  },
  {
    breakpoint: 768,
    settings: {
      slidesToShow: 6,
      slidesToScroll: 1
    }
  },
  {
    breakpoint: 576,
    settings: {
      dots:false,
      slidesToShow: 4,
      slidesToScroll: 1
    }
  }
  ]
});

$('.constructor_modular-popup_interior-slider').slick({
  lazyLoad: 'ondemand',
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 1,
  // autoplay: true,
  responsive: [
  {
    breakpoint: 992,
    settings: {
      slidesToShow: 5,
      slidesToScroll: 1,
      dots: true
    }
  },
  {
    breakpoint: 768,
    settings: {
      slidesToShow: 3,
      slidesToScroll: 1
    }
  },
  {
    breakpoint: 576,
    settings: {
      dots:false,
      slidesToShow: 2,
      slidesToScroll: 1
    }
  }
  ]
});

</script>
<?php include_once 'footer.php'; ?>