let buttonCloseEditingStockroom = document.querySelector('.editing_stockroom .header .close');
buttonCloseEditingStockroom.addEventListener('click', closeEditingStockroom, false);

function closeEditingStockroom() {
	let table = mainContent.querySelector('.table_stockrooms');
	table.classList.remove('none');
	
	let editing = mainContent.querySelector('.editing_stockroom');
	
	editing.classList.add('none');
	
	changeLeftMenuHeight();
}