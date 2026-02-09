<?php
require_once 'core.php';
$connect = getDatebaseConnection();
$data = json_decode($_POST['data'], true);
$address;
$last_id;
if (!empty($data['address_id'])) {
  $address = 'address_id';
} else {
  $address = 'custom_address';
}
$create_order = $connect->query("INSERT INTO `orders`(`user_id`, `user_name`, `user_email`, `user_phone`, `total_amount`, `payment_type_id`, `$address`, `shipping_method_id` ) VALUES ('{$data['user']['id']}','{$data['user']['name']}','{$data['user']['email']}','{$data['user']['phone']}','{$data['total_amount']}','{$data['payment']}','{$data[$address]}', '{$data['delivery_type_id']}')");
if ($connect->affected_rows > 0) {
  $last_id = $connect->insert_id;
  foreach ($data['cart'] as $key => $value) {

    $change_products = $connect->query("UPDATE `products` SET `quantity` = GREATEST(0, `quantity` - '$value') WHERE `id` = '$key'");
    $delete_cart = $connect->query("DELETE FROM `cart` WHERE `product_id` = '$key' AND `user_id` = '{$data['user']['id']}'");
    if ($connect->affected_rows > 0) {

      $get_order_item = $connect->query("INSERT INTO `order_items`(`order_id`, `product_id`, `quantity`) VALUES ('$last_id','$key','$value')");
    }
  }
}

echo 'success';
