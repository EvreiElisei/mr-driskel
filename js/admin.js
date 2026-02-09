document.addEventListener("DOMContentLoaded", () => {
  loadApp();
});

async function loadApp() {
  try {
    await loadBrands();
    await loadProductTypes();
    await loadProducts(); //ddd
    await loadAttributes();
    await loadRoles();
    await loadUsers(); //
    openTab("products");
  } catch (error) {
    console.error("Ошибка при загрузке приложения:", error);
    alert("Не удалось загрузить приложение. Проверьте консоль.");
  }
}

function openTab(tabName) {
  const tabs = document.getElementsByClassName("tab-content");
  for (let i = 0; i < tabs.length; i++) {
    tabs[i].style.display = "none";
  }
  document.getElementById(tabName).style.display = "block";

  const buttons = document.getElementsByClassName("tab-button");
  for (let i = 0; i < buttons.length; i++) {
    buttons[i].classList.remove("active");
  }
  const activeButton = document.querySelector(
    `.tab-button[onclick="openTab('${tabName}')"]`
  );
  if (activeButton) {
    activeButton.classList.add("active");
  }
}

async function loadBrands() {
  try {
    const response = await fetch(
      "../components/action/admin_panel.php?action=load_brands"
    );
    if (!response.ok) {
      throw new Error("Ошибка загрузки брендов: " + response.status);
    }
    const brands = await response.json();
    const addSelect = document.getElementById("add-brand-id");
    const editSelect = document.getElementById("edit-brand-id");
    addSelect.innerHTML = '<option value="">Выберите бренд</option>';
    editSelect.innerHTML = '<option value="">Выберите бренд</option>';

    brands.forEach((brand) => {
      const option1 = document.createElement("option");
      option1.value = brand.id;
      option1.textContent = brand.name;
      addSelect.appendChild(option1);

      const option2 = document.createElement("option");
      option2.value = brand.id;
      option2.textContent = brand.name;
      editSelect.appendChild(option2);
    });

    const tbody = document.querySelector("#brands-table tbody");
    tbody.innerHTML = "";
    brands.forEach((brand) => {
      const row = document.createElement("tr");
      row.innerHTML = `
              <td>${brand.id}</td>
              <td>${brand.name}</td>
              <td class="actions">
                  <button onclick="editBrand(${brand.id}, '${brand.name}')">Изменить</button>
                  <button onclick="deleteBrand(${brand.id})">Удалить</button>
              </td>
          `;
      tbody.appendChild(row);
    });
  } catch (error) {
    console.error("Ошибка:", error);
    alert("Не удалось загрузить бренды. Проверьте консоль.");
  }
}

