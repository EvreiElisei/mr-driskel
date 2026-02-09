<?php
require_once 'core.php';
$connect = getDatebaseConnection();

if (!empty($_POST["action"])) {
  $action = $_POST['action'];
  $need_to_send = implode(',', $_POST['need_to_send']);
  $get_product;
  switch ($action) {
    case 'marceting':
      $get_product = $connect->query("SELECT $need_to_send FROM products JOIN img ON products.id = img.product_id");

      break;
    case 'mini-basket':
      $arr_id = $_POST['where'];
      if ($arr_id == '') {
        echo 'clear';
      } else {
        $arr_id_str = implode(',', $arr_id);
        $get_product = $connect->query("SELECT $need_to_send FROM products JOIN img ON products.id = img.product_id WHERE products.id IN ($arr_id_str)");
      }
      break;
    case 'catalog':
      $product_type = $_POST['where'];
      $get_product = $connect->query("SELECT $need_to_send
    FROM products
    JOIN img ON products.id = img.product_id WHERE products.types_id = '$product_type'");

      break;
  }
  if ($get_product->num_rows > 0) {
    while ($row = $get_product->fetch_assoc()) {
      $product = $row;
      echo json_encode($product);
    }
  } else {
    echo 'clear';
  }
} else {
}
