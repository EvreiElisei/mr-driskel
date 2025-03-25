const filterBox = document.querySelectorAll('.marceting__row');
const filterGoods = filterClass => {
	filterBox.forEach(item => {
		item.classList.remove('hidden');
		if (!item.classList.contains(filterClass)) {
			item.classList.add('hidden');
		}
	})
}
document.querySelector('.marceting__filters').addEventListener('click', event => {
	if (event.target.tagName !== 'LI') return;
	let filterClass = event.target.dataset['f'];
	filterGoods(filterClass);
})