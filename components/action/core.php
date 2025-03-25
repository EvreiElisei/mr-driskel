<?php
session_start();
$connect = mysqli_connect('localhost','root','','tatu');
if(!$connect){
	die('Не удалось подключится к базе данных');
}
?>