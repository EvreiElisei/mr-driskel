import { createNewUser, authUser, getGoodsAutUser } from "./api.js";
import { renderRegFormOnSucces } from "./render.js";
const userFormClose = document.querySelectorAll(".user-form__close");
const userFormBtn = document.querySelector("#openForm");
const userFormLogin = document.querySelector(".user-form__login");
const userFormReg = document.querySelector(".user-form__reg");
const controller = new AbortController();
const signal = controller;
export const autification =
  JSON.parse(JSON.parse(localStorage.getItem("user"))) || false;

export async function getUserGoods() {
  return new Promise((resolve, reject) => {
    if (autification) {
      getGoodsAutUser("cart", autification.id, ["product_id", "quantity"]).then(
        (goods) => {
          localStorage.setItem("on-basket", "");
          resolve(goods);
        }
      );
    } else {
      reject(JSON.parse(localStorage.getItem("on-basket")) || {});
    }
  });
}
export function getUserWish() {
  return new Promise((resolve, reject) => {
    if (autification) {
      getGoodsAutUser("wish", autification.id, ["product_id"]).then((whish) => {
        localStorage.setItem("wish", "");
        resolve(whish);
      });
    } else {
      console.log("fdd");
      reject(JSON.parse(localStorage.getItem("wish")) || []);
    }
  });
}

if (autification) userLoggedIn();
function formClose(e) {
  const closeButton = e.currentTarget;
  closeButton.closest(".user-form").classList.remove("user-form__active");
}
userFormClose.forEach((close) => {
  close.addEventListener("click", formClose);
});

userFormBtn.addEventListener(
  "click",
  () => {
    if (userFormReg.className == "user-form user-form__reg user-form__active") {
      userFormReg.classList.remove("user-form__active");
    } else {
      userFormLogin.classList.toggle("user-form__active");
    }
  },
  signal
);

const userFormOpenReg = document.querySelector("#openReg");
userFormOpenReg.addEventListener("click", () => {
  userFormLogin.classList.remove("user-form__active");
  userFormReg.classList.add("user-form__active");
});
const userFormOpenLog = document.querySelector("#openLog");
userFormOpenLog.addEventListener("click", () => {
  userFormReg.classList.remove("user-form__active");
  userFormLogin.classList.add("user-form__active");
});

function userLoggedIn() {
  userFormLogin.classList.remove("user-form__active");
  controller.abort();
  const userActionTitle = userFormBtn.querySelector(".user-action__title");
  if (autification.isAdmin) {
    userFormBtn.href = "./components/new_admin_panel.php";
    userActionTitle.textContent = "Админ";
  } else {
    userFormBtn.href = "./profile.php";
    userActionTitle.textContent = "Профиль";
  }
  const profileDropdown = userFormBtn.parentElement.querySelector(
    ".open-form__dropdown"
  );
  profileDropdown.classList.remove("visually-hidden");
  const userExit = profileDropdown.querySelector("[data-js-user-exit]");
  userExit.addEventListener("click", () => {
    localStorage.removeItem("user");
    location.reload();
  });
}

class FormsValidation {
  selectors = {
    form: "[data-js-form]",
    fieldErrors: "[data-js-form-field-errors]",
    formErrors: "[data-js-form-errors]",
  };

  errorMessages = {
    valueMissing: () => "Пожалуйста, заполните это поле",
    patternMismatch: ({ title }) => title || "Данные не соответствуют формату",
    tooShort: ({ minLength }) =>
      `Слишком короткое значение, минимум символов — ${minLength}`,
    tooLong: ({ maxLength }) =>
      `Слишком длинное значение, ограничение символов — ${maxLength}`,
  };

  constructor() {
    this.bindEvents();
  }

  manageErrors(fieldControlElement, errorMessages) {
    const fieldErrorsElement = fieldControlElement.parentElement.querySelector(
      this.selectors.fieldErrors
    );

    fieldErrorsElement.innerHTML = errorMessages
      .map((message) => `<span class="field__error">${message}</span>`)
      .join("");
  }

