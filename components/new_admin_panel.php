<?php
require_once 'header_admin.php';
?>

<body>
  <div class="container">
    <h2>Админ-панель</h2>
    <div class="admin-panel">
      <!-- Вкладки -->
      <div class="tabs">
        <button class="admin-button tab-button" onclick="openTab('products')">Товары</button>
        <button class="admin-button tab-button" onclick="openTab('brands')">Бренды</button>
        <button class="admin-button tab-button" onclick="openTab('product_types')">
          Типы товаров
        </button>
        <button class="admin-button tab-button" onclick="openTab('attributes')">
          Атрибуты
        </button>
        <button class="admin-button tab-button" onclick="openTab('users')">
          Пользователи
        </button>
      </div>

      <!-- Секция товаров -->
      <div id="products" class="tab-content">
        <h3>Добавить товар</h3>
        <form id="add-product-form" enctype="multipart/form-data">
          <input type="text" name="name" placeholder="Название" required />
          <input type="number" name="price" placeholder="Цена" required />
          <input type="text" name="status" placeholder="Статус" required />
          <select name="brand_id" id="add-brand-id" required>
            <option value="">Выберите бренд</option>
          </select>
          <select
            name="types_id"
            id="add-types-id"
            required
            onchange="loadAttributesForAdd()">
            <option value="">Выберите тип</option>
          </select>
          <div id="add-product-attributes"></div>
          <textarea
            name="description"
            placeholder="Описание"
            required></textarea>
          <textarea
            name="short_description"
            placeholder="Краткое описание"
            required></textarea>
          <input
            type="number"
            name="quantity"
            placeholder="Количество"
            required />
          <input type="file" name="img">
          <button class="admin-button" type=" submit">Добавить</button>
        </form>

        <h3>Список товаров</h3>
        <div>
          <input
            type="text"
            id="search-product"
            placeholder="Поиск по названию..."
            onkeyup="searchProducts()" />
        </div>
        <table id="products-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Название</th>
              <th>Цена</th>

              <th>Бренд</th>
              <th>Тип</th>
              <th>Краткое описание</th>
              <th>Количество</th>

              <th>Действия</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <!-- Секция брендов -->
      <div id="brands" class="tab-content" style="display: none">
        <h3>Добавить бренд</h3>
        <form id="add-brand-form">
          <input
            type="text"
            name="name"
            placeholder="Название бренда"
            required />
          <button class="admin-button" type=" submit">Добавить</button>
        </form>

        <h3>Список брендов</h3>
        <table id="brands-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Название</th>
              <th>Действия</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <!-- Секция типов товаров -->
      <div id="product_types" class="tab-content" style="display: none">
        <h3>Добавить тип товара</h3>
        <form id="add-product-type-form">
          <input type="text" name="name" placeholder="Название типа" required />
          <button class="admin-button" type="submit">Добавить</button>
        </form>

        <h3>Список типов товаров</h3>
        <table id="product-types-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Название</th>
              <th>Действия</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <!-- Секция атрибутов -->
      <div id="attributes" class="tab-content" style="display: none">
        <h3>Добавить атрибут</h3>
        <form id="add-attribute-form">
          <select
            name="product_type_id"
            id="add-attribute-product-type-id"
            required>
            <option value="">Выберите тип товара</option>
          </select>
          <input
            type="text"
            name="name"
            placeholder="Название атрибута"
            required />
          <button class="admin-button" type="submit">Добавить</button>
        </form>

        <h3>Список атрибутов</h3>
        <table id="attributes-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Тип товара</th>
              <th>Название</th>
              <th>Действия</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <!-- Секция пользователей -->
      <div id="users" class="tab-content" style="display: none">
        <h3>Добавить пользователя</h3>
        <form id="add-user-form">
          <input type="text" name="name" placeholder="Имя" required />
          <input type="text" name="email" placeholder="Email" required />
          <input
            type="password"
            name="password"
            placeholder="Пароль"
            required />
          <select name="role_id" id="add-role-id" required>
            <option value="">Выберите роль</option>
          </select>
          <button class="admin-button" type="submit">Добавить</button>
        </form>

        <h3>Список пользователей</h3>
        <table id="users-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Роль</th>
              <th>Действия</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>

    <div id="edit-modal" class="modal">
      <div class="modal-content">
        <span class="close">×</span>
        <h3>Редактировать товар</h3>
        <form id="edit-product-form">
          <input type="hidden" id="edit-product-id" />
          <input type="text" id="edit-name" placeholder="Название" required />
          <input type="number" id="edit-price" placeholder="Цена" required />
          <input type="text" id="edit-status" placeholder="Статус" required />
          <select id="edit-brand-id" required>
            <option value="">Выберите бренд</option>
          </select>
          <select
            id="edit-types-id"
            required
            onchange="loadProductAttributesForEdit(document.getElementById('edit-product-id').value)">
            <option value="">Выберите тип</option>
          </select>
          <div id="edit-product-attributes"></div>
          <textarea
            id="edit-description"
            placeholder="Описание"
            required></textarea>
          <textarea
            id="edit-short_description"
            placeholder="Краткое описание"
            required></textarea>
          <input
            type="number"
            id="edit-quantity"
            placeholder="Количество"
            required />

          <button class="admin-button" type="submit">Сохранить</button>
        </form>
      </div>
    </div>

    <div id="edit-brand-modal" class="modal">
      <div class="modal-content">
        <span class="close">×</span>
        <h3>Редактировать бренд</h3>
        <form id="edit-brand-form">
          <input type="hidden" id="edit-brand-id" />
          <input
            type="text"
            id="edit-brand-name"
            placeholder="Название бренда"
            required />
          <button class="admin-button" type="submit">Сохранить</button>
        </form>
      </div>
    </div>

    <div id="edit-product-type-modal" class="modal">
      <div class="modal-content">
        <span class="close">×</span>
        <h3>Редактировать тип товара</h3>
        <form id="edit-product-type-form">
          <input type="hidden" id="edit-product-type-id" />
          <input
            type="text"
            id="edit-product-type-name"
            placeholder="Название типа"
            required />
          <button class="admin-button" type="submit">Сохранить</button>
        </form>
      </div>
    </div>

    <div id="edit-attribute-modal" class="modal">
      <div class="modal-content">
        <span class="close">×</span>
        <h3>Редактировать атрибут</h3>
        <form id="edit-attribute-form">
          <input type="hidden" id="edit-attribute-id" />
          <select id="edit-attribute-product-type-id" required>
            <option value="">Выберите тип товара</option>
          </select>
          <input
            type="text"
            id="edit-attribute-name"
            placeholder="Название атрибута"
            required />
          <button type="submit">Сохранить</button>
        </form>
      </div>
    </div>

    <div id="edit-user-modal" class="modal">
      <div class="modal-content">
        <span class="close">×</span>
        <h3>Редактировать пользователя</h3>
        <form id="edit-user-form">
          <input type="hidden" id="edit-user-id" />
          <input type="text" id="edit-user-name" placeholder="Имя" required />
          <input
            type="text"
            id="edit-user-email"
            placeholder="Email"
            required />
          <input
            type="password"
            id="edit-user-password"
            placeholder="Пароль"
            required />
          <select id="edit-user-role-id" required>
            <option value="">Выберите роль</option>
          </select>
          <button class="admin-button" type="submit">Сохранить</button>
        </form>
      </div>
    </div>
  </div>


  <script src="../js/admin.js"></script>
</body>

</html>