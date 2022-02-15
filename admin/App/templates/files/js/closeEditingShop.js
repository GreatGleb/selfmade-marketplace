let buttonCloseEditingShop = document.querySelector('.editing_shop .header .close');
buttonCloseEditingShop.addEventListener('click', closeEditingShop, false);

function closeEditingShop() {
	let table = mainContent.querySelector('.table_shops');
	table.classList.remove('none');
	
	let editing = mainContent.querySelector('.editing_shop');
	
	editing.classList.add('none');
	
	changeLeftMenuHeight();
}