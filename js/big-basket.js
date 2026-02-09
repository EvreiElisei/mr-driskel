import { cart, getCartTotal, initCart } from "./cart.js";
import { createOreder } from "./api.js";

// const deliveryRadios = document.querySelectorAll('input[name="delivery-type"');
// const addressField = document.getElementById("");
let oldTab;

document.querySelectorAll(".delivery-select-label").forEach((label) => {
  label.addEventListener("click", function () {
    const radionId = this.getAttribute("for");
    const radio = document.getElementById(radionId);

    if (radio.checked) {
    } else {
      openTab(radio);
    }
  });
});

function openTab(radio) {
  const tab = document.querySelector("._" + radio.value);
  if (tab || false) {
    tab.classList.add("active");
  }

  if (oldTab || false) {
    oldTab.classList.remove("active");
  }
  oldTab = tab;
}

function collectUserData() {
  const name = document.querySelector("#checkout-contacts-name").value.trim();
  const email = document.querySelector("#checkout-contacts-email").value.trim();
  const phone = document.querySelector("#checkout-contacts-tel").value.trim();
  return { name, email, phone };
}

function collectDeliveryData() {
  const deliveryOption = document.querySelector(
    'input[name="delivery-type"]:checked'
  );

  const delivery = document.querySelector(
    ".checkout__tab._" + deliveryOption.value + "> .js-order-field"
  );
  const inputValue = deliveryOption.value;
  console.log(delivery);
  const payment = document.querySelector('input[name="payment-type"]:checked');
  return { delivery, payment, inputValue };
}

function validateOrder() {
  let isValid = true;
  const userData = collectUserData();

  const userDataError = document.querySelector(
    ".checkout-contacts .js-checkout-error"
  );
  if (!userData.name || !userData.phone || !userData.email) {
    userDataError.textContent = "Пожалуйста заполните все поля";
    isValid = false;
  } else {
    userDataError.textContent = "";
  }

  const deliveryData = collectDeliveryData();
  console.log(deliveryData);
  const deliveryError = document.querySelector(
    ".checkout-delivery .js-checkout-error"
  );
  if (!deliveryData.delivery.value) {
    const deliveryError = document.querySelector(
      ".checkout-delivery .js-checkout-error"
    );
    deliveryError.textContent = "Пожалуйста заполните поле";
    isValid = false;
  } else {
    deliveryError.textContent = "";
  }
  if (!deliveryData.payment) {
    isValid = false;
  }

  const agreement = document.querySelector(
    ".custom-checkbox--agreement > input"
  );
  const agreementError =
    agreement.parentElement.querySelector(".js-checkout-error");
  if (!agreement.checked) {
    isValid = false;
    agreementError.textContent = "Пожалуйста заполните поле";
  } else {
    agreementError.textContent = "";
  }
  if (!isValid) {
    return isValid;
  } else {
    return { userData, deliveryData };
  }
}

function sendOrder() {
  const orderData = validateOrder();
  if (!orderData) {
    return;
  } else {
    console.log("ad");
    const user = JSON.parse(JSON.parse(localStorage.getItem("user")));
    orderData.userData.id = user.id;
    const total = getCartTotal().total;
    const readyOrderData = {
      total_amount: total,
      cart: cart,

      user: orderData.userData,
      payment: orderData.deliveryData.payment.value,
      delivery_type_id: orderData.deliveryData.inputValue,
      // delivery: orderData.deliveryData.delivery.value,
    };
    if (!isNaN(orderData.deliveryData.delivery.value)) {
      readyOrderData.address_id = orderData.deliveryData.delivery.value;
    } else {
      readyOrderData.custom_address = orderData.deliveryData.delivery.value;
    }
    console.log(readyOrderData);
    createOreder(readyOrderData)
      .then((answer) => {
        console.log(answer);
        if (answer == "success") {
          initCart();
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }
}

const sendBtn = document.querySelector(".js-order-spend");

sendBtn.addEventListener("click", () => {
  sendOrder();
});
