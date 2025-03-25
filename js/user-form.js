const userFormClose = document.querySelectorAll('.user-form__close');
function formClose(e) {
	const closeButton = e.currentTarget;
	closeButton.closest('.user-form').classList.remove('user-form__active');
}
userFormClose.forEach(close => {
		close.addEventListener('click', formClose)
})
	
const userFormOpen = document.querySelector('#openForm');
const userFormLogin = document.querySelector('.user-form__login');
const userFormReg = document.querySelector('.user-form__reg');
userFormOpen.addEventListener('click', () => {
	if (userFormReg.className == 'user-form user-form__reg user-form__active') {
		userFormReg.classList.remove('user-form__active');
	} else {
		userFormLogin.classList.toggle('user-form__active');
	}
	
})

const userFormOpenReg = document.querySelector('#openReg');
userFormOpenReg.addEventListener('click', () => {
	userFormLogin.classList.remove('user-form__active');
	userFormReg.classList.add('user-form__active');
})
const userFormOpenLog = document.querySelector('#openLog');
userFormOpenLog.addEventListener('click', () => {
	userFormReg.classList.remove('user-form__active');
	userFormLogin.classList.add('user-form__active');
})