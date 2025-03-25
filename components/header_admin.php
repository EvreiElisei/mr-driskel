<?php
require_once 'action/core.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
	<title>Document</title>
</head>

<body>
	<header class="header-admin">
		<div class="header-admin__inner container">
			<img src="../img/header/header-logo.svg" alt="">
			<nav class="nav-admin">
				<ul class="nav-admin__list">
					<li class="nav-admin__item"><a href="../index.php" class="nav-admin__link">Главная</a></li>
					<li class="nav-admin__item"><a href="#" class="nav-admin__link">Редактор</a></li>
					<li class="nav-admin__item"><a href="#" class="nav-admin__link">Бренд</a></li>
					<li class="nav-admin__item"><a href="#" class="nav-admin__link">Категория</a></li>
					<li class="nav-admin__item"><a href="#" class="nav-admin__link">Статус</a></li>
				</ul>

			</nav>
			<a href="action/logout.php" class="admin-exit">выход</a>
		</div>
	</header>