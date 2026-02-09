// main.js
import {
  addToCart,
  updateCartItem,
  removeFromCart,
  initCart,
  cart,
} from "./cart.js";
import { renderProductButtons } from "./render.js";
import { initCatalog } from "./catalog.js";
import { initMarceting } from "./marceting.js";

import { initWish, changeWish } from "./wish.js";

$(document).ready(function () {
  initCart();
  initWish();
  if ($("main").attr("id") === "catalog") initCatalog();
  // if($('main').attr('id')=== 'wish') initWishPage()
  if (document.querySelector(".marceting")) initMarceting();

  // Обработчики событий
  $(document).on("click", ".button-card__js-buy", function () {
    addToCart($(this).data("id"));
  });

  $(document).on("change", ".js-input-change, .input-change", function () {
    updateCartItem($(this).data("id"), Number($(this).val()));
  });

  $(document).on("click", ".plus-button", function () {
    const id = $(this).data("id");
    updateCartItem(id, cart[id] + 1);
  });

  $(document).on("click", ".minus-button", function () {
    const id = $(this).data("id");
    if (cart[id] > 1) {
      updateCartItem(id, cart[id] - 1);
    }
  });

  $(document).on("click", ".delete-button", function () {
    removeFromCart($(this).data("id"));
  });

  $(document).on("click", ".js-add-wish", function () {
    changeWish($(this).data("id"));
  });
  // Обновляем кнопки на странице товаров
});
