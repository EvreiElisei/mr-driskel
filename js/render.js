// render.js
import { getCartTotal, cart, products } from "./cart.js";
import { startSwiper } from "./swiper.js";
import { wish } from "./wish.js";

export function renderUserOrders(order) {
  let html = "";
  for (let i = 0; i < order.length; i++) {
    const date = new Date(order[i].orderDate);
    html += `
    
              <div class="orders-list__container">
                <div class="orders-list__row">
                  <div class="orders-list__cell">
                    ${date.toLocaleDateString("ru-RU")}
                  </div>
                  <div class="orders-list__cell">
                    ${order[i].orderId}
                  </div>
                  <div class="orders-list__cell">
                    ${order[i].orderStatus}
                  </div>
                  <div class="orders-list__cell">
                  ${order[i].deliveryType}
                  </div>
                  <div class="orders-list__cell">
                  ${order[i].paymentType}
                  </div>
                  <div class="orders-list__cell _price">
                  ${Math.round(order[i].totalSum)}
                  </div>
                  <div class="orders-list__more">

                  </div>
                </div>
                <div class="order-list__details">
                  <section class="order-details">
                    <div class="order-details__info">
                      <h4 class="order-details__title">
                        Заказ № <span class="orders-number">${
                          order[i].orderId
                        }</span>
                        ОТ ${date.toLocaleDateString("ru-RU")}
                      </h4>
                      <section>
                        <h4 class="order-details__subtitle h4">Доставка:</h4>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Способ доставки:</div>
                          <div class="order-details__cell ">${
                            order[i].deliveryType
                          }</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Адрес:</div>
                          <div class="order-details__cell">
                            ${order[i].deliveryAddress}</div>
                        </div>
                      </section>
                      <section>
                        <h4 class="order-details__subtitle h4">Получатель</h4>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Имя</div>
                          <div class="order-details__cell ">${
                            order[i].userName
                          }</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Телефон</div>
                          <div class="order-details__cell">
                            ${order[i].userPhone}</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">E-mail:</div>
                          <div class="order-details__cell">${
                            order[i].userEmail
                          }</div>
                        </div>
                      </section>
                      <section>
                        <h4 class="order-details__subtitle h4">Стоимость</h4>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Сумма заказа:</div>
                          <div class="order-details__cell ">${Math.round(
                            order[i].totalSum
                          )} р.</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Доставка</div>
                          <div class="order-details__cell">бесплатно</div>
                        </div>
                        <div class="order-details__row _final">
                          <div class="order-details__cell _head">Итого:</div>
                          <div class="order-details__cell">${Math.round(
                            order[i].totalSum
                          )} р.</div>
                        </div>
                        <div class="order-details__row">
                          <div class="order-details__cell _head">Способ оплаты</div>
                          <div class="order-details__cell">${
                            order[i].paymentType
                          }</div>
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
                        `;
    for (let q = 0; q < order[i].orderItem.length; q++) {
      html += `
      <div class="product-table__row">
                          <div class="product-table__cell _img">
                            <a href="#"><img src="img/uploads/${
                              order[i].orderItem[q].img_name
                            }" alt=""></a>

                          </div>
                          <div class="product-table__cell _name">
                            <div class="product-table__name"><a href="#">${
                              order[i].orderItem[q].name
                            }</a></div>
                            <div class="product-table__id">${
                              order[i].orderItem[q].id
                            }</div>
                          </div>
                          <div class="product-table__cell _price">
                            ${order[i].orderItem[q].price} р.
                          </div>
                          <div class="product-table__cell _quantity">
                          ${order[i].orderItem[q].order_item_quantity}
                          </div>
                          <div class="product-table__cell _price">
                            ${
                              Number(
                                order[i].orderItem[q].order_item_quantity
                              ) * Number(order[i].orderItem[q].price)
                            } р
                          </div>
                        </div>
        `;
    }
    html += `
                        
                      </div>
                    </section>
                  </section>
                </div>
              </div>
            
  `;
  }
  $(".orders-list__inner").html(html);
}

