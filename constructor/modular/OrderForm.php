<?php 

print_r((new OrderForm)->template_path);

/**
 * 
 */
class OrderForm {

  function __construct()  {
    $this->imageName = $_GET['imageName'];
    $this->template_path = 'templates/'.$_GET['template'];
    $this->src_template = imageCreateFromPng($this->template_path);
    $this->src_template_size = $this->srcTemplateSize();
    $this->image_path = 'galery/'.$this->imageName;
    $this->image_file_type = $this->imageFileType();
    $this->src_image = $this->srcImage();
    $this->src_image_size = $this->srcImageSize();
    $this->order_image_size = $this->orderImageSize();
    $this->OrderImage();
    
  }

  function orderImageSize () {
    $height = ($this->src_image_size['height']/$this->src_image_size['width']) * 500;
    return [
      'width' => 500,
      'height' => $height,
    ];
  }

   function srcTemplateSize () {
    $src = getImageSize($this->template_path);
    return [
      'width' => $src[0],
      'height' => $src[1],
    ];
  }

  function srcImageSize () {
    $src = getImageSize($this->image_path);
    return [
      'width' => $src[0],
      'height' => $src[1],
    ];
  }

  function imageFileType () {
    $info = new SplFileInfo($this->image_path);
    return $info->getExtension();
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
      0, // X принимающего,
      0, // Y принимающего,
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

    imageJPEG($orderImage, "order-image.jpg", 100); // Сохранение рисунка
  }


}



?>