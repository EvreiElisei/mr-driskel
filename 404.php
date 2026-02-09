<?php
require_once './components/header.php';
?>

<main class="main main--404">
	<div class="f404">
		<div class="f404__inner container ">
			<div class="f404__content">
				<h3 class="f404__title h3">
					Ошибка 404!
				</h3>
				<p class="f404__text">Эта страница не найдена, мы уже работаем, чтобы ее восстановить!</p>
				<a href="index.php" class="404__btn button button--accent">
					Вернуться на главную
				</a>

			</div>
			<img src="./img/404/404.png" alt="404 смешная картинка" class="404__img">
		</div>
	</div>
</main>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/user-form.js"></script>
<script src="js/main.js" type="module"></script>
<?php
require_once './components/footer.php';
?>
</body>

</html>