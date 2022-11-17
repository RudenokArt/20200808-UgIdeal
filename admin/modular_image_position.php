 <?php require_once '../modular/connectdb.php'; ?>
 <?php $gallery_image_position = new GalleryImagePosition(); ?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>Позиционирование</title>
  <script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
  <script src="jsfile.js"></script>
  <link rel="stylesheet" href='cssfile.css' type="text/css" >
  <script src="https://use.fontawesome.com/e8a42d7e14.js"></script>
  <!-- VUE.JS -->
  <script src="js/vue.js"></script>
  <!-- ========= -->
</head>
<body>

  <title>Document</title>
</head>
<body>
  &#128101 <span class="login-info"></span>
  <script src="js/login.js"></script>

  <title>image-position</title>
  <style>
   .image_inner {
    display: flex;
    justify-content: center;
    position: relative;
  }
  .image_wrapper {
    display: flex;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.2);
  }
  .image_picture,
  .image_template {
    background-image: url("../modular/templates/<?php echo $gallery_image_position->arr_data['template'] ?>");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    width: 400px;
    height: 400px;
  }
  .image_template {
    position: absolute;
    top: 0;
    left: 0;
    width: 400px;
    height: 300px;
  }
  .image_picture {
    background-image: url("../modular/galery/<?php echo $gallery_image_position->gallery_image['image']?>");
    background-size: contain;
  }


.imagePositionPopUp-preloader_wrapper {
  position: absolute;
  display: none;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.imagePositionPopUp-preloader_inner {
  margin: auto;
  color: grey;
}
</style>
</head>
<body>
  <div class="container pt-5" id="vue-entity">    
    <div class="row justify-content-center">
      <div class="col-4">
        <div class="row h-100">
          <div class="col-12">
            <div class="card h-100 p-2">
              <fieldset>
                <form action="" method="post"></form>
                <legend>
                  <button v-on:click="decrement('vertical_position')" type="button" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-chevron-up" aria-hidden="true"></i>
                  </button>
                  {{vertical_position}} %
                  <button v-on:click="increment('vertical_position')" type="button" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                  </button>
                </legend>
                <input type="range" min="-100" max="100" value="0" class="form-range" v-model="vertical_position">
              </fieldset>
              <fieldset>
                <legend>
                  <button v-on:click="decrement('horizontal_position')" type="button" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                  </button>
                  {{horizontal_position}} %
                  <button v-on:click="increment('horizontal_position')" type="button" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                  </button>
                </legend>
                <input type="range" min="-100" max="100" class="form-range" value="0" v-model="horizontal_position">
              </fieldset>
              <fieldset>
                <legend>
                  <button v-on:click="decrement('image_size')" type="button" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                  </button>
                  {{image_size}} %
                  <button v-on:click="increment('image_size')" type="button" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                  </button>
                </legend>
                <input type="range" class="form-range" min="0" max="200" value="100" v-model="image_size">
              </fieldset>

              <fieldset>
                <legend>
                  <input v-model="image_reflection[0]" type="checkbox" class="form-check-input">
                  <i class="fa fa-arrows-h" aria-hidden="true"></i>
                  <input v-model="image_reflection[1]" type="checkbox" class="form-check-input">
                  <i class="fa fa-arrows-v" aria-hidden="true"></i>
                </legend>
              </fieldset>

              <fieldset>
                <legend>
                  <input type="radio" class="form-check-input" v-model="image_rotate" value="rotate(90deg)">
                  90
                  <sup>0</sup>
                  <input type="radio" class="form-check-input" v-model="image_rotate" value="rotate(180deg)">
                  180
                  <sup>0</sup><br>
                  <input type="radio" class="form-check-input" v-model="image_rotate" value="rotate(270deg)">
                  270
                  <sup>0</sup>
                  <input type="radio" class="form-check-input" v-model="image_rotate" value="rotate(360deg)">
                  360
                  <sup>0</sup>
                </legend>
              </fieldset>

              <div class="p-2">
                <button class="btn btn-outline-success" v-on:click="saveOptions">
                  <i class="fa fa-floppy-o" aria-hidden="true"></i>
                  Сохранить
                </button>
                <a href="modular.php?page_N=<?php echo $_GET['page_N']; echo $gallery_image_position->pagination_filter?>" class="btn btn-outline-danger">
                  <i class="fa fa-times" aria-hidden="true"></i>
                  Отмена
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card">
          <div class="image_wrapper p-5">
            <div class="image_inner">
              <div 
              class="image_picture" 
              v-bind:style="{backgroundSize: image_size+'%',
              backgroundPosition: getImagePosition(),
              transform: image_scale}">
            </div>
            <div class="image_template"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row justify-content-between">
</div>

