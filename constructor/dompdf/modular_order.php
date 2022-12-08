<?php 
//создаем переменную
$html = file_get_contents('modular_order-template.php');
$html = htmlVariablesInsert($html);
$file_path = '../modular/order.pdf';
include_once 'index.php';

function htmlVariablesInsert ($html) {
  if ($_GET['imageName']) {
    $html = str_replace('imageName', $_GET['imageName'], $html);
  }
  if ($_GET['material']) {
    $html = str_replace('material', $_GET['material'], $html);
  }
  if ($_GET['size']) {
    $html = str_replace('size', $_GET['size'], $html);
  } else {
    $html = str_replace('size', '', $html);
  }
  if ($_GET['amount']) {
    $html = str_replace('amount', $_GET['amount'], $html);
  } else {
    $html = str_replace('amount', '', $html);
  }
  if ($_GET['discount']) {
    $html = str_replace('discount', $_GET['discount'], $html);
  } else {
    $html = str_replace('discount', '', $html);
  }
  if ($_GET['total']) {
    $html = str_replace('total', $_GET['total'], $html);
  } else {
    $html = str_replace('total', '', $html);
  }
  return $html;
}


?>