<div class="user-forms">
	<form id="formReg" class="user-form user-form__reg" action="components\action\reg.php" method="Post" novalidate data-js-form>
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
		<div class="user-form__field">
			<label for="reg-email" class="user-form__label">Введите почту</label>
			<input
				id='reg-email'
				name="email"
				type="text"
				class="user-form__input"
				aria-errormessage="reg-email-errors"
				pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$"
				required>
			<span
				id="reg-email-errors"
				class="user-form__field-errors"
				data-js-form-field-errors>
			</span>
		</div>
		<div class="user-form__field">
			<label for="reg-login" class="user-form__label">ФИО</label>
			<input
				id='reg-login'
				name="login"
				type="text"
				class="user-form__input"
				minlength="3"
				maxlength="20"
				aria-errormessage="reg-login-errors">
			<span
				id="reg-login-errors"
				class="user-form__field-errors"
				data-js-form-field-errors>
			</span>
		</div>

		<div class="user-form__field">
			<label for="reg-password" class="user-form__label">Введите пароль</label>
			<input
				id='reg-password'
				name="pass"
				type="password"
				class="user-form__input"
				minlength="3"
				maxlength="12"
				pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}"
				title="Пароль должен быть длиной от 8 до 16 символов, включать как минимум одну цифру, одну букву в нижнем и одну букву в верхнем регистре"
				aria-errormessage="reg-password-errors"
				required>
			<span
				id="reg-password-errors"
				class="user-form__field-errors"
				data-js-form-field-errors>
			</span>
		</div>
		<button class="user-form__btn button button--accent" type="submit">Зарегистрироваться</button>
		<span class="user-form__field-errors" data-js-form-errors></span>
		<div class="user-form__field">
			<div class="user-form__checkbox-box">
				<input
					id="agreement"
					type="checkbox"
					name="agreement"
					required
					aria-errormessage="agreement-errors">
				<label for="agreement">
					При воходе или регистрации вы соглашаетесь с условиями
					предоставления сервиса
				</label>
				<span
					class="user-form__field-errors"
					id="agreement-errors"
					data-js-form-field-errors>
				</span>
			</div>

		</div>

		<span class="user-form__log">Уже есть профиль? <button type="button" id="openLog">Авторизируйтесь</button> на нашем
			сайте</span>
	</form>

	<form id="formLog" class="user-form user-form__login" action="components\action\login.php" method="Post" novalidate data-js-form>
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
		<div class="user-form__field">
			<label for="log-email" class="user-form__label">Введите почту</label>
			<input
				id="log-email"
				name="email"
				type="text"
				class="user-form__input"
				required
				aria-errormessage="log-email-errors">
			<span
				class="user-form__field-errors"
				id="log-email-errors"
				data-js-form-field-errors>
			</span>
		</div>
		<div class="user-form__field">
			<label for="log-pass" class="user-form__label">Введите пароль</label>
			<input
				id="log-pass"
				name="pass"
				type="password"
				class="user-form__input"
				required
				aria-errormessage="log-password-errors">
			<span
				class="user-form__field-errors"
				id="log-password-errors"
				data-js-form-field-errors>
			</span>
		</div>



		<button class="user-form__btn button button--accent" type="submit">Войти</button>
		<span class="user-form__field-errors" data-js-form-errors></span>
		<span class="user-form__log">У вас нет профиля? <button type="button" id="openReg">Зарегистрируйтесь</button> на
			нашем
			сайте</span>
	</form>
</div>
<?php
unset($_SESSION['logError']);
?>