<div id="imagePositionPopUp-preloader_wrapper" class="imagePositionPopUp-preloader_wrapper">
    <div class="imagePositionPopUp-preloader_inner" id="imagePositionPopUp-preloader_inner">
      <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    </div>
  </div>

<script>
  var app = new Vue({ 
    el: '#vue-entity', 
    data:{ 
      vertical_position: "<?php echo $gallery_image_position->gallery_image['vertical_position'] ?>", 
      horizontal_position: "<?php echo $gallery_image_position->gallery_image['horizontal_position'] ?>",
      image_size: "<?php echo $gallery_image_position->gallery_image['image_size'] ?>",
      image_reflection: [
      Number("<?php echo $gallery_image_position->gallery_image['scale_x'];?>"),
      Number("<?php echo $gallery_image_position->gallery_image['scale_y'];?>"),
      ],
      image_rotate: "<?php echo $gallery_image_position->gallery_image['image_rotate'];?>",
    }, 
    computed: {

      image_scale: function () {
        var arr =[];
        if (this.image_reflection[0] == true) {
          arr[0] = '-1';
        } else {arr[0] = '1';}
        if (this.image_reflection[1] == true) {
          arr[1] = '-1';
        } else {arr[1] = '1';}
        return 'scale('+arr[0]+','+arr[1]+') '+this.image_rotate;
      }
    },
    methods: {
      increment: function (entity) {
        if (entity == 'vertical_position') {
          this.vertical_position++;
        }
        if (entity == 'horizontal_position') {
          this.horizontal_position++;
        }
        if (entity == 'image_size') {
          this.image_size++;
        }
      },
      decrement: function (entity) {
        if (entity == 'vertical_position') {
          this.vertical_position--;
        }
        if (entity == 'horizontal_position') {
          this.horizontal_position--;
        }
        if (entity == 'image_size') {
          this.image_size--;
        }
      },
      getImagePosition () {
        var position = this.horizontal_position+'% '+this.vertical_position+'%';
        return position;
      },
      saveOptions: function () {
        $('#imagePositionPopUp-preloader_wrapper').css({'display':'flex'});
        $.post('modular_image_position.php', {
          image_options: 'Y',
          image_size: this.image_size,
          vertical_position: this.vertical_position,
          horizontal_position: this.horizontal_position,
          scale_x: this.image_reflection[0],
          scale_y: this.image_reflection[1],
          image_rotate: this.image_rotate,
          image_id: "<?php echo $gallery_image_position->gallery_image['id'] ?>",
        } ,function (data) {
          console.log(data);
          console.log(localStorage.getItem('modularGalleryFilter'));
          if (localStorage.getItem('modularGalleryFilter')=='Y') {
            filterImage();
          } else {
          }
          $('#imagePositionPopUp-preloader_wrapper').css({'display':'none'});
          document.location.href = "modular.php?page_N=<?php echo $_GET['page_N']; echo $gallery_image_position->pagination_filter?>";
        });
      },
    },
  });
</script>



<?php 

/**
 * 
 */
class GalleryImagePosition {

  function __construct()  {
    $this->image_options = $this->saveOptions();
    $this->arr_data = $_GET;
    $this->gallery_image = $this->getGalleryImage();
    if (!$this->gallery_image['vertical_position']) {
      $this->gallery_image['vertical_position'] = 50;
    }
    if (!$this->gallery_image['horizontal_position']) {
      $this->gallery_image['horizontal_position'] = 50;
    }
    if (!$this->gallery_image['image_size']) {
      $this->gallery_image['image_size'] = 50;
    }
    $this->pagination_filter = $this->paginationFilter();
  }

  function saveOptions () {
    global $mysqli;
    if (isset($_POST['image_options'])) {
      print_r($_POST);
      $sql = 'UPDATE `constructor_galеry` SET
      `image_size`='.$_POST['image_size'].',
      `vertical_position`='.$_POST['vertical_position'].',
      `horizontal_position`='.$_POST['horizontal_position'].',
      `scale_x`='.$_POST['scale_x'].',
      `scale_y`='.$_POST['scale_y'].',
      `image_rotate`="'.$_POST['image_rotate'].'"
      WHERE `id`='.$_POST['image_id'];
      $mysqli->query($sql);
      print_r($sql);
      exit();
    }
  }

  function getGalleryImage () {
    global $mysqli;
    $sql = $mysqli->query('SELECT * FROM `constructor_galеry` WHERE `id`='.$this->arr_data['image_id']);
    return mysqli_fetch_array($sql);
  }

  function paginationFilter () {
  $filter = '';
  if ($_GET['category']) {
    $filter = $filter.'&category='.$_GET['category'];
  }
  if ($_GET['subcategory']) {
    $filter = $filter.'&subcategory='.$_GET['subcategory'];
  }
  if ($_GET['article_search']) {
    $filter = $filter.'&article_search='.$_GET['article_search'];
  }
  return $filter;
 }
  
}

?>