async function loadProductTypes() {
  try {
    const response = await fetch(
      "../components/action/admin_panel.php?action=load_product_types"
    );
    if (!response.ok) {
      throw new Error("Ошибка загрузки типов продуктов: " + response.status);
    }
    const types = await response.json();
    const addTypesSelect = document.getElementById("add-types-id");
    const editTypesSelect = document.getElementById("edit-types-id");
    const addAttributeSelect = document.getElementById(
      "add-attribute-product-type-id"
    );
    const editAttributeSelect = document.getElementById(
      "edit-attribute-product-type-id"
    );
    addTypesSelect.innerHTML = '<option value="">Выберите тип</option>';
    editTypesSelect.innerHTML = '<option value="">Выберите тип</option>';
    addAttributeSelect.innerHTML =
      '<option value="">Выберите тип товара</option>';
    editAttributeSelect.innerHTML =
      '<option value="">Выберите тип товара</option>';

    types.forEach((type) => {
      const option1 = document.createElement("option");
      option1.value = type.id;
      option1.textContent = type.name;
      addTypesSelect.appendChild(option1);

      const option2 = document.createElement("option");
      option2.value = type.id;
      option2.textContent = type.name;
      editTypesSelect.appendChild(option2);

      const option3 = document.createElement("option");
      option3.value = type.id;
      option3.textContent = type.name;
      addAttributeSelect.appendChild(option3);

      const option4 = document.createElement("option");
      option4.value = type.id;
      option4.textContent = type.name;
      editAttributeSelect.appendChild(option4);
    });

    const tbody = document.querySelector("#product-types-table tbody");
    tbody.innerHTML = "";
    types.forEach((type) => {
      const row = document.createElement("tr");
      row.innerHTML = `
              <td>${type.id}</td>
              <td>${type.name}</td>
              <td class="actions">
                  <button onclick="editProductType(${type.id}, '${type.name}')">Изменить</button>
                  <button onclick="deleteProductType(${type.id})">Удалить</button>
              </td>
          `;
      tbody.appendChild(row);
    });
  } catch (error) {
    console.error("Ошибка:", error);
    alert("Не удалось загрузить типы продуктов. Проверьте консоль.");
  }
}
productsAll = [];
async function loadProducts() {
  try {
    const response = await fetch(
      "../components/action/admin_panel.php?action=load"
    );
    if (!response.ok) {
      throw new Error("Ошибка загрузки: " + response.status);
    }
    const products = await response.json();
    const tbody = document.querySelector("#products-table tbody");
    tbody.innerHTML = "";

    products.forEach((product) => {
      const brandResponse = fetch(
        "../components/action/admin_panel.php?action=get_brand_name&id=" +
          product.brand_id
      )
        .then((res) => res.json())
        .then((brand) => brand.name || "Неизвестно");
      const typeResponse = fetch(
        "../components/action/admin_panel.php?action=get_type_name&id=" +
          product.types_id
      )
        .then((res) => res.json())
        .then((type) => type.name || "Неизвестно");
      const attributesResponse = fetch(
        "../components/action/admin_panel.php?action=get_product_attributes&id=" +
          product.id
      )
        .then((res) => res.json())
        .then(
          (attributes) =>
            attributes
              .map((attr) => `${attr.name}: ${attr.value}`)
              .join(", ") || "-"
        );
      productsAll[product.id] = product;

      Promise.all([brandResponse, typeResponse, attributesResponse]).then(
        ([brandName, typeName, attributesDisplay]) => {
          const row = document.createElement("tr");

          row.innerHTML = `
                  <td>${product.id}</td>
                  <td>${product.name}</td>
                  <td>${product.price}</td>
                  
                  <td>${brandName}</td>
                  <td>${typeName}</td>
                  
                  <td>${product.short_description || "-"}</td>
                  <td>${product.quantity}</td>
                  
                  <td class="actions">
                      <button class="admin-button" onclick="editProduct(${
                        product.id
                      })">Изменить</button>
                      <button class="admin-button" onclick="deleteProduct(${
                        product.id
                      })">Удалить</button>
                  </td>
              `;
          tbody.appendChild(row);
          searchProducts();
        }
      );
    });
  } catch (error) {
    console.error("Ошибка:", error);
    alert("Не удалось загрузить товары. Проверьте консоль.");
  }
}

async function loadAttributes() {
  try {
    const response = await fetch(
      "../components/action/admin_panel.php?action=load_attributes"
    );
    if (!response.ok) {
      throw new Error("Ошибка загрузки атрибутов: " + response.status);
    }
    const attributes = await response.json();

    const tbody = document.querySelector("#attributes-table tbody");
    tbody.innerHTML = "";

    attributes.forEach((attr) => {
      const row = document.createElement("tr");
      row.innerHTML = `
              <td>${attr.id}</td>
              <td>${attr.product_type_name}</td>
              <td>${attr.name}</td>
              <td class="actions">
                  <button onclick="editAttribute(${attr.id}, ${attr.type_id}, '${attr.name}')">Изменить</button>
                  <button onclick="deleteAttribute(${attr.id})">Удалить</button>
              </td>
          `;
      tbody.appendChild(row);
    });
  } catch (error) {
    console.error("Ошибка:", error);
    alert("Не удалось загрузить атрибуты. Проверьте консоль.");
  }
}