  validateField(fieldControlElement) {
    const errors = fieldControlElement.validity;
    const errorMessages = [];

    Object.entries(this.errorMessages).forEach(
      ([errorType, getErrorMessage]) => {
        if (errors[errorType]) {
          errorMessages.push(getErrorMessage(fieldControlElement));
        }
      }
    );

    this.manageErrors(fieldControlElement, errorMessages);

    const isValid = errorMessages.length === 0;

    fieldControlElement.ariaInvalid = !isValid;

    return isValid;
  }

  onBlur(event) {
    const { target } = event;
    const isFormField = target.closest(this.selectors.form);
    const isRequired = target.required;

    if (isFormField && isRequired) {
      this.validateField(target);
    }
  }

  onChange(event) {
    const { target } = event;
    const isRequired = target.required;
    const isToggleType = ["radio", "checkbox"].includes(target.type);

    if (isToggleType && isRequired) {
      this.validateField(target);
    }
  }
  parseValueFielsForBd(event) {
    const allElementsForBd = [...event.target.elements].filter(
      (element) =>
        element.tagName === "INPUT" &&
        ["text", "email", "password"].includes(element.type)
    );
    const objectForBd = {};
    allElementsForBd.forEach((elements) => {
      objectForBd[elements.name] = elements.value;
    });
    return objectForBd;
  }

  onSubmit(event) {
    const isFormElement = event.target.matches(this.selectors.form);
    if (!isFormElement) {
      return;
    }

    const requiredControlElements = [...event.target.elements].filter(
      ({ required }) => required
    );
    let isFormValid = true;
    let firstInvalidFieldControl = null;

    requiredControlElements.forEach((element) => {
      const isFieldValid = this.validateField(element);

      if (!isFieldValid) {
        isFormValid = false;

        if (!firstInvalidFieldControl) {
          firstInvalidFieldControl = element;
        }
      }
    });

    if (!isFormValid) {
      event.preventDefault();

      firstInvalidFieldControl.focus();
    } else {
      event.preventDefault();

      const formId = event.target.id;
      const formErrors = event.target.querySelector(this.selectors.formErrors);
      const objectForbd = this.parseValueFielsForBd(event);
      switch (formId) {
        case "formReg":
          createNewUser(objectForbd)
            .then((answer) => {
              switch (answer) {
                case "emailIsUsed":
                  formErrors.textContent =
                    "Пользователь с такой почтой уже существует";
                  break;
                case "success":
                  formErrors.textContent = "Успешная регистрация";
                  break;
                default:
                  formErrors.textContent = "Ошибка регистрации";
                  break;
              }
            })
            .catch(console.error);

          break;
        case "formLog":
          authUser(objectForbd).then((answer) => {
            const logAnswer = JSON.parse(answer);
            if (logAnswer.isFound) {
              formErrors.textContent = "";
              localStorage.setItem("user", JSON.stringify(answer));
              location.reload();
            } else {
              formErrors.textContent = "Не верное имя пользователя или пароль";
            }
          });
          break;
      }
      // sendAuthRequest(objectForbd, formId)
      //   .then((answer) => {
      //     const formErrors = event.target.querySelector(
      //       this.selectors.formErrors
      //     );
      //     switch (answer) {
      //       case "success":
      //         if (formId === "formReg") {
      //           formErrors.textContent = "Успешная регистрация";
      //         } else {
      //           userLoggedIn();
      //           localStorage.setItem("auth", JSON.stringify(true));
      //         }

      //         // renderRegFormOnSucces();
      //         break;
      //       case "emailIsUsed":
      //         formErrors.textContent =
      //           "Пользователь с такой почтой уже существует";
      //         break;
      //       case "userNotFound":
      //         formErrors.textContent = "Неверная почта или пароль";
      //         break;
      //       default:
      //         console.log(JSON.parse(answer));
      //         break;
      //     }
      //   })
      //   .catch(console.error);
    }
  }

  bindEvents() {
    document.addEventListener(
      "blur",
      (event) => {
        this.onBlur(event);
      },
      { capture: true }
    );
    document.addEventListener("change", (event) => this.onChange(event));
    document.addEventListener("submit", (event) => this.onSubmit(event));
  }
}

new FormsValidation();
