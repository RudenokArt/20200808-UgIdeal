<?php 

var_dump((new OrderImage)->order_image);

/**
 * 
 */
class OrderImage {

  function __construct()  {
    $this->imageName = $_GET['imageName'];
    $this->template_path = 'templates/'.$_GET['template'];
    $this->image_size_kof = $_GET['image_size'] / 100;
    $this->image_rotate = $_GET['image_rotate'];
    $this->image_reflection = $_GET['image_reflection'];
    $this->horizontal_position = $_GET['horizontal_position'] / 100 * 500;
    $this->vertical_position = $_GET['vertical_position'] / 100 * 500;
    $this->src_template = imageCreateFromPng($this->template_path);
    $this->src_template_size = $this->srcTemplateSize();
    $this->image_path = 'galery/'.$this->imageName;
    $this->image_file_type = $this->imageFileType();
    $this->src_image = $this->srcImage();
    $this->src_image_size = $this->srcImageSize();
    $this->order_image_size = $this->orderImageSize();
    $this->order_image_position = $this->orderImagePosition();
    $this->order_image = $this->OrderImage();
  }

  function orderImageSize () {
    if ($this->src_image_size['width'] > $this->src_image_size['height']) {
      $height = round(($this->src_image_size['height'] / $this->src_image_size['width']) * 500);
      return [
        'width' => 500 * $this->image_size_kof,
        'height' => $height * $this->image_size_kof,
      ];
    } else {
      $width = round(($this->src_image_size['width'] / $this->src_image_size['height']) * 500);
      return [
        'height' => 500 * $this->image_size_kof,
        'width' => $width * $this->image_size_kof,
      ];
    }
  }

  function orderImagePosition () {
    if ($this->src_image_size['width'] > $this->src_image_size['height']) {
      $top = (500  * $this->image_size_kof - $this->order_image_size['height']) / 2;
      return [
        'top' => $top + $this->vertical_position,
        'left' => $this->horizontal_position,
      ];
    } else {
      $left = (500  * $this->image_size_kof - $this->order_image_size['width']) / 2;
      return [
        'top' => $this->vertical_position,
        'left' => $left + $this->horizontal_position,
      ];
    }

  }

  function srcTemplateSize () {
    $src = getImageSize($this->template_path);
    return [
      'width' => $src[0],
      'height' => $src[1],
    ];
  }

  function imageFileType () {
    $info = new SplFileInfo($this->image_path);
    return $info->getExtension();
  }

  function srcImageSize () {
    $src = getImageSize($this->image_path);
    if ($this->image_rotate == 90 or $this->image_rotate == 270) {
      return [
        'width' => $src[1],
        'height' => $src[0],
      ];
    }
    return [
      'width' => $src[0],
      'height' => $src[1],
    ];
  }

  function srcImage () {
    if ($this->image_file_type == 'jpg') {
      $image = imageCreateFromJpeg($this->image_path);
    }
    if ($this->image_file_type == 'png') {
      $image = imageCreateFromPng($this->image_path);
    }
    if ($this->image_file_type == 'webp') {
      $image = imageCreateFromWebp($this->image_path);
    }
    if ($this->image_rotate == 90) {
      $image = imagerotate($image, 270, $bgd_color);
    }
    if ($this->image_rotate == 270) {
      $image = imagerotate($image, 90, $bgd_color);
    }
    if ($this->image_rotate == 180) {
      $image = imagerotate($image, 180, $bgd_color);
    }
    if ($this->image_reflection == '2') { // зеркало по горизонтали
      Imageflip($image, IMG_FLIP_HORIZONTAL);
    }
    if ($this->image_reflection == '1') { // зеркало по вертикали
      Imageflip($image, IMG_FLIP_VERTICAL);
    }
    return $image;
  }

  function OrderImage () {

    $orderImage = imagecreatetruecolor(500, 500); // фон
    $white = imagecolorallocate($orderImage, 255, 255, 255); // цвет фона
    imagefill($orderImage, 0, 0, $white);
    $black=imagecolorallocate($orderImage, 0, 0, 0);
    $lightBlue=imagecolorallocate($orderImage, 60, 178, 228);

    imageCopyResized(
      $orderImage,
      $this->src_image,
      $this->order_image_position['left'], // X принимающего,
      $this->order_image_position['top'], // Y принимающего,
      0, // X ориринала,
      0, // Y оригинала,
      $this->order_image_size['width'], // новая ширина,
      $this->order_image_size['height'], // новая высота,
      $this->src_image_size['width'], // оригинальная ширина,
      $this->src_image_size['height'], // оригинальная высота
    );

    imagecopyresized(
      $orderImage,
      $this->src_template,
      0, // X принимающего,
      0, // Y принимающего,
      0, // X ориринала,
      0, // Y оригинала,
      500, // новая ширина,
      500, // новая высота,
      $this->src_template_size['width'], // оригинальная ширина,
      $this->src_template_size['height'], // оригинальная высота
    );

    return imageJPEG($orderImage, "order-image.jpg", 100); // Сохранение рисунка
  }


}



?>