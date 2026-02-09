<?php
require_once 'components/header.php';
?>
<main class="main">
  <div class="user">
    <div class="container">
      <div class="user__inner">
        <div class="user-right">
          <ul class="user-menu">
            <li class="user-menu__item">
              <a href="./user_change-aut.php" class="user-menu__link">Личные данные</a>
            </li>
            <li class="user-menu__item">
              <a href="./wish.php" class="user-menu__link">Избранное</a>
            </li>
            <li class="user-menu__item">
              <a href="./user_orders.php" class="user-menu__link -active">Мои заказы</a>
            </li>
            <li class="user-menu__item">
              <button class="user-menu__link" data-js-user-exit>Выход</button>
            </li>
          </ul>
        </div>
        <div class="user-left">
          <h3 class="user__title">Мои заказы</h3>
          <div class="orders-list">
            <div class="orders-list__header">
              <div class="orders-list__cell">
                Дата
              </div>
              <div class="orders-list__cell">
                Номер
              </div>
              <div class="orders-list__cell">
                Статус
              </div>
              <div class="orders-list__cell">
                Способ получения
              </div>
              <div class="orders-list__cell">
                Способ оплаты
              </div>
              <div class="orders-list__cell">
                Сумма
              </div>
            </div>
            <div class="orders-list__inner">
              <div class="orders-list__container">
                <div class="orders-list__row">
                  <div class="orders-list__cell">
                    11.05.2025
                  </div>
                  <div class="orders-list__cell">
                    1243
                  </div>
                  <div class="orders-list__cell">
                    В обработке
                  </div>
                  <div class="orders-list__cell">
                    Филиал магазина
                  </div>
                  <div class="orders-list__cell">
                    Картой
                  </div>
                  <div class="orders-list__cell _price">
                    1830 р.
                  </div>
                  <div class="orders-list__more">

                  </div>
                </div>
                <div class="order-list__details">
                  <section class="order-details">
                    <div class="order-details__info">
                      <h4 class="order-details__title">
                        Заказ № <span class="orders-number"></span>
                        ОТ
                      </h4>
                      <section>
                        <h4 class="order-details__subtitle h4">Доставка:</h4>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Способ доставки:</div>
                          <div class="order-details__cell ">Забрать в магазине</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Адрес:</div>
                          <div class="order-details__cell">
                            г.Омск, пр-кт Карла Маркса, д.31</div>
                        </div>
                      </section>
                      <section>
                        <h4 class="order-details__subtitle h4">Получатель</h4>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Имя</div>
                          <div class="order-details__cell ">Елисей Евгеньевич</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Телефон</div>
                          <div class="order-details__cell">
                            79012639748</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">E-mail:</div>
                          <div class="order-details__cell">elisej@bk.ru</div>
                        </div>
                      </section>
                      <section>
                        <h4 class="order-details__subtitle h4">Стоимость</h4>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Сумма заказа:</div>
                          <div class="order-details__cell ">10078</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Доставка</div>
                          <div class="order-details__cell">бесплатно</div>
                        </div>
                        <div class="order-details__row _final">
                          <div class="order-details__cell _head">Итого:</div>
                          <div class="order-details__cell">1232 р.</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Способ оплаты</div>
                          <div class="order-details__cell">Наличными при получении</div>
                        </div>
                      </section>
                    </div>
                    <section class="order-details__products">
                      <h4 class="order-details__subtitle">Ваш заказ:</h4>
                      <div class="product-table">
                        <div class="product-table__row _head">
                          <div class="product-table__cell">
                            Наименование
                          </div>
                          <div class="product-table__cell">
                            Цена
                          </div>
                          <div class="product-table__cell">
                            Количество
                          </div>
                          <div class="product-table__cell">
                            Сумма
                          </div>
                        </div>
                        <div class="product-table__row">
                          <div class="product-table__cell _img">
                            <a href="#"><img src="img/uploads/dragonhawk.jpg" alt=""></a>

                          </div>
                          <div class="product-table__cell _name">
                            <div class="product-table__name"><a href="#">пукркуы</a></div>
                            <div class="product-table__id">231223</div>
                          </div>
                          <div class="product-table__cell _price">
                            123123 р
                          </div>
                          <div class="product-table__cell _quantity">
                            1
                          </div>
                          <div class="product-table__cell _price">
                            34234 р
                          </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
include "components/footer.php";
?>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/user-form.js" type="module"></script>

<!-- <script src="js/marceting-card.js"></script> -->
<script src="js/main.js" type="module"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/orders.js" type="module"></script>


</body>

</html>