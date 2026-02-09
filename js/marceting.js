import { getGoods } from "./api.js";
import { renderProducts } from "./render.js";
let product = [];
function loadMarceting() {
  getGoods("marceting", "", [
    "products.id",
    "products.name",
    "products.price",
    "products.status",
    "products.quantity",
    "img.img_name",
  ])
    .then((goods) => {
      let keys = Object.keys(goods);
      console.log(keys);
      for (let i = 0; i < keys.length; i++) {
        product[i] = goods[keys[i]];
      }
      console.log(product);
      let filteredProducts = product;
      renderProducts(filteredProducts);
    })
    .catch(console.error);
}

export function initMarceting() {
  loadMarceting();
}
