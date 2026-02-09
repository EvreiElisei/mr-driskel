<?php
session_start();
function getDatebaseConnection($hostName = 'localhost', $userName = 'root', $password = '', $database = 'tatu')
{
	$connect = new mysqli($hostName, $userName, $password, $database);
	if ($connect->connect_error) {
		die('Ошибка подключения' . $connect->connect_error);
	}
	return $connect;
}
