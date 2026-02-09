<?php
require_once 'core.php';
$connect = getDatebaseConnection();
$action = $_POST['action'];

switch ($action) {
  case 'check':
    $product_id = $_POST['id'];
    $check_quantity = $connect->query("SELECT quantity FROM products WHERE id = $product_id");
    if ($check_quantity->num_rows > 0) {
      $row = $check_quantity->fetch_assoc();
      echo json_encode($row['quantity']);
    } else {
    }
    break;
  case 'save-cart':
    $user_id = $_POST['user_id'];
    $cart = $_POST['cart'];
    foreach ($cart as $key => $value) {
      $check_cart = $connect->query("SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $key");
      if ($check_cart->num_rows > 0) {
        echo ($value);
        $row = $check_cart->fetch_assoc();
        $change_cart = $connect->query("UPDATE cart SET quantity = $value WHERE user_id = $user_id AND product_id = $key");
        if ($connect->affected_rows > 0) {
          echo "успешное изменение";
        } else {
          echo "Ничего не поменялось";
        }
      } else {
        $add_cart = $connect->query("INSERT INTO cart( user_id, product_id, quantity) VALUES ( $user_id, $key, $value)");
        if ($add_cart && $connect->affected_rows > 0) {
          echo "Успешное добавление";
        } else {
          echo "Что-то пошло не так";
        }
      }
    }
    break;
  case 'save-wish':
    $user_id = $_POST['user_id'];
    $wish = $_POST['wish'];
    foreach ($wish as $key => $value) {
      $check_wish = $connect->query("SELECT * FROM `wishlist` WHERE `product_id` = '$value' AND `user_id` = '$user_id'");
      if ($check_wish->num_rows == 0) {

        $add_wish = $connect->query("INSERT INTO wishlist(user_id, product_id) VALUES ($user_id, $value)");
        if ($add_wish && $connect->affected_rows > 0) {
          echo "Успешное изменение";
        }
      }
    }
  case 'delete-wish':
    $user_id = $_POST['user_id'];
    $delete_id = $_POST['wish'];
    $check_wish = $connect->query("SELECT * FROM `wishlist` WHERE `product_id` = '$delete_id' AND `user_id` = '$user_id'");
    if ($check_wish->num_rows > 0) {
      $delete_wish = $connect->query("DELETE FROM `wishlist` WHERE `product_id` = '$delete_id' AND `user_id` = '$user_id'");
      if ($delete_wish && $connect->affected_rows > 0) {
        echo 'Успешно удалено';
      }
    }
    break;
  case 'delete-cart':
    $product_id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $delete_cart = $connect->query("DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id");
    if ($connect->affected_rows > 0) {
      echo 'Успешное удаление';
    } else {
      echo 'Ошибка удаления';
    }
    break;
}
