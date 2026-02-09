<?php
require_once "components/action/core.php";
$connect = getDatebaseConnection();
require_once "components/header.php";
require_once "components/user-form.php";
?>
<main id="catalog" class="main">
  <section class="catalog section">
    <div class="container">
      <div class="bread-crumbs">
        <div class="container">
          <div class="bread-crumbs__inner">
            <a href="../index.php" class="bread-crumbs__link">Главная</a>
            /
            <a href="" class="bread-crumbs__link bread-crumbs__link--active">Каталог</a>

          </div>
        </div>
      </div>
      <h2 class="catalog__title h2">Тату машинки</h2>
      <div class="catalog__filter">
        <div class="catalog__filter-container">
          <div class="catalog__filter-title">
            Цена
          </div>
          <div class="range">
            <input id="minPrice" type="text" class="range__input -min" value="0">
            <span class="range__dash"></span>
            <input id="maxPrice" type="text" class="range__input -max" value="50000"> <!-- В будущем максимальную и минимальную цену нужно будет выставлят по цене товаров -->
          </div>

        </div>

        <div class="custom-checkbox">
          <label for="checkbox-in-stock">Только в наличии</label>
          <input id="checkbox-in-stock" type="checkbox">
        </div>
        <div class="catalog__filter-sort">
          <span class="catalog__filter-text">
            Сортировка
          </span>
          <select name="" id="sortBy" class="catalog__filter-select">
            <option value="">Популярные</option>
            <option value="newest">Новинки</option>
            <option value="price-asc">Сначала дешевле</option>
            <option value="price-desc">Сначала дорогие</option>
          </select>
        </div>
      </div>
      <div class="goods">

      </div>

      <button id="showMore" class="button">Показать еще</button>

    </div>
  </section>


</main>
<?php
include "components/footer.php";
?>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/main.js" type="module"></script>
<script src="js/user-form.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/swiper.js"></script>
</body>

</html>