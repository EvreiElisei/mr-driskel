<?php
require_once 'core.php';
$connect = getDatebaseConnection();
$user_id = $_POST['user'];
$need_to_send = implode(',', $_POST['need_to_send']);
$action = $_POST["action"];

switch ($action) {
  case 'cart':
    $get_user_cart = $connect->query("SELECT $need_to_send FROM cart WHERE user_id = $user_id");
    if ($get_user_cart->num_rows > 0) {
      $cart;
      while ($row = $get_user_cart->fetch_assoc()) {
        $cart[$row['product_id']] = (int)$row['quantity'];
      }
      echo json_encode($cart);
    } else {
      echo 'clear';
    }
    break;
  case 'wish':
    $get_user_wish = $connect->query("SELECT $need_to_send FROM wishlist WHERE user_id = $user_id");
    if ($get_user_wish->num_rows > 0) {
      $wish;
      for ($i = 0; $row = $get_user_wish->fetch_assoc(); $i++) {
        $wish[$i] = (int) $row['product_id'];
      }
      echo json_encode($wish);
    } else {
      echo 'clear';
    }
}