async function loadRoles() {
  try {
    const response = await fetch(
      "../components/action/admin_panel.php?action=load_roles"
    );
    if (!response.ok) {
      throw new Error("Ошибка загрузки ролей: " + response.status);
    }
    const roles = await response.json();

    const addSelect = document.getElementById("add-role-id");
    const editSelect = document.getElementById("edit-user-role-id");
    addSelect.innerHTML = '<option value="">Выберите роль</option>';
    editSelect.innerHTML = '<option value="">Выберите роль</option>';

    roles.forEach((role) => {
      const option1 = document.createElement("option");
      option1.value = role.id;
      option1.textContent = role.name;
      addSelect.appendChild(option1);

      const option2 = document.createElement("option");
      option2.value = role.id;
      option2.textContent = role.name;
      editSelect.appendChild(option2);
    });
  } catch (error) {
    console.error("Ошибка:", error);
    alert("Не удалось загрузить роли. Проверьте консоль.");
  }
}

async function loadUsers() {
  try {
    const response = await fetch(
      "../components/action/admin_panel.php?action=load_users"
    );
    if (!response.ok) {
      throw new Error("Ошибка загрузки пользователей: " + response.status);
    }
    const users = await response.json();

    const tbody = document.querySelector("#users-table tbody");
    tbody.innerHTML = "";
    users.forEach((user) => {
      const roleResponse = fetch(
        "../components/action/admin_panel.php?action=get_role_name&id=" +
          user.role_id
      )
        .then((res) => res.json())
        .then((role) => role.name || "Неизвестно");

      roleResponse.then((roleName) => {
        const row = document.createElement("tr");
        row.innerHTML = `
                  <td>${user.id}</td>
                  <td>${user.name}</td>
                  <td>${user.email}</td>
                  <td>${roleName}</td>
                  <td class="actions">
                      <button onclick="editUser(${user.id}, '${user.name}', '${user.email}', '${user.password}', ${user.role_id})">Изменить</button>
                      <button onclick="deleteUser(${user.id})">Удалить</button>
                  </td>
              `;
        tbody.appendChild(row);
      });
    });
  } catch (error) {
    console.error("Ошибка:", error);
    alert("Не удалось загрузить пользователей. Проверьте консоль.");
  }
}

async function loadAttributesForAdd() {
  const typesId = document.getElementById("add-types-id").value;
  const container = document.getElementById("add-product-attributes");
  container.innerHTML = "";

  if (typesId) {
    try {
      const response = await fetch(
        "../components/action/admin_panel.php?action=get_attributes_by_type&id=" +
          typesId
      );
      if (!response.ok) {
        throw new Error("Ошибка загрузки атрибутов: " + response.status);
      }

      const attributes = await response.json();

      attributes.forEach((attr) => {
        const div = document.createElement("div");
        div.innerHTML = `
                  <label>${attr.name}:</label>
                  <input type="text" name="attributes[${attr.id}]" placeholder="Значение" required>
              `;
        container.appendChild(div);
      });
    } catch (error) {
      console.error("Ошибка:", error);
      alert("Не удалось загрузить ебаные атрибуты. Проверьте консоль.");
    }
  }
}

async function loadProductAttributesForEdit(productId) {
  try {
    const response = await fetch(
      "../components/action/admin_panel.php?action=get_product_attributes&id=" +
        productId
    );
    if (!response.ok) {
      throw new Error("Ошибка загрузки атрибутов: " + response.status);
    }
    const attributes = await response.json();
    const container = document.getElementById("edit-product-attributes");
    container.innerHTML = "";

    const typesId = document.getElementById("edit-types-id").value;
    if (typesId) {
      const attributesResponse = await fetch(
        "../components/action/admin_panel.php?action=get_attributes_by_type&id=" +
          typesId
      );
      if (!attributesResponse.ok) {
        throw new Error(
          "Ошибка загрузки атрибутов типа: " + attributesResponse.status
        );
      }
      const allAttributes = await attributesResponse.json();

      allAttributes.forEach((attr) => {
        const existingAttr = attributes.find((a) => a.attribute_id === attr.id);
        const div = document.createElement("div");
        div.innerHTML = `
                  <label>${attr.name}:</label>
                  <input type="text" data-attribute-id="${attr.id}" value="${
          existingAttr ? existingAttr.value : ""
        }">
              `;
        container.appendChild(div);
      });
    }
  } catch (error) {
    console.error("Ошибка:", error);
    alert("Не удалось загрузить атрибуты. Проверьте консоль.");
  }
}

