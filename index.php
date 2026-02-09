<?php
require_once "components/action/core.php";
$connect = getDatebaseConnection();
require_once "components/header.php";
require_once "components/user-form.php";
?>


<main id="home-page" class="main">
	<section class="top section">
		<div class="top-slider__inner">
			<div class="top-slide">
				<div class="top-slide__row container">
					<h1 class="top__title">Лучшие товары в мире татуировок</h1>
					<p class="top__descr">Оборудование и расходники для самых ярких и качественных работ</p>
					<button class="top__button button button--accent">Смотреть каталог</button>
				</div>

			</div>
			<div class="top-slide">
				<div class="top-slide__row container">
					<h1 class="top__title"> товары в мире татуировок</h1>
					<p class="top__descr">Оборудование и расходники для самых ярких и качественных работ</p>
					<button class="top__button button button--accent">Смотреть каталог</button>
				</div>

			</div>
			<div class="top-slide">
				<div class="top-slide__row container">
					<h1 class="top__title">Лучшие в мире татуировок</h1>
					<p class="top__descr">Оборудование и расходники для самых ярких и качественных работ</p>
					<button class="top__button button button--accent">Смотреть каталог</button>
				</div>

			</div>
			<div class="top-slide">
				<div class="top-slide__row container">
					<h1 class="top__title">Лучшие товары в татуировок</h1>
					<p class="top__descr">Оборудование и расходники для самых ярких и качественных работ</p>
					<button class="top__button button button--accent">Смотреть каталог</button>
				</div>

			</div>
			<div class="top-slide">
				<div class="top-slide__row container">
					<h1 class="top__title">Лучшие товары в татуировок</h1>
					<p class="top__descr">Оборудование и расходники для самых ярких и качественных работ</p>
					<button class="top__button button button--accent">Смотреть каталог</button>
				</div>

			</div>
		</div>
		<div class="top__navigation container">
			<div class="top__navigation-box ">
				<div class="top__swiper-button swiper-button-prev"></div>

				<div class="top__swiper-pagination swiper-pagination">
					<div class="swiper-pagination-bullets">

					</div>
				</div>
				<div class="top__swiper-button swiper-button-next"></div>
			</div>
		</div>
	</section>
	<section class="marceting section">
		<div class="marceting__container container">
			<nav class="marceting__filters">
				<ul class="marceting__filters-list">
					<li data-f="bestseller" class="marceting__filters-item">
						Хиты продаж
						<span class="marceting__filters-accent"></span>
					</li>
					<li data-f="popular" class="marceting__filters-item">
						Самые популярные
						<span class="marceting__filters-accent"></span>
					</li>
					<li data-f="new" class="marceting__filters-item">
						Новые поступления
						<span class="marceting__filters-accent"></span>
					</li>
					<li data-f="promotion" class="marceting__filters-item">
						Акционные товары
						<span class="marceting__filters-accent"></span>
					</li>
				</ul>
			</nav>
			<div class="goods">

			</div>
			<button id="showMore" class="button">Показать еще</button>
			<button class="marceting__showmore button">Показать ещё</button>
		</div>
	</section>
	<section class="catalog-main section">
		<div class="container">
			<h2 id="main-catalog" class="catalog-main__title section__title">Каталог</h2>
			<div class="catalog-main__inner ">
				<div class="catalog-main__row">
					<a href="./catalog.php?product_type=5" class="catalog-main__card catalog-main__card-1">
						<h3 class="catalog-main__card-title">
							Тату
							наборы
						</h3>
						<img src="img/catalog-main/catalog-tato-kits.png" alt="" class="catalog-main__card-img">
					</a>
					<a href="./catalog.php?product_type=8" class="catalog-main__card catalog-main__card-2">
						<h3 class="catalog-main__card-title">
							Держатели
						</h3>
						<img src="img/catalog-main/catalog-holder.jpg" alt="" class="catalog-main__card-img" width="535" height="271">
					</a>
				</div>
				<div class="catalog-main__row">
					<a href="./catalog.php?product_type=1" class="catalog-main__card catalog-main__card-3">
						<h3 class="catalog-main__card-title">
							Тату машинки
						</h3>
						<img src="img/catalog-main/catalog-tato-machine.jpg" alt="" class="catalog-main__card-img" width="259" height="259">
					</a>
					<a href="./catalog.php?product_type=9" class="catalog-main__card catalog-main__card-4">
						<h3 class="catalog-main__card-title">
							Педали и провода
						</h3>
						<img src="img/catalog-main/catalog-pedals.jpg" alt="" class="catalog-main__card-img">
					</a>
					<a href="./catalog.php?product_type=10" class="catalog-main__card catalog-main__card-5">
						<h3 class="catalog-main__card-title">
							Краски
						</h3>
						<img src="img/catalog-main/catalog-paints.jpg" alt="" class="catalog-main__card-img" width="307" height="266">
					</a>
				</div>
				<div class="catalog-main__row">
					<a href="./catalog.php?product_type=4" class="catalog-main__card catalog-main__card-6">
						<h3 class="catalog-main__card-title">
							Блоки питания
						</h3>
						<img src="img/catalog-main/catalog-power-unit.jpg" alt="" class="catalog-main__card-img" width="440" height="267">
					</a>
					<a href="./catalog.php?product_type=11" class="catalog-main__card catalog-main__card-7">
						<h3 class="catalog-main__card-title">
							Наконечники
						</h3>
						<img src="img/catalog-main/catalog-tip.jpg" alt="" class="catalog-main__card-img" width="273" height="266">
					</a>
					<a href="./catalog.php?product_type=3" class="catalog-main__card catalog-main__card-8">
						<h3 class="catalog-main__card-title">
							Тату иглы
						</h3>
						<img src="img/catalog-main/catalog-needle.jpg" alt="" class="catalog-main__card-img" width="307" height="266">
					</a>
				</div>
				<div class="catalog-main__row">

					<a href="./catalog.php?product_type=6" class="catalog-main__card catalog-main__card-9">
						<h3 class="catalog-main__card-title">
							Защита, ёмкости, расходники
						</h3>
						<img src="img/catalog-main/catalog-consumables.jpg" alt="" class="catalog-main__card-img" width="277" height="240">
					</a>
					<a href="./catalog.php?product_type=12" class="catalog-main__card catalog-main__card-10">
						<h3 class="catalog-main__card-title">
							Аксессуары
						</h3>
						<img src="img/catalog-main/catalog-accessories.jpg" alt="" class="catalog-main__card-img" width="277" height="240">
					</a>
					<a href="./catalog.php?product_type=7" class="catalog-main__card catalog-main__card-11">
						<h3 class="catalog-main__card-title">
							Принтеры и планшеты
						</h3>
						<img src="img/catalog-main/catalog-printer.jpg" alt="" class="catalog-main__card-img" width="439" height="336">
					</a>
				</div>
			</div>

		</div>
	</section>
	<div class="limitless section">
		<div class="limitless__item limitless__item-left">
			<img src="img/limitless/limitless-left.jpg" alt="" class="limitless__img">
			<h3 class="limitless__title limitless__title-left">Краски Lip Nitn</h3>
			<a href="#" class="limitless__link limitless__link-left">Смотреть в каталоге
				<span class="limitless__link--accent"></span>
			</a>
		</div>
		<div class="limitless__item limitless__item-right">
			<img src="img/limitless/limitless-right.jpg" alt="" class="limitless__img">
			<h3 class="limitless__title limitless__title-right">Foxx viper —хит 2021 года</h3>
			<a href="#" class="limitless__link limitless__link-right">Смотреть в каталоге
				<span class="limitless__link--accent"></span>
			</a>
		</div>
	</div>
	<section class="pop-brend section">
		<div class="container">
			<h2 class="pop-brend__title">
				Популятрные бренды
			</h2>
			<div class="pop-brend__swiper swiper">
				<div class="pop-brend__swiper-wrapper swiper-wrapper">
					<div class="pop-brend__slide swiper-slide">
						<div class="pop-brend__row">
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-1.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-2.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-3.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-4.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-5.jpg" alt="" class="pop-brend__img">
							</a>
						</div>
						<div class="pop-brend__row">
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-6.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-7.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-8.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-9.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-10.jpg" alt="" class="pop-brend__img">
							</a>
						</div>
					</div>
					<div class="pop-brend__slide swiper-slide">
						<div class="pop-brend__row">
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-1.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-2.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-3.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-4.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-5.jpg" alt="" class="pop-brend__img">
							</a>
						</div>
						<div class="pop-brend__row">
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-6.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-7.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-8.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-9.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-10.jpg" alt="" class="pop-brend__img">
							</a>
						</div>
					</div>
					<div class="pop-brend__slide swiper-slide">
						<div class="pop-brend__row">
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-1.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-2.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-3.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-4.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-5.jpg" alt="" class="pop-brend__img">
							</a>
						</div>
						<div class="pop-brend__row">
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-6.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-7.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-8.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-9.jpg" alt="" class="pop-brend__img">
							</a>
							<a href="#" class="pop-brend__row-link">
								<img src="img/pop-brend/pop-brend-10.jpg" alt="" class="pop-brend__img">
							</a>
						</div>
					</div>

				</div>

			</div>
			<div class="pop-brend__button-box">
				<div class="pop-brend__button-next swiper-button-next"></div>
				<div class="pop-brend__button-prev swiper-button-prev"></div>
			</div>

		</div>

	</section>
	<section class="about section">
		<div class="about__img">
			<img src="img/about/about.jpg" alt="">
		</div>
		<div class="about__content">
			<div class="about__container">
				<div class="about__body">
					<h2 class="about__title">Тату магазин Mr. Driskell</h2>
					<p class="about__text">Приветствуем вас в Tattoo Mall — в нашем тату магазине собираются энтузиасты
						индустрии,
						профессиональные мастера
						и новички, которые только делают первые шаги в тату искусстве. Мы знаем, насколько важно грамотно и точно
						подобрать
						инструменты для продуктивных тату сеансов, и помогаем быстро найти то, что поможет их сделать именно
						такими.
					</p>
					<p class="about__text">В нашем ассортименте не просто тату оборудование, это буквально целая команда
						из грамотных и действительно эффективных
						помощников на вашем рабочем столе. Пройдя этап долгих разработок и бесчисленных тестов под пристальным
						взглядом
						отечественных машиностроителей, космецевтов и брендов с мировым именем, эти товары нарабатывали опыт
						и каждый
						день
						становились лучше, чтобы показать, на что они способны, и помочь раскрыть ваш потенциал.</p>
					<button class="about__btn button">О компании</button>
				</div>
			</div>

		</div>
	</section>
	<!-- <section class="reviews section">
		<h2 class="reviews__title">
			Отзывы
		</h2>
		<div class="reviews__swiper swiper">
			<div class="reviews__wrapper swiper-wrapper">
				<div class="reviews__slide swiper-slide">
					<img src="img/reviews/reviews-2.jpg" alt="" class="reviews__slide-img">
					<span class="reviews__border"></span>
					<p class="reviews__slide-text">Положили всё необходимое + наклейку, скидочную карту и леденцы, неожиданным
						было то, что держатель и клип-корд в наборе
						пришёл не того цвета, меня даже порадовало, вот только разочаровала одна упакованная игла, которую
						не получилось
						адекватно достать</p>
					<p class="reviews__slide-name">@Velli7350</p>
					<span class="reviews__border"></span>
				</div>
				<div class="reviews__slide swiper-slide">
					<img src="img/reviews/reviews-1.jpg" alt="" class="reviews__slide-img">
					<span class="reviews__border"></span>
					<p class="reviews__slide-text">Заказал первый раз, заказ пришёл во время, упаковано все отлично,
						все заказанное соответствует описанию, но есть один
						маленький ньюанс, коробки все мятые, толи при упаковке так случилось толи на складе так отномятся
						с товаром, в целом
						всем доволен, буду заказывать ещё, сайт-магазин рекомендую к покупкам, в целом всем доволен, буду
						заказывать ещё</p>
					<p class="reviews__slide-name">@Velli7350</p>
					<span class="reviews__border"></span>
				</div>
				<div class="reviews__slide swiper-slide">
					<img src="img/reviews/reviews-2.jpg" alt="" class="reviews__slide-img">
					<span class="reviews__border"></span>
					<p class="reviews__slide-text">Положили всё необходимое + наклейку, скидочную карту и леденцы, неожиданным
						было то, что держатель и клип-корд в наборе
						пришёл не того цвета, меня даже порадовало, вот только разочаровала одна упакованная игла, которую
						не получилось
						адекватно достать</p>
					<p class="reviews__slide-name">@Velli7350</p>
					<span class="reviews__border"></span>
				</div>
				<div class="reviews__slide swiper-slide">
					<img src="img/reviews/reviews-1.jpg" alt="" class="reviews__slide-img">
					<span class="reviews__border"></span>
					<p class="reviews__slide-text">Положили всё необходимое + наклейку, скидочную карту и леденцы, неожиданным
						было то, что держатель и клип-корд в наборе
						пришёл не того цвета, меня даже порадовало, вот только разочаровала одна упакованная игла, которую
						не получилось
						адекватно достать</p>
					<p class="reviews__slide-name">@Velli7350</p>
					<span class="reviews__border"></span>
				</div>
				<div class="reviews__slide swiper-slide">
					<img src="img/reviews/reviews-2.jpg" alt="" class="reviews__slide-img">
					<span class="reviews__border"></span>
					<p class="reviews__slide-text">Заказал первый раз, заказ пришёл во время, упаковано все отлично,
						все заказанное соответствует описанию, но есть один
						маленький ньюанс, коробки все мятые, толи при упаковке так случилось толи на складе так отномятся
						с товаром, в целом
						всем доволен, буду заказывать ещё, сайт-магазин рекомендую к покупкам, в целом всем доволен, буду
						заказывать ещё</p>
					<p class="reviews__slide-name">@Velli7350</p>
					<span class="reviews__border"></span>
				</div>
				<div class="reviews__slide swiper-slide">
					<img src="img/reviews/reviews-1.jpg" alt="" class="reviews__slide-img">
					<span class="reviews__border"></span>
					<p class="reviews__slide-text">Заказал первый раз, заказ пришёл во время, упаковано все отлично,
						все заказанное соответствует описанию, но есть один
						маленький ньюанс, коробки все мятые, толи при упаковке так случилось толи на складе так отномятся
						с товаром, в целом
						всем доволен, буду заказывать ещё, сайт-магазин рекомендую к покупкам, в целом всем доволен, буду
						заказывать ещё</p>
					<p class="reviews__slide-name">@Velli7350</p>
					<span class="reviews__border"></span>
				</div>
				<div class="reviews__slide swiper-slide">
					<img src="img/reviews/reviews-2.jpg" alt="" class="reviews__slide-img">
					<span class="reviews__border"></span>
					<p class="reviews__slide-text">Заказал первый раз, заказ пришёл во время, упаковано все отлично,
						все заказанное соответствует описанию, но есть один
						маленький ньюанс, коробки все мятые, толи при упаковке так случилось толи на складе так отномятся
						с товаром, в целом
						всем доволен, буду заказывать ещё, сайт-магазин рекомендую к покупкам, в целом всем доволен, буду
						заказывать ещё</p>
					<p class="reviews__slide-name">@Velli7350</p>
					<span class="reviews__border"></span>
				</div>
				<div class="reviews__slide swiper-slide">
					<img src="img/reviews/reviews-1.jpg" alt="" class="reviews__slide-img">
					<span class="reviews__border"></span>
					<p class="reviews__slide-text">Заказал первый раз, заказ пришёл во время, упаковано все отлично,
						все заказанное соответствует описанию, но есть один
						маленький ньюанс, коробки все мятые, толи при упаковке так случилось толи на складе так отномятся
						с товаром, в целом
						всем доволен, буду заказывать ещё, сайт-магазин рекомендую к покупкам, в целом всем доволен, буду
						заказывать ещё</p>
					<p class="reviews__slide-name">@Velli7350</p>
					<span class="reviews__border"></span>
				</div>
			</div>
			<div class="reviews__btn-container">
				<div class="reviews__next swiper-button-next"></div>
				<div class="reviews__prev swiper-button-prev"></div>
			</div>

			<div class="reviews__pagination swiper-pagination"></div>
		</div>
	</section> -->
	<section class="newsletter section">
		<div class="newsletter__content">
			<div class="newsletter__container">
				<div class="newsletter__body">
					<h2 class="newsletter__title">Узнавайте первыми</h2>
					<p class="newsletter__subtitle">Подпишитесь на новостную рассылку с самыми интересными новостями и акциями
					</p>
					<form action="#" class="newsletter__form">
						<label for="" class="newsletter__label">Эл. почта</label>
						<input type="email" class="newsletter__input" placeholder="Figur@mail.ru">
						<label for="" class="newsletter__label">Имя</label>
						<input type="text" class="newsletter__input" placeholder="Введите имя">

						<div class="newsletter__checkbox-box">
							<input type="checkbox" class="newsletter__checkbox">
							<span class="newsletter__checkbox-style"></span>
							<label for="" class="newsletter__label--checkbox">Вы соглашаетесь на обработку ваших персональных
								данных</label>
						</div>

						<button type="submit" class="newsletter__btn button button--accent">Подписаться</button>

					</form>
				</div>
			</div>
		</div>
		<div class="newsletter__img">
			<img src="img/newsletter/newslatter.jpg" alt="">
		</div>
	</section>
</main>
<?php
include "components/footer.php";
?>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/user-form.js" type="module"></script>
<script src="js/slider-top.js"></script>
<!-- <script src="js/marceting-card.js"></script> -->
<script src="js/main.js" type="module"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/wish.js" type="module"></script>
<script src="js/marceting-filter.js"></script>
<script src="js/marceting-show.js"></script>
<script src="js/swiper.js" type="module"></script>

</body>

</html>