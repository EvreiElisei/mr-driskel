<?php

?>
<div class="user-forms">
	<form class="user-form user-form__reg" action="components\action\reg.php" method="Post">
		<button type="button" class="user-form__close">
			<svg width="16" height="16" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd"
					d="M5.15137 3.79299L8.6869 0.257457L9.39401 0.964564L5.85847 4.5001L9.39401 8.03563L8.6869 8.74274L5.15137 5.20721L1.61583 8.74274L0.908726 8.03563L4.44426 4.5001L0.908727 0.964564L1.61583 0.257457L5.15137 3.79299Z"
					fill="#636B78" />
			</svg>
		</button>
		<h3 class="user-form__title h3">
			Регистрация
		</h3>
		<label for="name" class="user-form__label">Введите имя пользователя</label>
		<input name="name" type="text" class="user-form__input">
		<label for="email" class="user-form__label">Введите почту</label>
		<input name="email" type="email" class="user-form__input">
		<label for="pass" class="user-form__label">Введите пароль</label>
		<input name="pass" type="password" class="user-form__input">
		<label for="repeat-pass" class="user-form__label">Повтор пароля</label>
		<input name="repeat-pass" type="password" class="user-form__input">
		<button class="user-form__btn button button--accent" type="submit">Зарегистрироваться</button>
		<p><?= $_SESSION['regError'];?></p>
		<div class="user-form__checkbox-box">
			<input id="checkbox" type="checkbox"><label for="">При воходе или регистрации вы соглашаетесь с условиями
				предоставления сервиса</label>
		</div>
		<span class="user-form__log">Уже есть профиль? <button type="button" id="openLog">Авторизируйтесь</button> на нашем
			сайте</span>
	</form>

	<form class="user-form user-form__login" action="components\action\login.php" method="Post">
		<button type="button" class="user-form__close">
			<svg width="16" height="16" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd"
					d="M5.15137 3.79299L8.6869 0.257457L9.39401 0.964564L5.85847 4.5001L9.39401 8.03563L8.6869 8.74274L5.15137 5.20721L1.61583 8.74274L0.908726 8.03563L4.44426 4.5001L0.908727 0.964564L1.61583 0.257457L5.15137 3.79299Z"
					fill="#636B78" />
			</svg>
		</button>
		<h3 class="user-form__title h3">
			Авторизация
		</h3>
		<label for="email" class="user-form__label">Введите почту</label>
		<input name="email" type="email" class="user-form__input">
		<label for="pass" class="user-form__label">Введите пароль</label>
		<input name="pass" type="password" class="user-form__input">
		<p><?= $_SESSION['logError'];?></p>
		<button class="user-form__btn button button--accent" type="submit">Войти</button>
		<span class="user-form__log">У вас нет профиля? <button type="button" id="openReg">Зарегистрируйтесь</button> на
			нашем
			сайте</span>
	</form>
</div>