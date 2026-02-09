import { getUserOrders } from "./api.js";
import { renderUserOrders } from "./render.js";

const autification = JSON.parse(JSON.parse(localStorage.getItem("user")));

getUserOrders("user_orders", autification.id)
  .then((dbOrders) => {
    if (dbOrders === "clear") {
    }
    console.log(JSON.parse(dbOrders));
    renderUserOrders(JSON.parse(dbOrders));
    const ordersBtns = document.querySelectorAll(".orders-list__row");
    ordersBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
        const arrowAnim = this.querySelector(".orders-list__more");
        const hidenBlock = this.parentElement.querySelector(".order-details");
        hidenBlock.classList.toggle("_active");
        arrowAnim.classList.toggle("_active");
      });
    });
  })
  .catch((error) => {
    console.log(error);
  });
