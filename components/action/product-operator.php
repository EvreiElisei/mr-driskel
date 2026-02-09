<?php
require_once('core.php');

function redirect()
{
  header('Location: ../admin_panel.php');
}
function addProduct() // добавить множественное добавление изображений
{
  $connect = getDatebaseConnection();
  $name = $_POST['name'] ?? "";
  $price = $_POST['price'] ?? "";
  $status = $_POST['status'] ?? "";
  $tmp_img = $_FILES['img']['tmp_name'] ?? "";
  $img_name = $_FILES['img']['name'] ?? "";
  $brand_id = $_POST['brand_id'];
  $types_id = $_POST['product_type_id'];
  $short_descr = $_POST['short_descr'];
  $descr = $_POST['descr'];
  $attributes = $_POST['attributes'] ?? "";
  $add_product = $connect->query("INSERT INTO `products`(`name`, `price`, `status`, `brand_id`, `types_id`, `description`, `short_description`) VALUES ('$name','$price','$status','$brand_id','$types_id', '$descr', '$short_descr')");
  print_r($_POST);
  echo "<br>";
  print_r($add_product);
  $product_id = $connect->insert_id;
  $add_img = $connect->query("INSERT INTO `img`(`img_name`, `product_id`) VALUES ('$img_name','$product_id')");
  $num = 0;
  foreach ($attributes as $attribute_id => $value) {
    if (!empty($value)) {
      $num += $connect->query("INSERT INTO `product_attrybute_values` (`product_id`, `attribute_id`, `value`) VALUES ('$product_id', '$attribute_id', '$value')");
    }
  }
  if ($add_product && $add_img && $num) {
    move_uploaded_file($tmp_img, "../../img/uploads/" . $img_name);
    $_SESSION['responseToAction']['product']['add'] = 'товар добавлен';
    redirect();
  } else {
    $_SESSION['responseToAction']['product']['add'] = 'не пашет';
    redirect();
  }
}

function deleteProduct()  // добавить множественное удаление изображений
{
  $connect = getDatebaseConnection();
  $product_id = $_POST['product_id'];
  $select_img_name = $connect->query("SELECT `img_name` FROM `img` WHERE `product_id` = '$product_id'");
  if ($select_img_name->num_rows) {
    $row = $select_img_name->fetch_assoc();
    print_r($row);
    unlink("../../img/uploads/" . $row['name']);
    $delete_img = $connect->query("DELETE FROM `img` WHERE `product_id` = '$product_id'");
  }

  $delete_attributes = $connect->query("DELETE FROM `product_attrybute_values` WHERE `product_id` = '$product_id'");
  $delete_product = $connect->query("DELETE FROM `products` WHERE `id` = '$product_id'");
  if ($delete_product->num_rows != 0) {
    $_SESSION['responseToAction']['product']['delete'] = 'товар с указанным именем не существует';
    redirect();
  } else {

    $_SESSION['responseToAction']['product']['delete'] = 'товар удален';
    redirect();
  }
}

function updateProduct()
{
  $connect = getDatebaseConnection();
  $product_id = $_POST['product_id'];
  $new_name = $_POST['new_name'] ?? '';
  $new_price = $_POST['new_price'] ?? '';
  $new_status = $_POST['new_status'] ?? '';
  $new_descr = $_POST['new_descr'] ?? '';
  $new_short_descr = $_POST['new_short_descr'];
  $new_brand_id = $_POST['new_brand_id'] ?? '';
  $new_type_id = $_POST['new_product_type_id'] ?? '';
  $new_attrybutes = $_POST['new_attributes'] ?? '';
  $tmp_img = $_FILES['new-img']['tmp_name'] ?? '';
  $new_img = $_FILES['new-img']['name'] ?? '';

  $update = "UPDATE `products` SET `name` = COALESCE(NULLIF('$new_name', ''), `name`), `price` = COALESCE(NULLIF('$new_price', ''), `price`), `status` = COALESCE(NULLIF('$new_status', ''), `status`), `description` = COALESCE(NULLIF('$new_descr', ''), `description`), `short_description` = COALESCE(NULLIF('$new_short_descr', ''), `short_description`), `brand_id` = COALESCE(NULLIF('$new_brand_id', ''), `brand_id`) WHERE `id` = '$product_id'";
  $update_res = $connect->query($update);

  if ($update_res) {
    $get_img = $connect->query("SELECT `id`, `name` FROM `img` WHERE `product_id` = '$product_id'");
    $img = $get_img->fetch_assoc();
    if ($img['name'] != $new_img) {
      if (file_exists("../../img/uploads/" . $img['name'])) {
        unlink("../../img/uploads/" . $img['name']);
      }
    }
    foreach ($new_attrybutes as $attribute_id => $value) {
      if (!empty($value)) {
        $connect->query("UPDATE `product_attrybute_values` SET `value` = '$value' WHERE `attribute_id` = '$attribute_id'");
      }
    }
    $change_img = $connect->query("UPDATE `img` SET `name` = COALESCE(NULLIF('$new_img', ''), `name`) WHERE `id` = '{$img['id']}'");
    move_uploaded_file($tmp_img, "../../img/uploads/" . $new_img);
    $_SESSION['responseToAction']['product']['update'] = 'товар обновлен';
    redirect();
  } else {
    $_SESSION['responseToAction']['product']['update'] = 'не пашет';
    redirect();
  }
}

switch ($_POST['action']) {
  case 'add':
    addProduct();
    break;
  case 'delete':
    deleteProduct();
    break;
  case 'update':
    updateProduct();
    break;
}
