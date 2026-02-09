<?php
require_once 'header_admin.php';
require_once 'action/core.php';
$connect = getDatebaseConnection();
?>
<div class="admin">
	<div class="admin__inner container">
		<h2 class="admin__title h2">
			Приветствую администратор. Выберите желаймую функцию.
		</h2>
		<ul class="admin__nav">
			<li class="admin__nav-item">
				<a href="#add-product" class="admin__nav-link">Добавить товар</a>
				<span class="admin__nav-accent"></span>
			</li>
			<li class="admin__nav-item">
				<a href="#delete-product" class="admin__nav-link">Удалить товар</a>
				<span class="admin__nav-accent"></span>
			</li>
			<li class="admin__nav-item">
				<a href="#update-product" class="admin__nav-link">Обновить товар</a>
				<span class="admin__nav-accent"></span>
			</li>
		</ul>
		<div id="add-product" class="admin__product">
			<h3 class="admin__product-title h3">Добавление товара</h3>
			<form action="action/product-operator.php" method="post" enctype="multipart/form-data" class="admin__form">
				<input class="admin__form-input" placeholder="Название товара" name="name" type="text">
				<input class="admin__form-input" placeholder="Цена" name="price" type="number">
				<input class="admin__form-input" placeholder="Статус" name="status" type="text">
				<textarea class="admin__form-input admin__form-textarea" name="short_descr" placeholder="Краткое описание"></textarea>
				<textarea class="admin__form-input admin__form-textarea" name="descr" placeholder="Полное описание"></textarea>
				<label for="brand">Бренд</label>
				<select class="admin__form-input" name="brand_id" id="brand">
					<?php
					$get_brand = $connect->query("SELECT * FROM `brands`");
					if ($get_brand->num_rows > 0) {
						while ($row = $get_brand->fetch_assoc()) {
							echo "<option value='{$row['id']}'>{$row['name']}</option>";
						}
					} else {
						echo "<option value=''>'бренды не найдены'</option>";
					}
					?>
				</select>
				<label for="product_type">Тип товара</label>
				<select class="admin__form-input" name="product_type_id" id="product_type">
					<?php
					$get_brand = $connect->query("SELECT * FROM `product_types`");
					if ($get_brand->num_rows > 0) {
						while ($row = $get_brand->fetch_assoc()) {
							echo "<option value='{$row['id']}'>{$row['name']}</option>";
						}
					} else {
						echo "<option value=''>'бренды не найдены'</option>";
					}
					?>
				</select>
				<label for="product_attrybutes_box">атрибуты</label>
				<div id="product_attrybutes_box" class="admin__form-box">
					<?php
					$get_attrybutes = $connect->query("SELECT * FROM `product_attrybutes`");
					while ($row = $get_attrybutes->fetch_assoc()) {
						echo "<input type='text' class='admin__form-input' name='attributes[{$row['id']}]' placeholder='{$row['name']}'>";
					}
					?>
				</div>
				<label for="img">Изображение</label>
				<input class="admin__form-input" name="img" type="file">
				<input type="hidden" value="add" name="action">
				<p><?php echo $_SESSION['responseToAction']['product']['add']; ?></p>
				<button class="admin__btn button" type="submit">Добавить</button>
			</form>
		</div>
		<div id="delete-product" class="admin__product">
			<h3 class="admin__product-title h3">Удаление товара</h3>
			<form action="action/product-operator.php" method="post" class="admin__form">
				<select class="admin__form-input admin__form-select" name="product_id" id="">
					<option value="">Выберите товар</option>
					<?php
					$product_name = "SELECT `id`, `name` FROM `products`";
					$product_name_res = $connect->query($product_name);
					if ($product_name_res->num_rows > 0) {
						while ($row = $product_name_res->fetch_assoc()) {
					?>
							<option class="" value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
						<?php
						}
					} else {
						?>
						<option value="">Не найдено ни одного товара</option>
					<?php
					}
					?>
				</select>
				<input type="hidden" value="delete" name="action">
				<p><?php echo $_SESSION['responseToAction']['product']['delete']; ?></p>
				<button class="admin__btn button" type="submit">Удалить</button>
			</form>
		</div>
		<div id="update-product" class="admin__product">
			<h3 class="admin__product-title h3">обновление товара</h3>
			<form action="action/product-operator.php" method="post" enctype="multipart/form-data" class="admin__form">
				<select class="admin__form-input admin__form-select" name="product_id" id="">
					<option value="">Выберите товар</option>
					<?php
					$product_name = "SELECT `id`, `name` FROM `products`";
					$product_name_res = $connect->query($product_name);
					if ($product_name_res->num_rows > 0) {
						while ($row = $product_name_res->fetch_assoc()) {
					?>
							<option class="" value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
						<?php
						}
					} else {
						?>
						<option value="">Ведутся технические работы</option>
					<?php
					}
					?>
				</select>
				<input class="admin__form-input" placeholder="Новое название" name="new_name" type="text">
				<input class="admin__form-input" placeholder="Новая цена" name="new_price" type="number">
				<input class="admin__form-input" placeholder="Новый статус" name="new_status" type="text">
				<textarea class="admin__form-input admin__form-textarea" name="new_short_descr" placeholder="Краткое описание"></textarea>
				<textarea class="admin__form-input admin__form-textarea" name="new_descr" placeholder="Полное описание"></textarea>
				<label for="brand">Бренд</label>
				<select class="admin__form-input" name="new_brand_id" id="brand">
					<?php
					$get_brand = $connect->query("SELECT * FROM `brands`");
					if ($get_brand->num_rows > 0) {
						while ($row = $get_brand->fetch_assoc()) {
							echo "<option value='{$row['id']}'>{$row['name']}</option>";
						}
					} else {
						echo "<option value=''>'бренды не найдены'</option>";
					}
					?>
				</select>
				<label for="product_type">Тип товара</label>
				<select class="admin__form-input" name="new_product_type_id" id="product_type" disabled>
					<?php
					$get_brand = $connect->query("SELECT * FROM `product_types`");
					if ($get_brand->num_rows > 0) {
						while ($row = $get_brand->fetch_assoc()) {
							echo "<option value='{$row['id']}'>{$row['name']}</option>";
						}
					} else {
						echo "<option value=''>'бренды не найдены'</option>";
					}
					?>
				</select>
				<label for="product_attrybutes_box">атрибуты</label>
				<div id="product_attrybutes_box" class="admin__form-box">
					<?php
					$get_attrybutes = $connect->query("SELECT * FROM `product_attrybutes`");
					while ($row = $get_attrybutes->fetch_assoc()) {
						echo "<input type='text' class='admin__form-input' name='new_attributes[{$row['id']}]' placeholder='{$row['name']}'>";
					}
					?>
				</div>
				<label for="img">Новое изображение</label>
				<input class="admin__form-input" name="new-img" type="file">
				<input type="hidden" value="update" name="action">
				<p><?php echo $_SESSION['responseToAction']['product']['update']; ?></p>
				<button class="admin__btn button" type="submit">Обновить</button>
			</form>
		</div>

	</div>

</div>
</div>
<?php
unset($_SESSION['responseToAction']['product']);
?>

</body>

</html>