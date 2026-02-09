import { autification, getUserWish } from "./user-form.js";
import { renderWishButton, renderWishCount, renderProducts } from "./render.js";
import { saveWishToBd, getGoods } from "./api.js";
export let wish = [];
console.log(wish);
let wishProducts = [];
export function changeWish(id) {
  console.log(id);
  if (!wish.includes(id)) {
    wish.push(id);
    saveWish(true);
  } else {
    wish = wish.filter((item) => item !== id);
    saveWish(false, id);
  }
  renderWishButton();
  renderWishCount();
}

function saveWish(addElement, wishId = 0) {
  if (autification) {
    let action;
    if (addElement) {
      saveWishToBd("save-wish", wish, autification.id);
    } else {
      saveWishToBd("delete-wish", wishId, autification.id);
    }
  } else {
    localStorage.setItem("wish", JSON.stringify(wish));
  }
}

function loadWish() {
  if ($("main").attr("id") !== "wish") {
    return;
  }
  if (wish.length === 0) {
    renderProducts(wish);
    showWishEmty();

    return;
  }
  getGoods("mini-basket", wish, [
    "products.id",
    "products.name",
    "products.price",
    "products.status",
    "img.img_name",
  ])
    .then((goods) => {
      const keys = Object.keys(goods);

      if (keys.length > 0) {
        for (let i = 0; i < keys.length; i++) {
          wishProducts[i] = goods[keys[i]];
          renderProducts(wishProducts);
        }
      }
    })
    .catch(console.error);
}

function showWishEmty() {
  let html = `<div class="big-basket__empty">
  <h3 class="text__center">В избранном пока нет товаров</h3>
  <p class="text__center">Добавляйте понравившиеся товары мировых брендов и наслаждайтесь покупками</p>
  <a class="button" href="index.php#main-catalog">В каталог</a>
</div>`;
  $(".goods")
    .removeClass("goods")
    .addClass("big-basket__inner big-basket__inner--empty")
    .html(html);
}

export async function initWish() {
  await getUserWish()
    .then((dbwish) => {
      if (dbwish === "clear") {
        dbwish = [];
      } else {
        console.log(dbwish);
        wish = JSON.parse(dbwish);
      }
      console.log(wish);
    })
    .catch((localStorage) => {
      wish = localStorage;
    });
  loadWish();
  renderWishCount();
}
