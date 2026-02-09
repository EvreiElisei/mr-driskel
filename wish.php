<?php
require_once 'components/header.php';
$connect = getDatebaseConnection();
require_once "components/user-form.php";
?>
<main id="wish" class="main">
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
      <div class="goods">

      </div>

      <button id="showMore" class="button visually-hidden">Показать еще</button>

    </div>
  </section>


</main>
<?php
include "components/footer.php";
?>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/main.js" type="module"></script>
<script src="js/user-form.js" type="module"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/swiper.js" type="module"></script>
</body>

</html>