export function renderMiniBasket(hasItems) {
  let html = '<div class="mini-basket__container">';

  if (hasItems) {
    html += `
      <div class="mini-basket__top">
        <span>Корзина</span>
      </div>
      <div class="mini-basket__inner">
        ${renderMiniBasketItems()}
      </div>
      <div class="mini-basket__final">
        <div class="mini-basket__final-price">
          <span class="mini-basket__final-price-label">Всего:</span>
          <span class="js-total">${getCartTotal().total} р</span>
        </div>
        <div class="mini-basket__final-nav">
          <a href='./big_basket.php' class="button button--light">Оформить заказ</a>
        </div>
      </div>`;
  } else {
    html += '<div class="mini-basket__empty">Корзина пуста</div>';
  }

  html += "</div>";
  $(".mini-basket__wrapper").html(html);
}

function renderMiniBasketItems() {
  let html = "";
  for (const key in cart) {
    if (products[key]) {
      html += `
        <div class="mini-basket__card">
          <div class="mini-basket__cell -img">
            <img src="img/uploads/${products[key].img_name}" alt="">
          </div>
          <div class="mini-basket__cell -name">
            <a href="#" class="mini-basket__card-title">${products[key].name}</a>
          </div>
          <div class="mini-basket__cell -price">${products[key].price} р</div>
          <div class="mini-basket__cell -amount">
            <button class="minus-button" data-id="${key}"></button>
            <input type="text" value="${cart[key]}" class="mini-basket__field js-input-change" data-id="${key}" min="1" max="20">
            <button class="plus-button" data-id="${key}"></button>
          </div>
          <div class="mini-basket__cell -delete">
            <button class="delete-button" data-id="${key}"></button>
          </div>
        </div>`;
    }
  }
  return html;
}

export function renderBigBasket(hasItems) {
  if (!document.getElementById("big-basket")) return;

  let html = "";
  if (hasItems) {
    console.log("пикабу");
    for (const key in cart) {
      if (products[key]) {
        html += `
          <div class="goods-box__row">
            <div class="goods-box__cell -name">
              <div class="goods-box__img">
                <img src="./img/uploads/${products[key].img_name}" alt="">
              </div>
              <h4 class="goods-box__title h4">${products[key].name}</h4>
            </div>
            <div class="goods-box__cell -price">${products[key].price}р</div>
            <div class="goods-box__cell -quantity">
              <button class="goods-box__minus minus-button" data-id="${key}"></button>
              <input type="text" class="goods-box__field input-change" data-id="${key}" value="${
          cart[key]
        }" min="1" max="20">
              <button class="goods-box__plus plus-button" data-id="${key}"></button>
            </div>
            <div class="goods-box__cell -total-price">
              ${products[key].price * cart[key]}₽
            </div>
            <div class="goods-box__cell -delete">
              <button class="goods-box__delete delete-button" data-id="${key}"></button>
            </div>
          </div>`;
      }
    }
  } else {
    html = `<div class="big-basket__empty">
              <h3 class="text__center">В корзине пока нет товаров</h3>
              <p class="text__center">Добавляйте понравившиеся товары мировых брендов и наслаждайтесь покупками</p>
              <a class="button" href="index.php#main-catalog">В каталог</a>
            </div>`;
    $(".big-basket__inner").addClass("big-basket__inner--empty").html(html);
    return;
  }
  renderTotal();
  $(".goods-box__content").html(html);
}