function editProduct(id) {
  const modal = document.getElementById("edit-modal");
  document.getElementById("edit-product-id").value = id;
  document.getElementById("edit-name").value = productsAll[id].name;
  document.getElementById("edit-price").value = productsAll[id].price;
  document.getElementById("edit-status").value = productsAll[id].status;
  document.getElementById("edit-brand-id").value = productsAll[id].brand_id;
  document.getElementById("edit-types-id").value = productsAll[id].types_id;
  document.getElementById("edit-description").value =
    productsAll[id].description;
  document.getElementById("edit-short_description").value =
    productsAll[id].short_description || "";
  document.getElementById("edit-quantity").value = productsAll[id].quantity;

  loadProductAttributesForEdit(id);

  modal.style.display = "block";
  const closeBtn = modal.querySelector(".close");
  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });
}

function editBrand(id, name) {
  const modal = document.getElementById("edit-brand-modal");
  document.getElementById("edit-brand-id").value = id;
  document.getElementById("edit-brand-name").value = name;
  modal.style.display = "block";
}

function editProductType(id, name) {
  const modal = document.getElementById("edit-product-type-modal");
  document.getElementById("edit-product-type-id").value = id;
  document.getElementById("edit-product-type-name").value = name;
  modal.style.display = "block";
}

function editAttribute(id, productTypeId, name) {
  const modal = document.getElementById("edit-attribute-modal");
  document.getElementById("edit-attribute-id").value = id;
  document.getElementById("edit-attribute-product-type-id").value =
    productTypeId;
  document.getElementById("edit-attribute-name").value = name;
  modal.style.display = "block";
}

function editUser(id, name, email, password, role_id) {
  const modal = document.getElementById("edit-user-modal");
  document.getElementById("edit-user-id").value = id;
  document.getElementById("edit-user-name").value = name;
  document.getElementById("edit-user-email").value = email;
  document.getElementById("edit-user-password").value = password;
  document.getElementById("edit-user-role-id").value = role_id;
  modal.style.display = "block";
}

async function deleteProduct(id) {
  if (confirm("Удалить товар?")) {
    const response = await fetch("../components/action/admin_panel.php", {
      method: "POST",
      body: JSON.stringify({
        action: "delete",
        id,
      }),
      headers: { "Content-Type": "application/json" },
    });

    if (!response.ok) {
      const errorText = await response.text();
      console.error("Сервер вернул ошибку:", errorText);
      alert("Ошибка сервера. Проверьте консоль.");
      return;
    }

    const result = await response.json();
    if (result.success) {
      loadProducts();
    } else {
      alert("Ошибка: " + result.error);
    }
  }
}

async function deleteBrand(id) {
  if (confirm("Удалить бренд?")) {
    const response = await fetch("../components/action/admin_panel.php", {
      method: "POST",
      body: JSON.stringify({
        action: "delete_brand",
        id,
      }),
      headers: { "Content-Type": "application/json" },
    });

    if (!response.ok) {
      const errorText = await response.text();
      console.error("Сервер вернул ошибку:", errorText);
      alert("Ошибка сервера. Проверьте консоль.");
      return;
    }

    const result = await response.json();
    if (result.success) {
      await loadBrands();
      loadProducts();
    } else {
      alert("Ошибка: " + result.error);
    }
  }
}

