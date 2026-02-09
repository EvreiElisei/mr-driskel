<?php
require_once "components/action/core.php";
$connect = getDatebaseConnection();
require_once "components/header.php";
require_once "components/user-form.php";
?>


<main id="big-basket" class="main">
  <div class="bread-crumbs">
    <div class="container">
      <div class="bread-crumbs__inner">
        <a href="../index.php" class="bread-crumbs__link">Главная</a>
        /
        <a href="" class="bread-crumbs__link bread-crumbs__link--active">Корзина</a>


      </div>
    </div>
  </div>

  <div class="big-basket container">
    <h2 class="big-basket__title h2">
      Корзина
    </h2>
    <div class="big-basket__inner">
      <div class="big-basket__right">
        <div class="goods-box">
          <div class="goods-box__header border-special">
            <div class="goods-box__cell -name">Наименование</div>
            <div class="goods-box__cell -price">Цена</div>
            <div class="goods-box__cell -quantity">Количество</div>
            <div class="goods-box__cell -total-price">Стоимость</div>
          </div>
          <div class="goods-box__content">
            <div class="goods-box__row">
              <div class="goods-box__cell -name">
                <div class="goods-box__img">
                  <img src="./img/uploads/marceting2.png" alt="">
                </div>
                <h4 class="goods-box__title h4">Foxxx Viper Fox Golden Vintage Lot #1 RCA</h4>
              </div>
              <div class="goods-box__cell -price">9000р</div>
              <div class="goods-box__cell -quantity">
                <button class="goods-box__minus"></button>
                <input type="text" class="goods-box__field " value="1">
                <button class="goods-box__plus"></button>

              </div>
              <div class="goods-box__cell -total-price">
                34 920₽

              </div>
              <div class="goods-box__cell -delete">
                <button class="goods-box__delete"></button>
              </div>
            </div>
            <div class="goods-box__row">
              <div class="goods-box__cell -name">
                <div class="goods-box__img">
                  <img src="./img/uploads/marceting2.png" alt="">
                </div>
                <h4 class="goods-box__title h4">Foxxx Viper Fox Golden Vintage Lot #1 RCA</h4>
              </div>
              <div class="goods-box__cell -price">9000р</div>
              <div class="goods-box__cell -quantity">
                <button class="goods-box__minus"></button>
                <input type="text" class="goods-box__field " value="1">
                <button class="goods-box__plus"></button>

              </div>
              <div class="goods-box__cell -total-price">
                34 920₽

              </div>
              <div class="goods-box__cell -delete">
                <button class="goods-box__delete"></button>
              </div>
            </div>
            <div class="goods-box__row">
              <div class="goods-box__cell -name">
                <div class="goods-box__img">
                  <img src="./img/uploads/marceting2.png" alt="">
                </div>
                <h4 class="goods-box__title h4">Foxxx Viper Fox Golden Vintage Lot #1 RCA</h4>
              </div>
              <div class="goods-box__cell -price">9000р</div>
              <div class="goods-box__cell -quantity">
                <button class="goods-box__minus"></button>
                <input type="text" class="goods-box__field " value="1">
                <button class="goods-box__plus"></button>

              </div>
              <div class="goods-box__cell -total-price">
                34 920₽

              </div>
              <div class="goods-box__cell -delete">
                <button class="goods-box__delete"></button>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="order-info">
          <h3 class="order-info__title">01. Информация о получателе</h3>
          <div class="order-info__inner">
            <div class="order-info__column -full-name">
              <label for="" class="order-info__label">ФИО*</label>
              <input type="text" class="order-info__field" placeholder="Иванов Иван Иванович">
            </div>
            <div class="order-info__column -tell">
              <label for="" class="order-info__label">Телефон*</label>
              <input type="text" class="order-info__field" placeholder="8(800)555-35-35">
            </div>
            <div class="order-info__column -email">
              <label for="" class="order-info__label">Эл. почта</label>
              <input type="email" class="order-info__field" placeholder="ivanov2021@mail.ru">
            </div>
          </div>
        </div> -->
        <section class="checkout__section checkout-contacts" aria-label="Информация о получателе">
          <h3 class="checkout__subtitle">01. Информация о получателе</h3>
          <div class="checkout-contacts__container">
            <div class="checkout-contacts__column">
              <label for="checkout-contacts-name" class="checkout__label">ФИО*</label>
              <input id="checkout-contacts-name" name="name" type="text" class="checkout__input input" placeholder="Иванов Иван Иванович">
            </div>
            <div class="checkout-contacts__column">
              <label for="checkout-contacts-tel" class="checkout__label">Телефон*</label>
              <input id="checkout-contacts-tel" name="tel" type="text" class="checkout__input input" pattern="[0-9]{11,11}" maxlength="11" placeholder="8(800)555-35-35">
            </div>
            <div class="checkout-contacts__column">
              <label for="checkout-contacts-email" class="checkout__label">Эл. почта</label>
              <input id="checkout-contacts-email" name="email" type="email" class="checkout__input input" placeholder="ivanov2021@mail.ru">
            </div>
            <span class="js-checkout-error checkout__error-field"></span>
          </div>
        </section>
        <section class="checkout__section checkout-delivery">
          <h3 class="checkout__subtitle">02. Доставка</h3>
          <div class="checkout-delivery__points">
            <div class="custom-checkbox _radio border-special">
              <input id="delivery-mrDriskell" type="radio" class="delivery-type-radio" name="delivery-type" value="1" checked>
              <label class="delivery-select-label" for="delivery-mrDriskell">
                <div class="checkout-delivery__cell">
                  <b>Забрать в магазине Mr Driskell</b>
                  <div class="checkout-delivery__desc"></div>
                </div>
                <div class="checkout-delivery__cell">
                  <b class="checkout-delivery__date">
                    В 1м Магазине
                  </b>
                  <span class="checkout-delivery__price">
                    Бесплатно
                  </span>
                </div>
              </label>
            </div>
            <div class="custom-checkbox _radio border-special">
              <input id="delivery-pickUp" type="radio" class="delivery-type-radio" name="delivery-type" value="2">
              <label class="delivery-select-label" for="delivery-pickUp">
                <div class="checkout-delivery__cell">
                  <b>Забрать в пункте выдачи</b>
                  <div class="checkout-delivery__desc"></div>
                </div>
                <div class="checkout-delivery__cell">
                  <b class="checkout-delivery__date">
                    Укажите адрес ниже
                  </b>
                  <span class="checkout-delivery__price">
                    Бесплатно
                  </span>
                </div>
              </label>
            </div>
            <div class="custom-checkbox _radio border-special">
              <input id="delivery-courier" type="radio" class="delivery-type-radio" name="delivery-type" value="3">
              <label class="delivery-select-label" for="delivery-courier">
                <div class="checkout-delivery__cell">
                  <b>Курьером</b>
                  <div class="checkout-delivery__desc"></div>
                </div>
                <div class="checkout-delivery__cell">
                  <b class="checkout-delivery__date">
                    Укажите адрес ниже
                  </b>
                  <span class="checkout-delivery__price">

                  </span>
                </div>
              </label>
            </div>
          </div>
          <div class="checkout__tab _1">
            <?php
            $get_market_address = $connect->query("SELECT * FROM `address` WHERE `address_type_id` = '2'");
            if ($get_market_address->num_rows > 0) {
              $row = $get_market_address->fetch_assoc();
            } else {
              $row['id'] = '#';
            }
            ?>
            <input class="js-order-field" type="hidden" value="<?= $row['id'] ?>" name="checkout-address">
          </div>
          <div class="checkout__tab _2">
            <h4 class="checkout__subtitle">
              Пункты выдачи
            </h4>
            <label for="checkout-pickup-address">Введите пункт выдачи</label>
            <select class="input js-order-field" name="checkout-address" id="checkout-pickup-address">
              <?php
              $get_addres_pickup = $connect->query("SELECT * FROM `address` WHERE `address_type_id` = '1'");
              if ($get_addres_pickup->num_rows > 0) {
                while ($row = $get_addres_pickup->fetch_assoc()) {
              ?>
                  <option value="<?= $row['id'] ?>"><?= $row['address'] ?></option>
                <?php
                }
              } else {
                ?>
                <option value="">Нет пунктов выдачи</option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="checkout__tab _3">
            <h4 class="checkout__subtitle">
              Адрес доставки
            </h4>
            <label for="checkout-user-address">Введите адрес доставки</label>
            <input class="checkout__input input js-order-field" id="checkout-user-address" type="text" name="checkout-address" placeholder="улица/дом/квартира">
            <span class="js-checkout-error checkout__error-field"></span>
          </div>

        </section>
        <section class="checkout__section checkout-payment">
          <h3 class="checkout__subtitle">
            03. Способ оплаты
          </h3>
          <div class="checkout-payment__container">
            <div class="custom-checkbox _radio">
              <input type="radio" name="payment-type" id="payment-1" data-name="Оплата онлайн" value="1" checked>
              <label for="payment-1">
                <span>Оплата онлайн</span>
              </label>
            </div>
            <div class="custom-checkbox _radio">
              <input type="radio" name="payment-type" id="payment-2" data-name="Спб" value="2">
              <label for="payment-2">
                <span><img src="./img/big-basket/sbp-btn.svg" alt=""></span>
              </label>
            </div>
            <div class="custom-checkbox _radio">
              <input type="radio" name="payment-type" id="payment-3" data-name="Картой" value="3">
              <label for="payment-3">
                <span>Картой</span>
              </label>
            </div>

          </div>
        </section>
        <!-- <div class="order-info">
          <h3 class="order-info__title">02. Доставка</h3>
          <div class="order-info__inner">
            <input type="radio" class="order-info__radio">
          </div>
        </div> -->

      </div>
      <div class="big-basket__left">
        <div class="big-basket__sum big-basket__box border-special">
          <div class="big-basket__row">
            <div class="big-basket__cell">
              Всего единиц товара:
            </div>
            <div class="big-basket__cell js-goods-quontity">
              17
            </div>
          </div>
          <div class="big-basket__row">
            <div class="big-basket__cell">
              Общая скидка:
            </div>
            <div class="big-basket__cell">
              1080р
            </div>
          </div>

          <div class="big-basket__row big-basket__row--final">
            <div class="big-basket__cell">
              Итого:
            </div>
            <div class="big-basket__cell js-total">
              37 820р
            </div>
          </div>
          <!-- <div class="promocode">
            <label for="" class="promocode__label">Промокод</label>
            <input type="text" class="promocode__field" placeholder="Driskell2000">
            <div class="promocode__btn">
              <button>Активировать промокод</button>
              <span class="promocode__btn-accent underline"></span>
            </div>
          </div>
        </div> -->

          <div class="buy big-basket__box">
            <button class="buy__btn button button--accent js-order-spend">Оформить заказ</button>
            <div class="buy__agreement">
              <div class="cutom-checkbox custom-checkbox--agreement">
                <input type="checkbox" id="agreement" name="agreement" value="1">
                <label for="agreement">
                  Согласен с <a href="">публичной офертой</a> и <a href="">обработкой персональных данных</a>
                </label>
                <span class="js-checkout-error checkout__error-field"></span>
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
<script src="js/main.js" type="module"></script>
<script src="js/big-basket.js" type="module"></script>

</body>

</html>