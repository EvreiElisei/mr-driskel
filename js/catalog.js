import { getGoods } from "./api.js";
import { renderProducts } from "./render.js";
let product = [];
let displayedProducts = 6;
let filteredProducts;
var params = window.location.search
  .replace("?", "")
  .split("&")
  .reduce(function (p, e) {
    var a = e.split("=");
    p[decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
    return p;
  }, {});

function loadCatalog() {
  console.log(params);
  getGoods("catalog", params.product_type || params.brand, [
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
      filteredProducts = product;
      setupEventListeners();
      renderProducts(filteredProducts, displayedProducts, showMoreBtn);
    })
    .catch(console.error);
}

const minPriceInput = document.getElementById("minPrice");
const maxPriceInput = document.getElementById("maxPrice");

const availabilityCheckbox = document.getElementById("checkbox-in-stock");
const sortBySelect = document.getElementById("sortBy");
const showMoreBtn = document.getElementById("showMore");

// Переменные состояния

// Инициализация страницы
export function initCatalog() {
  loadCatalog();
}

// Настройка обработчиков событий
function setupEventListeners() {
  minPriceInput.addEventListener("change", function () {
    if (parseInt(this.value) > parseInt(maxPriceInput.value)) {
      this.value = maxPriceInput.value;
    }
    filterProducts();
  });

  maxPriceInput.addEventListener("change", function () {
    if (parseInt(this.value) < parseInt(minPriceInput.value)) {
      this.value = minPriceInput.value;
    }
    filterProducts();
  });
  availabilityCheckbox.addEventListener("change", filterProducts);
  sortBySelect.addEventListener("change", filterProducts);
  showMoreBtn.addEventListener("click", showMoreProducts);
}

// Фильтрация товаров
function filterProducts() {
  const minPrice = parseInt(minPriceInput.value) || 0;
  const maxPrice = parseInt(maxPriceInput.value) || 100000;

  const onlyInStock = availabilityCheckbox.checked;
  const sortBy = sortBySelect.value;

  console.log(product);
  filteredProducts = product.filter((product) => {
    const priceMatch = product.price >= minPrice && product.price <= maxPrice;

    const stockMatch = !onlyInStock || product.quantity > 0;

    return priceMatch && stockMatch;
  });
  console.log(filteredProducts);
  // Сортировка
  sortProducts(sortBy);

  displayedProducts = 6;
  renderProducts(filteredProducts, displayedProducts, showMoreBtn);
}

// Сортировка товаров
function sortProducts(sortBy) {
  switch (sortBy) {
    case "price-asc":
      filteredProducts.sort((a, b) => a.price - b.price);
      break;
    case "price-desc":
      filteredProducts.sort((a, b) => b.price - a.price);
      break;
    case "newest":
      filteredProducts = product.filter((product) => {
        const isNew = product.status == "новинка";
        return isNew;
      });
      break;
    default:
      // По умолчанию - популярные (как в исходном массиве)
      break;
  }
}

// Отображение товаров

// Показать ещё товары
function showMoreProducts() {
  displayedProducts += 3;
  renderProducts(filteredProducts, displayedProducts, showMoreBtn);
}