async function deleteProductType(id) {
  if (confirm("Удалить тип товара?")) {
    const response = await fetch("../components/action/admin_panel.php", {
      method: "POST",
      body: JSON.stringify({
        action: "delete_product_type",
        id,
      }),
      headers: { "Content-Type": "application/json" },
    });

    if (!response.ok) {
      const errorText = await response.text();
      console.error("Сервер вернул ошибку:", errorText);
      alert("Ошибка сервера. Проверьте консоль.");
      return;
    }

    const result = await response.json();
    if (result.success) {
      await loadProductTypes();
      loadProducts();
    } else {
      alert("Ошибка: " + result.error);
    }
  }
}

async function deleteAttribute(id) {
  if (confirm("Удалить атрибут?")) {
    const response = await fetch("../components/action/admin_panel.php", {
      method: "POST",
      body: JSON.stringify({
        action: "delete_attribute",
        id,
      }),
      headers: { "Content-Type": "application/json" },
    });

    if (!response.ok) {
      const errorText = await response.text();
      console.error("Сервер вернул ошибку:", errorText);
      alert("Ошибка сервера. Проверьте консоль.");
      return;
    }

    const result = await response.json();
    if (result.success) {
      await loadAttributes();
      loadProducts();
    } else {
      alert("Ошибка: " + result.error);
    }
  }
}

async function deleteUser(id) {
  if (confirm("Удалить пользователя?")) {
    const response = await fetch("../components/action/admin_panel.php", {
      method: "POST",
      body: JSON.stringify({
        action: "delete_user",
        id,
      }),
      headers: { "Content-Type": "application/json" },
    });

    if (!response.ok) {
      const errorText = await response.text();
      console.error("Сервер вернул ошибку:", errorText);
      alert("Ошибка сервера. Проверьте консоль.");
      return;
    }

    const result = await response.json();
    if (result.success) {
      loadUsers();
    } else {
      alert("Ошибка: " + result.error);
    }
  }
}

const addProductForm = document.getElementById("add-product-form");
addProductForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(addProductForm);
  const attributes = {};
  document
    .querySelectorAll("#add-product-attributes input")
    .forEach((input) => {
      attributes[input.name.split("[")[1].split("]")[0]] = input.value;
    });
  let testImg = formData.get("img");
  console.log(formData);
  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "add",
      name: formData.get("name"),
      price: formData.get("price"),
      status: formData.get("status"),
      brand_id: formData.get("brand_id"),
      types_id: formData.get("types_id"),
      description: formData.get("description"),
      short_description: formData.get("short_description") || "",
      quantity: formData.get("quantity"),
      img: testImg.name,
      attributes,
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    alert("Товар добавлен!");
    addProductForm.reset();
    document.getElementById("add-product-attributes").innerHTML = "";
    loadProducts();
  } else {
    alert("Ошибка: " + result.error);
  }
});

const addBrandForm = document.getElementById("add-brand-form");
addBrandForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(addBrandForm);

  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "add_brand",
      name: formData.get("name"),
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    alert("Бренд добавлен!");
    addBrandForm.reset();
    await loadBrands();
    loadProducts();
  } else {
    alert("Ошибка: " + result.error);
  }
});

const addProductTypeForm = document.getElementById("add-product-type-form");
addProductTypeForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(addProductTypeForm);

  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "add_product_type",
      name: formData.get("name"),
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    alert("Тип товара добавлен!");
    addProductTypeForm.reset();
    await loadProductTypes();
    loadProducts();
  } else {
    alert("Ошибка: " + result.error);
  }
});

const addAttributeForm = document.getElementById("add-attribute-form");
addAttributeForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(addAttributeForm);

  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "add_attribute",
      product_type_id: formData.get("product_type_id"),
      name: formData.get("name"),
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    alert("Атрибут добавлен!");
    addAttributeForm.reset();
    await loadAttributes();
    loadProducts();
  } else {
    alert("Ошибка: " + result.error);
  }
});