function renderTotal() {
  const total = getCartTotal().total;
  const quantity = getCartTotal().quantity;
  $(".js-total").text(total + " р");
  $(".js-goods-quontity").text(quantity);
}
export function renderProducts(
  filteredProducts,
  displayedProducts = 8,
  showMoreBtn = document.getElementById("showMore")
) {
  console.log(filteredProducts);
  const productsContainer = document.querySelector(".goods");

  productsContainer.innerHTML = "";

  const productsToShow = filteredProducts.slice(0, displayedProducts);

  productsToShow.forEach((product) => {
    const productCard = document.createElement("div");
    productCard.className = "goods__row";

    productCard.innerHTML = `
  <div class="goods__card">
		<div class="goods__card-absolute">
			${
        product.status
          ? `<span class="goods__card-status">${product.status}</span>`
          : ""
      }
			<button class="goods__card-wish js-add-wish" data-id="${product.id}">
				<svg class="" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd"
					d="M18.2627 9.62586V9.62282C18.7622 9.10014 19.155 8.4846 19.4188 7.81058C19.6977 7.09752 19.8262 6.33445 19.7959 5.56936C19.7657 4.80427 19.5775 4.0537 19.2432 3.36487C18.9088 2.67604 18.4355 2.06385 17.8531 1.56679C17.2707 1.06974 16.5917 0.698571 15.8589 0.476641C15.1261 0.254712 14.3553 0.186818 13.5949 0.277231C12.8346 0.367644 12.1012 0.614406 11.4408 1.002C10.8941 1.32291 10.4072 1.73462 10.0007 2.21855C9.59419 1.73462 9.10733 1.32291 8.56059 1.002C7.90025 0.614406 7.16685 0.367644 6.40652 0.277231C5.64618 0.186818 4.87536 0.254712 4.14254 0.476641C3.40972 0.698571 2.73075 1.06974 2.14833 1.56679C1.5659 2.06385 1.09263 2.67604 0.758277 3.36487C0.423921 4.0537 0.235716 4.80427 0.205496 5.56936C0.175277 6.33445 0.303697 7.09752 0.58268 7.81058C0.861664 8.52363 1.2852 9.17127 1.8266 9.71272L10.0007 17.8858L18.2627 9.62586Z"
					fill="#BB8C5F" />
				</svg>
        

			</button>
		</div>
		<a href="product_page.php?id=${product.id}">
		<div class="goods__card-swiper swiper ">
			<div class="swiper-wrapper">
					<div class="swiper-slide">
            <div class="goods__card-img">
					    <img src="img/uploads/${product.img_name} " alt="">
            </div>
					</div>
					<div class="swiper-slide">
						<div class="goods__card-img">
					    <img src="img/uploads/${product.img_name} " alt="">
            </div>
					</div>
					<div class="swiper-slide">
						<div class="goods__card-img">
					    <img src="img/uploads/${product.img_name} " alt="">
            </div>
					</div>
					<div class="swiper-slide">
						<div class="goods__card-img">
					    <img src="img/uploads/${product.img_name} " alt="">
            </div>
					</div>
			</div>
			<div class="goods__card-swiper-pagination"></div>
		</div>
	</a>
	<div class="goods__card-bottom">
		<a href="product_page.php?id=${product.id}>">
			<p class="goods__card-name">${product.name}</p>
		</a>
		<span class="goods__card-price">${product.price} ₽</span>
	</div>
	<div class="goods__card-busket" data-id="${product.id}">
		<button class="goods__card-btn button button--card button-card__js-buy" data-id="${
      product.id
    }">Добавить в корзину</button>
	</div>


</div>
            `;
    productsContainer.appendChild(productCard);
  });

  // Показываем/скрываем кнопку "Показать ещё"
  showMoreBtn.style.display =
    displayedProducts >= filteredProducts.length ? "none" : "block";
  startSwiper();
  renderProductButtons();
  renderWishButton();
  renderWishCount();
}

export function renderProductButtons() {
  $(".goods__card-busket").each(function () {
    const productId = $(this).data("id");
    const isInCart = cart[productId] !== undefined;

    $(this).html(
      isInCart
        ? `<a href="./big_basket.php" class="goods__card-btn button button__active button--card" data-id="${productId}">В корзине</a>`
        : `<button class="goods__card-btn button button--card button-card__js-buy" data-id="${productId}">Добавить корзину</button>`
    );
  });
}

export function renderWishButton() {
  if (wish.length > 0) {
    $(".goods__card-wish").each(function () {
      const productId = $(this).data("id");
      const isInWish = wish.includes(productId);
      isInWish
        ? this.querySelector("svg").classList.add("active")
        : this.querySelector("svg").classList.remove("active");
    });
  }
}

export function renderWishCount() {
  const wishBox = document.querySelector(".wish-box");
  if (wish.length == 0) {
    console.log("dfasds");
    wishBox.classList.add("visually-hidden");
  } else {
    wishBox.classList.remove("visually-hidden");
    wishBox.textContent = `${wish.length}`;
  }
}

export function renderRegFormOnSucces() {
  console.log("zbs");
}
