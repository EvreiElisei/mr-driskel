<?php
require_once 'action/core.php';

$show_product = "SELECT * FROM `products` WHERE `id` = '{$_GET['id']}'";
$show_product_res = $connect->query($show_product);
if ($show_product_res->num_rows > 0) {
	$product = $show_product_res->fetch_assoc();
} else {
}
require_once 'header.php';
require_once "user-form.php";
?>
<main class="main">
	<div class="bread-crumbs">
		<div class="container">
			<div class="bread-crumbs__inner">
				<a href="../index.php" class="bread-crumbs__link">Главная</a>
				/
				<a href="" class="bread-crumbs__link">Каталог</a>
				/
				<a href="" class="bread-crumbs__link">Тату машинки</a>
				/
				<a href="#" class="bread-crumbs__link bread-crumbs__link--active"><?= $product['name'] ?></a>
			</div>
		</div>
	</div>
	<section class="product">
		<div class="product__inner container">
			<div class="product__top">
				<div class="product__images">
					<div class="product__img product__img--1"><img src="../img/uploads/marceting1.png" alt=""></div>
					<div class="product__img product__img--2"><img src="../img/uploads/marceting1.png" alt=""></div>
					<div class="product__img product__img--3"><img src="../img/uploads/marceting1.png" alt=""></div>
					<div class="product__img product__img--4"><img src="../img/uploads/marceting1.png" alt=""></div>
					<div class="product__img product__img--5"><img src="../img/uploads/marceting1.png" alt=""></div>
				</div>
				<div class="product__content">
					<h3 class="product__content-title h3">Foxxx Viper Fox Golden Vintage Lot #1 RCA</h3>
					<div class="product__content-info">
						<p class="product__content-price">34 920 ₽</p>
						<p class="product__content-oldprice">36 000</p>
						<p class="product__content-quantity">Наличие: <span>Много</span></p>
					</div>
					<p class="product__content-text">
						Описание: <br>
						Viper - машинка собрана на мощном моторе, рама данной модели сделана из прочного и лёгкого алюминиевого
						сплава. В связи с этим вес данной машины всего 120 грамм
					</p>
					<a href="#" class="product__content-link">
						Работы сделанные этой машинкой
						<span class="underline"></span>
					</a>
					<button class="product__content-btn button button--accent">Добавить в корзину</button>
				</div>
			</div>
			<div class="product__info">
				<div class="product__info-block">
					<h4 class="product__info-title">Описание</h4>
					<p class="product__info-text">
						Viper - машинка собрана на мощном моторе, рама данной модели сделана из прочного и лёгкого алюминиевого
						сплава. В связи с этим вес данной машины всего 120g.
						Данная модель оснащена регулируемым эксцентриком. Для регулировки нужного вам хода иглы просто перемещайте
						ваш держатель в зажиме, вперёд или назад. Так же эксцентрик спроектирован так, что на машине отсутствует
						центробежная тяга, в следствии чего отсутствует вибрация в процессе работы. Под крепление бандажной резинки
						предусмотрен небольшой и удобный штифт снизу.
						Диаметр зажимного болта сделан больше чем на аналогах — так что держатель фиксируется без проблем и лишних
						усилий. Данная модель без труда толкает любые иглы и картриджи.
						Все необходимые рекомендации предусмотрены на прилагаемой к машинке инструкции, вложенной в коробку
						с товаром.
						Машинка подходит как для тату, так и для татуажа.
					</p>
				</div>
				<div class="product__info-block">
					<h4 class="product__info-title">Характеристики</h4>
					<dl class="product__info-list">
						<div class="product__info-list-line">
							<dt>Ход иглы</dt>
							<dd>Универсальная</dd>
						</div>
						<div class="product__info-list-line">
							<dt>Рабочий вольтаж</dt>
							<dd>До 12 V</dd>
						</div>

						<div class="product__info-list-line">
							<dt>Разъем</dt>
							<dd>RCA</dd>
						</div>
						<div class="product__info-list-line">
							<dt>Производитель</dt>
							<dd>Foxxx Irons(Россия)</dd>
						</div>
						<div class="product__info-list-line">
							<dt>Тип</dt>
							<dd>Роторная</dd>
						</div>
						<div class="product__info-list-line">

							<dt>Назначение</dt>
							<dd>Универсальная</dd>
						</div>
					</dl>
				</div>

			</div>
		</div>
	</section>
	<section class="addition">
		<div class="addition__inner container">

		</div>
	</section>

</main>
<?php
require_once 'footer.php';
?>
</body>

</html>