const addUserForm = document.getElementById("add-user-form");
addUserForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(addUserForm);

  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "add_user",
      name: formData.get("name"),
      email: formData.get("email"),
      password: formData.get("password"),
      role_id: formData.get("role_id"),
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    alert("Пользователь добавлен!");
    addUserForm.reset();
    loadUsers();
  } else {
    alert("Ошибка: " + result.error);
  }
});

const editProductForm = document.getElementById("edit-product-form");
editProductForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = document.getElementById("edit-product-id").value;
  const name = document.getElementById("edit-name").value;
  const price = document.getElementById("edit-price").value;
  const status = document.getElementById("edit-status").value;
  const brand_id = document.getElementById("edit-brand-id").value;
  const types_id = document.getElementById("edit-types-id").value;
  const description = document.getElementById("edit-description").value;
  const short_description = document.getElementById(
    "edit-short_description"
  ).value;
  const quantity = document.getElementById("edit-quantity").value;

  const attributes = Array.from(
    document.querySelectorAll("#edit-product-attributes input")
  ).map((input) => ({
    attribute_id: input.getAttribute("data-attribute-id"),
    value: input.value,
  }));

  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "update",
      id,
      name,
      price,
      status,
      brand_id,
      types_id,
      description,
      short_description: short_description || "",
      quantity,
      attributes,
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    document.getElementById("edit-modal").style.display = "none";
    loadProducts();
  } else {
    alert("Ошибка: " + result.error);
  }
});

const editBrandForm = document.getElementById("edit-brand-form");
editBrandForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = document.getElementById("edit-brand-id").value;
  const name = document.getElementById("edit-brand-name").value;

  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "update_brand",
      id,
      name,
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    document.getElementById("edit-brand-modal").style.display = "none";
    await loadBrands();
    loadProducts();
  } else {
    alert("Ошибка: " + result.error);
  }
});

const editProductTypeForm = document.getElementById("edit-product-type-form");
editProductTypeForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = document.getElementById("edit-product-type-id").value;
  const name = document.getElementById("edit-product-type-name").value;

  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "update_product_type",
      id,
      name,
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    document.getElementById("edit-product-type-modal").style.display = "none";
    await loadProductTypes();
    loadProducts();
  } else {
    alert("Ошибка: " + result.error);
  }
});

const editAttributeForm = document.getElementById("edit-attribute-form");
editAttributeForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = document.getElementById("edit-attribute-id").value;
  const productTypeId = document.getElementById(
    "edit-attribute-product-type-id"
  ).value;
  const name = document.getElementById("edit-attribute-name").value;

  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "update_attribute",
      id,
      product_type_id: productTypeId,
      name,
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    document.getElementById("edit-attribute-modal").style.display = "none";
    await loadAttributes();
    loadProducts();
  } else {
    alert("Ошибка: " + result.error);
  }
});

const editUserForm = document.getElementById("edit-user-form");
editUserForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = document.getElementById("edit-user-id").value;
  const name = document.getElementById("edit-user-name").value;
  const email = document.getElementById("edit-user-email").value;
  const password = document.getElementById("edit-user-password").value;
  const role_id = document.getElementById("edit-user-role-id").value;

  const response = await fetch("../components/action/admin_panel.php", {
    method: "POST",
    body: JSON.stringify({
      action: "update_user",
      id,
      name,
      email,
      password,
      role_id,
    }),
    headers: { "Content-Type": "application/json" },
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Сервер вернул ошибку:", errorText);
    alert("Ошибка сервера. Проверьте консоль.");
    return;
  }

  const result = await response.json();
  if (result.success) {
    document.getElementById("edit-user-modal").style.display = "none";
    loadUsers();
  } else {
    alert("Ошибка: " + result.error);
  }
});

function searchProducts() {
  const searchTerm = document
    .getElementById("search-product")
    .value.toLowerCase();
  const rows = document.querySelectorAll("#products-table tbody tr");

  rows.forEach((row) => {
    const name = row.cells[1].textContent.toLowerCase();
    row.style.display = name.includes(searchTerm) ? "" : "none";
  });
}
