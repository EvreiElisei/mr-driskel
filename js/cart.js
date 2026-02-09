// cart.js
import {
  getGoods,
  saveCartToBd,
  checkAvailability,
  deleteCartForomBd,
} from "./api.js";
import {
  renderMiniBasket,
  renderBigBasket,
  renderProductButtons,
} from "./render.js";

import { getUserGoods, autification } from "./user-form.js";
export let cart;

export let products = {};

// export function getTotal() {
//   let total = 0;
//   let quantity = 0;
//   for (let key of keys) {
//     quantity += cart[key];
//     total += products[key].price * cart[key];
//   }
//   $(".js-total").text(total + " р");
//   $(".js-goods-quontity").text(quantity);
// }

export function addToCart(id) {
  if (cart[id] === undefined) {
    cart[id] = 1;
  } else {
    cart[id]++;
  }
  saveCart();
  renderProductButtons();
}

export async function updateCartItem(id, quantity) {
  if (quantity <= 0) return;
  if (quantity > 20) return;
  if (autification) {
    if (cart[id] < quantity) {
      const productQuantity = (await checkAvailability(id)) || 0;
      console.log(Number(productQuantity));
      console.log(productQuantity >= quantity);
      if (productQuantity >= quantity) {
        console.log(quantity);
        cart[id] = quantity;
      }
    } else {
      cart[id] = quantity;
    }
  } else {
    cart[id] = quantity;
  }
  console.log(cart);
  saveCart();
  renderProductButtons();
}

export async function removeFromCart(id) {
  if (autification) {
    await deleteCartForomBd(id, autification.id);
  }
  delete cart[id];
  saveCart();
  renderProductButtons();
}

export function getCartTotal() {
  let total = 0;
  let quantity = 0;

  for (const key in cart) {
    if (products[key]) {
      quantity += cart[key];
      total += products[key].price * cart[key];
    }
  }

  return { total, quantity };
}

async function saveCart() {
  if (autification) {
    await saveCartToBd(cart, autification.id);
  } else {
    console.log(cart);
    localStorage.setItem("on-basket", JSON.stringify(cart));
  }

  loadCart();
}

function loadCart() {
  const keys = Object.keys(cart);
  if (keys.length === 0) {
    renderMiniBasket(false);
    renderBigBasket(false);
    return;
  }

  getGoods("mini-basket", keys, [
    "products.id",
    "products.name",
    "products.price",
    "img.img_name",
  ])
    .then((goods) => {
      products = goods;
      renderMiniBasket(true);
      renderBigBasket(true);
    })
    .catch(console.error);
}

export async function initCart() {
  await getUserGoods()
    .then(
      (dbuser) => {
        if (dbuser === "clear") {
          cart = {};
        } else {
          cart = JSON.parse(dbuser);
          // cart = dbuser;
        }
        console.log(cart);
      }
      // (localUser) => {
      //   console.log("ква");
      //   cart = localUser;
      // }
    )
    .catch((localStorage) => {
      cart = localStorage;
    });
  loadCart();
}
