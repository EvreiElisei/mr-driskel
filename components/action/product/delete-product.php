<?php
require_once '../core.php';
$name = $_POST['name'];
$delete = "DELETE FROM `products` WHERE `name` = '{$name}'";
$delete_res = $connect->query($delete);
if($delete_res->num_rows >0){
	$_SESSION['deleteError'] = 'товар с указанным именем не существует';
	header("Location: ../../admin_panel.php");
}else{
	unlink("../../../img/uploads/" . $name . ".jpg");
	$_SESSION['deleteError'] = 'товар удален';
	header("Location: ../../admin_panel.php#delete-product");
}