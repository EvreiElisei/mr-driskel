<?php
require_once 'core.php';
$connect = getDatebaseConnection();
$action = $_POST['action'];
switch ($action) {
  case 'user_orders':
    $orders = [];
    $customAddress;
    $order_item;
    $user_id = $_POST['user_id'];
    $get_orders = $connect->query("SELECT *, orders.id AS order_id FROM `orders` JOIN `payment_type` ON orders.payment_type_id = payment_type.id JOIN `order_status` ON orders.order_status_id = order_status.id JOIN `shipping_method` ON orders.shipping_method_id = shipping_method.id WHERE `user_id` = '$user_id'");

    if ($get_orders->num_rows > 0) {
      for ($i = 0; $row = $get_orders->fetch_assoc(); $i++) {
        if ($i == 2) {
        }
        $get_orders_item = $connect->query("SELECT *, order_items.quantity AS order_item_quantity FROM `order_items` JOIN `products` ON order_items.product_id = products.id JOIN `img` ON products.id = img.product_id WHERE `order_id` = '{$row['order_id']}'");
        for ($q = 0; $item_row = $get_orders_item->fetch_assoc(); $q++) {
          $order_item[$i] = $item_row;
        };
        if (!empty($row['address_id'])) {
          $get_address = $connect->query("SELECT * FROM `address` WHERE `id` = '{$row['address_id']}'");
          $rowAddress = $get_address->fetch_assoc();
          $customAddress = $rowAddress['address'];
        } else {
          $customAddress = $row['custom_address'];
        }
        $orders[$i] = [
          'orderDate' => $row['created_at'],
          'orderId' => $row['order_id'],
          'orderStatus' => $row['order_status'],
          'deliveryType' => $row['shipping_method'],
          'paymentType' => $row['payment'],
          'totalSum' => $row['total_amount'],
          'deliveryAddress' => $customAddress,
          'userName' => $row['user_name'],
          'userEmail' => $row['user_email'],
          'userPhone' => $row['user_phone'],
          'orderItem' => $order_item,
        ];
      }
      echo json_encode($orders);
    }
    break;
}
