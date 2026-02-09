<?php
require_once 'components/action/core.php';
$connect = getDatebaseConnection();
$show_product = "SELECT * FROM `products` WHERE `id` = '{$_GET['id']}'";
$show_product_res = $connect->query($show_product);
if ($show_product_res->num_rows > 0) {
	$product = $show_product_res->fetch_assoc();
	$get_type = $connect->query("SELECT * FROM `product_types` WHERE `id` = '{$product['types_id']}'");
	$type = $get_type->fetch_assoc();
	$get_img = $connect->query("SELECT `img_name` FROM `img` WHERE `product_id` = '{$product['id']}'");
} else {
	// header("Location: 404.php");
}
require_once 'components/header.php';
?>
<main class="main">
	<div class="bread-crumbs">
		<div class="container">
			<div class="bread-crumbs__inner">
				<a href="index.php" class="bread-crumbs__link">Главная</a>
				/
				<a href="" class="bread-crumbs__link">Каталог</a>
				/
				<a href="" class="bread-crumbs__link"><?= $type['name'] ?></a>
				/
				<a href="#" class="bread-crumbs__link bread-crumbs__link--active"><?= $product['name'] ?></a>
			</div>
		</div>
	</div>
	<section class="product">
		<div class="product__inner container">
			<div class="product__top">
				<div class="product__images">
					<?php
					if ($get_img->num_rows > 0) {
						$img = $get_img->fetch_assoc();
					?>
						<div class="product__img product__img--1"><img src="img/uploads/<?= $img['img_name'] ?>" alt=""></div>
						<div class="product__img product__img--2"><img src="img/uploads/<?= $img['img_name'] ?>" alt=""></div>
						<div class="product__img product__img--3"><img src="img/uploads/<?= $img['img_name'] ?>" alt=""></div>
						<div class="product__img product__img--4"><img src="img/uploads/<?= $img['img_name'] ?>" alt=""></div>
						<div class="product__img product__img--5"><img src="img/uploads/<?= $img['img_name'] ?>" alt=""></div>
					<?php
					}
					?>
				</div>
				<div class="product__content">
					<h3 class="product__content-title h3">Foxxx Viper Fox Golden Vintage Lot #1 RCA</h3>
					<div class="product__content-info">
						<p class="product__content-price"><?= $product['price'] - $product['price'] * 0.2 ?> ₽</p>
						<p class="product__content-oldprice"><?= $product['price'] ?></p>
						<p class="product__content-quantity">Наличие: <span>Много</span></p>
					</div>
					<p class="product__content-text">
						Описание: <br>
						<?= $product['short_description'] ?>

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
						<?= $product['description'] ?>
					</p>
				</div>
				<div class="product__info-block">
					<h4 class="product__info-title">Характеристики</h4>
					<dl class="product__info-list">
						<?php
						$get_attrybutes = $connect->query("SELECT * FROM `product_attrybutes` WHERE `type_id` = '{$product['types_id']}'");

						if ($get_attrybutes->num_rows > 0) {
							while ($row = $get_attrybutes->fetch_assoc()) {
								$get_attrybutes_value = $connect->query("SELECT `value` FROM `product_attrybute_values` WHERE `attribute_id` = '{$row['id']}' AND `product_id` = '{$product['id']}'");
								$attrybutes_value = $get_attrybutes_value->fetch_assoc();


						?>
								<div class="product__info-list-line">
									<dt><?= $row['name'] ?></dt>
									<dd><?= $attrybutes_value['value'] ?></dd>
								</div>
						<?php
							}
						}
						?>

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
require_once 'components/footer.php';
?>
<script src="js/user-form.js" type="module"></script>
<script src="js/main.js" type="module"></script>
</body>

</html>