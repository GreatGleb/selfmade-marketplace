let buttonCloseEditingSeller = document.querySelector('.editing_seller .header .close');
buttonCloseEditingSeller.addEventListener('click', closeEditingSeller, false);

function closeEditingSeller() {
	let table = mainContent.querySelector('.table_sellers');
	table.classList.remove('none');
	
	let editing = mainContent.querySelector('.editing_seller');
	
	editing.classList.add('none');
	
	changeLeftMenuHeight();
}