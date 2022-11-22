<?php 
$data = json_decode($_POST['data']);
foreach ($data as $key => $value) {
  if ($value[1]->amount=='0' or $value[1]->amount=='') {$value[1]->amount = '-';}
  if ($value[1]->discount=='0'or $value[1]->discount == '') {$value[1]->discount = '-';}
  if ($value[1]->amountDiscount=='0' or $value[1]->amountDiscount=='') {$value[1]->amountDiscount = '-';}
  if ($value[1]->relativeSize[0]=='0' or $value[1]->relativeSize[0]=='') {$value[1]->relativeSize[0] = '-';}
  if ($value[1]->relativeSize[1]=='0' or $value[1]->relativeSize[1]=='') {$value[1]->relativeSize[1] = '-';}
  if ($value[1]->rollAbsSize=='0' or $value[1]->rollAbsSize=='') {$value[1]->rollAbsSize = '-';}
  if ($value[1]->texture=='0' or $value[1]->texture=='') {$value[1]->texture = '-';}
  include '../includes/cart_item.php';
}

// exit;
?>