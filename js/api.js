export async function checkAvailability(id) {
  let checkData;
  await $.post(
    "components/action/server-cart.php",
    {
      action: "check",
      id: id,
    },
    function (data) {
      checkData = JSON.parse(data);
    }
  );
  return checkData;
}

export function saveCartToBd(cart, id) {
  $.post(
    "components/action/server-cart.php",
    {
      action: "save-cart",
      user_id: id,
      cart: cart,
    },
    function (data) {
      console.log(data);
    }
  );
}

export function getUserOrders(action, user_id) {
  return new Promise((resolve, reject) => {
    $.post(
      "components/action/load-orders.php",
      {
        action: action,
        user_id: user_id,
      },
      function (data) {
        // if (data == "clear") return (window.location.href = "./404.php");
        try {
          resolve(data);
        } catch (error) {
          reject(error);
        }
      }
    );
  });
}

export function saveWishToBd(action, wish, id) {
  $.post(
    "components/action/server-cart.php",
    {
      action: action,
      user_id: id,
      wish: wish,
    },
    function (data) {
      console.log(data);
    }
  );
}
export function deleteCartForomBd(id, user_id) {
  $.post(
    "components/action/server-cart.php",
    {
      action: "delete-cart",
      id: id,
      user_id: user_id,
    },
    function (data) {
      console.log(data);
    }
  );
}

export async function getGoodsAutUser(action, user, needToSend) {
  return new Promise((resolve, reject) => {
    $.post(
      "components/action/cart-whish.php",
      {
        action: action,
        user: user,
        need_to_send: needToSend,
      },
      function (data) {
        // if (data == "clear") return (window.location.href = "./404.php");
        try {
          resolve(data);
        } catch (error) {
          reject(error);
        }
      }
    ).fail(reject);
  });
}

export function getGoods(action, where, needToSend) {
  return new Promise((resolve, reject) => {
    $.post(
      "components/action/load-products.php",
      {
        action: action,
        where: where,
        need_to_send: needToSend,
      },
      function (data) {
        if (data == "clear") return (window.location.href = "./404.php");
        try {
          const result = parseGoods(data);
          resolve(result);
        } catch (error) {
          reject(error);
        }
      }
    ).fail(reject);
  });
}

function parseGoods(data) {
  if (data === "clear" || "") return {};
  // понять как работает
  const result = {};
  const jsonObjects = data
    .split("}")
    .filter((str) => str.trim() && str.includes("{"))
    .map((str) => JSON.parse(str + "}"));

  jsonObjects.forEach((obj) => {
    result[obj.id] = obj;
  });

  return result;
}

export function createNewUser(KeyValueInObj) {
  return new Promise((resolve, reject) => {
    $.post(
      "components/action/user_reg.php",
      {
        login: KeyValueInObj.login,
        password: KeyValueInObj.pass,
        email: KeyValueInObj.email,
      },
      function (data) {
        try {
          resolve(data);
        } catch (error) {
          reject(error);
        }
      }
    );
  });
}

export function authUser(KeyValueInObj) {
  return new Promise((resolve, reject) => {
    $.post(
      "components/action/user_aut.php",
      {
        password: KeyValueInObj.pass,
        email: KeyValueInObj.email,
      },
      function (data) {
        try {
          resolve(data);
        } catch (error) {
          reject(error);
        }
      }
    ).fail(reject);
  });
}
export function createOreder(orederData) {
  return new Promise((resolve, reject) => {
    $.post(
      "components/action/create_order.php",
      {
        data: JSON.stringify(orederData),
      },
      function (data) {
        try {
          resolve(data);
        } catch (error) {
          reject(error);
        }
      }
    );
  });
}
