<?php
require_once 'header_admin.php';
require_once 'action/core.php';
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
			<form action="action/product/add-product.php" method="post" enctype="multipart/form-data" class="admin__form">
				<input class="admin__form-input" placeholder="Название товара" name="name" type="text">
				<input class="admin__form-input" placeholder="Цена" name="price" type="text">
				<input class="admin__form-input" placeholder="Статус" name="status" type="text">
				<label for="img">Изображение</label>
				<input class="admin__form-input" name="img" type="file">
				<p><?php echo $_SESSION['addError'];?></p>
				<button class="admin__btn button" type="submit">Добавить</button>
			</form>
		</div>
		<div id="delete-product" class="admin__product">
			<h3 class="admin__product-title h3">Удаление товара</h3>
			<form action="action/product/delete-product.php" method="post" class="admin__form">
				<select class="admin__form-input admin__form-select" name="name" id="">
					<option value="">Выберите товар</option>
					<?php
					$product_name = "SELECT `name` FROM `products`";
					$product_name_res = $connect->query($product_name);
					if($product_name_res->num_rows > 0){
						while($row = $product_name_res->fetch_assoc()){
							?>
					<option class="" value="<?= $row['name']?>"><?= $row['name']?></option>
					<?php
						}
					}else{
					?>
					<option value="">Не найдено ни одного товара</option>
					<?php
					}
					?>
				</select>
				<p><?php echo $_SESSION['deleteError'];?></p>
				<button class="admin__btn button" type="submit">Удалить</button>
			</form>
		</div>
		<div id="update-product" class="admin__product">
			<h3 class="admin__product-title h3">обновление товара</h3>
			<form action="action/product/update-product.php" method="post" enctype="multipart/form-data" class="admin__form">
				<input class="admin__form-input" placeholder="Старое название" name="old-name" type="text">
				<input class="admin__form-input" placeholder="Новое название" name="new-name" type="text">
				<input class="admin__form-input" placeholder="Новая цена" name="new-price" type="text">
				<input class="admin__form-input" placeholder="Новый статус" name="new-status" type="text">
				<label for="img">Новое изображение</label>
				<input class="admin__form-input" name="new-img" type="file">
				<p><?php echo $_SESSION['updateError'];?></p>
				<button class="admin__btn button" type="submit">Обновить</button>
			</form>
		</div>
	</div>

</div>
</div>


</body>

</html>