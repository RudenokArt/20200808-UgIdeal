<?php include_once 'header.php';
include_once 'php-index-select.php';
$templates_arr = indexSelect('SELECT * FROM `constractor_templates` ORDER BY `price`');
$image_rotate_arr = ['90'=>90, '180'=>180, '360/0'=>0,];
$image_scale_arr = [
  'NO' => '0', 
  'Y' => '1',
  'X' => '2',
];
?>
<link rel="stylesheet" href="css-new_constructor.css?v=<?php echo time() ?>">
<script src="vue.js"></script>
<!-- ================SlickSlider======================== -->
<link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" 
href="http://kenwheeler.github.io/slick/slick/slick-theme.css">
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
    <div class="col-lg-6 col-md-12 col-sm-12 h5 text-secondary">
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
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 pt-3">
          <i class="fa fa-repeat" aria-hidden="true"></i>
        </div>
        <?php foreach ($image_rotate_arr as $key => $value): ?>
         <label class="col-lg-3 col-md-3 col-sm-6 col-6 pt-3 h6">
          <input v-model="image_rotate" v-bind:value="<?php echo $value ?>" 
          class="form-check-input" type="radio" name="image_rotate">
          <?php echo $key; ?>
          <sup>0</sup>
        </label>
      <?php endforeach ?>
    </div>
    <div class="row h6">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6 pt-3">
        Отражение:
      </div>
     <?php foreach ($image_scale_arr as $key => $value): ?>
      <div class="col-lg-3 col-md-3 col-sm-6 col-6 pt-3">
        <input v-model="image_scale" v-bind:value="<?php echo $value ?>"
        type="radio" name="image_scale">
       <?php echo $value; ?>
      <?php echo $key; ?>
      </div>
     <?php endforeach ?>
   </div>



 </div>
</div>
<p>{{image_scale}}</p>
<p>image_position: {{image_position}}</p>
<p>cookie_data: {{cookie_data}}</p>  
</div>
<pre><?php print_r($templates_arr); ?></pre>

<script>
  new Vue({
    el: '#constructor_modular',

    data: {
      cookie_str: document.cookie,
      current_template: '',
      horizontal_position: 0,
      vertical_position: 0,
      image_size: 100,
      image_rotate: 0,
      image_scale: '0',
    },

    methods: {
      currentTemplateSet: function (template) {
        this.current_template = 'templates/'+template;
        console.log(this.current_template);
      }
    },

    computed: {

      image_position: function () {
        return 'left: '+this.horizontal_position+'%; top: '+this.vertical_position+'%; height: '+this.image_size+'%; width: '+this.image_size+'%; background-image: url("galery/'+this.cookie_data.imageName+'"); transform: rotate('+this.image_rotate+'deg);';
      },

      current_template_css: function () {
        return 'background-image: url("'+this.current_template+'")';
      },

      cookie_data: function () {
        var data = {};
        var arr = this.cookie_str.split(';');
        for (var i = 0; i < arr.length; i++) {
          arr[i] = arr[i].trim();
          var subArr = arr[i].split('=');
          data[subArr[0]] = subArr[1];
        }
        return data;
      },
    },

    mounted: function () {
      var templates_arr = document.getElementsByClassName('constructor_modular-template_tape-item');
      templates_arr[0].click();
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
        infinite: true,
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
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
  });

</script>
<?php include_once 'footer.php'; ?>