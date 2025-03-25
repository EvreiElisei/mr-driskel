const btn = document.querySelector('.marceting__showmore');
const cards = Array.from(document.querySelectorAll('.marceting__row'));
window.addEventListener('resize', event => {
	if (event.target.window.innerWidth > 1024) responseDesctop();
	if (event.target.window.innerWidth <= 1024 && event.target.window.innerWidth > 768) responseTablet();
})
function openCatalog() {
	btn.addEventListener('click', () => {	
		cards.forEach(item => item.classList.remove('hidden'));
		btn.classList.add('hidden');
	})
}
function responseDesctop() {
	if (window.innerWidth > 1024) {
		btn.classList.add('hidden');
		cards.forEach((item, index) =>{
			item.classList.add('hidden');
			if (index <= 7) {
				item.classList.remove('hidden');
			} else if (index > 7) {
				btn.classList.remove('hidden');
			}
			openCatalog();
		})
	}
}
responseDesctop();
function responseTablet() {
	if (window.innerWidth <= 1024 && window.innerWidth > 768) {
		btn.classList.add('hidden');
		cards.forEach((item, index) =>{
			item.classList.add('hidden');
			if (index <= 5) {
				item.classList.remove('hidden');
			} else if (index > 5) {
				btn.classList.remove('hidden');
			}
			openCatalog();
		})
	}
}
responseTablet();